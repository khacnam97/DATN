<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Response;
use App\Order;
use App\Restaurant;
use App\Post;
use App\User;
use DB;
use Config;
use App\Accept;
use App\Events\NotiOrderHandler;
use App\Notifications\NotiOrder;
use App\Notifications\NotiOrderUser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Mail\AcceptCreated;
use App\Notifications\AcceptRequest;
use App\Photo;
class OrderController extends Controller
{
    public function index($id)
	{
        $order_time=Order_time::all();
        $restaurant=restaurant::find($id);
       
		return view('pages.order',['order_time'=>$order_time,'restaurant'=>$restaurant]);
	}
	public function addOrder(Request $request)
    {
        
        $this->validate($request,
            [   'phone'=>'required',
                'address'=>'required',
                'time'=>'required',
                'detail_id'=>'required',
                'order_date'=>'required',
                'price_table'=>'required',
                'people_number'=>['required','integer']
            ],
            [
                'phone.required'=>'bạn chưa nhập số điện thoại',
                'address.required'=>'bạn chưa nhập địa chỉ',
                'time.required'=>'bạn chưa nhập thời gian',
                'order_date.required'=>'bạn chưa nhập ngày tháng',
                'people_number.required'=>'bạn chưa nhập số lượng người ',
                'price_table.required'=>'bạn chưa nhập số bàn',
                'detail_id.required'=>'Bạn chưa chọn khu vực'
            ]
        );

        $order = new Order;
        $restaurant=Restaurant::all();
        $detail_id=$request->detail_id;
        $orderDate =$request->order_date;
        $restaurant =$request->restaurant_id;
        $detailAvalible1 = DB::table('orders')
            ->join('restaurants','restaurants.id','=','orders.restaurant_id')
            ->join('posts','posts.restaurant_id','=','restaurants.id')
            ->select('orders.detail_id as id1')
            ->where([
                  [ 'orders.restaurant_id','=',$restaurant],
                  [ 'orders.order_date','=',$orderDate],
                  [ 'orders.detail_id','=',$detail_id]
                  ])
            ->get();
        $ex_detailAvalible=explode (':',$detailAvalible1);
        $a=array();
        array_push($a, "[]");
        $result=array_diff($ex_detailAvalible,$a);
        if (!empty($result)) {
          return redirect()->back()->with('error','Bạn đã chọn khu đã có người đặt ,bạn vui lòng xem lại !'); 
        }
        else{
          $order->people_number=$request->people_number;
          $order->address=$request->address;
          $order->phone=$request->phone;
          $order->user_id=Auth::id();
          $order->price_table=$request->price_table;  
          $order->order_date=$request->order_date;
          $order->order_time=$request->time;
          $order->restaurant_id=$request->restaurant_id;
          $order->detail_id=$request->detail_id;
          $restaurant =$request->restaurant_id;
        //dd($restaurant);
          $order->status=0;   
          $order->save();
          event(new NotiOrderHandler($order));
          $toUsers = User::join('posts','posts.user_id','=','users.id')
          ->select( 'users.id as id')
          ->where('posts.restaurant_id','=',$restaurant)->get();
          \Notification::send($toUsers, new NotiOrder($order));
          return redirect()->route('myorder');
        }        
    }
   
    public function manageOrder ()
    {
       $id = Auth::id();
       $order =Order::join('restaurants','orders.restaurant_id','=','restaurants.id')
               ->join('posts','posts.restaurant_id','=','restaurants.id')
               ->join('users','users.id','=','orders.user_id')
               ->join('details', 'details.id', '=', 'orders.detail_id')
               ->select('orders.id','orders.user_id','orders.order_time','orders.phone','orders.people_number','orders.price_table','orders.order_date','orders.status','users.email','orders.address','orders.restaurant_id','details.room','details.service','details.people_number as detailpeonumber','details.price as detailprice')
               ->where('posts.user_id','=',$id)->Paginate(10);

       return view('pages.manageOrder',['order'=>$order]);
    }
     public function cancel($id,Request $request)
    {
        $order = Order::find($id);
           $order->status=0;
           $order->save();
           return redirect()->back()->with('success',Config::get('constant.user.blockUser')); 
      // }
    }
    public function acceptOrder(Request $request)
    {
        $id =  $request->id;
        $order = Order::find($id);
        do {
          //generate a random string using Laravel's str_random helper
         $token = str_random();
          } //check if the token already exists and if it does, try again
         while (Accept::where('token', $token)->first());

          //create a new invite record
          $accept= new Accept();
          $accept->email=$request->get('email');
          $accept->address=$request->get('address');
          $accept->restaurant=$request->get('restaurant');
          $accept->order_date=$request->get('order_date');
          $accept->order_time=$request->get('order_time');
          $accept->nameuserOrder=$request->get('name');
          $accept->token= md5(uniqid(rand(), true));

          $accept->save();
          // send the email
          Mail::to($request->get('email'))->send(new AcceptCreated($accept));
          // redirect back where we came from
        $order->status=1;
        $order->save();
        event(new NotiOrderHandler($order));
            $toUsers = User::join('orders','orders.user_id','=','users.id')
                             ->select( 'users.id as id')
                             ->where('orders.id','=',$id)->get();
            \Notification::send($toUsers, new NotiOrderUser($order));
        return redirect()->back()->with('success',Config::get('constant.order.accept'));
    }
    public function confirm ($id,Request $request)
    {
        $id =  $request->id;
        dd($id);
        $order = Order::find($id);
        $order->status=1;
        $order->save();
       return redirect()->back()->with('success',Config::get('constant.order.accept'));
    }
    public function myorder()
    {
        $id=Auth::id();
        $order =Order::join('restaurants','orders.restaurant_id','=','restaurants.id')
                ->join('posts', 'posts.restaurant_id', '=', 'orders.restaurant_id')
                ->join('photos', 'posts.id', '=', 'photos.post_id')
                ->join('details', 'details.id', '=', 'orders.detail_id')
                ->select('orders.id','orders.user_id','orders.order_time','orders.phone','orders.people_number','orders.price_table','orders.order_date','orders.status','orders.restaurant_id','restaurants.name','posts.title','restaurants.address as addressrestaurant','photos.photo_path','details.room','details.service','details.people_number as detailpeonumber','orders.address','details.price as detailprice')
                ->where([
                  ['orders.user_id','=',$id],
                  ['photos.flag', '=', '1'],
                  ])
                ->Paginate(10);
        // dd($order);
        return view('pages.myOrder',['order'=>$order]);
    }
    public function check(Request $request)
    {
       $order_date=$request->order_date;
       if(Order::where('order_date')!== $order_date){
          printf('a');
       }
       else printf("format");
       
    }
    public function delete($id)
    {
        $order = Order::find($id);
        $order->delete();
        
        return redirect()->back()->with('success', Config::get('constant.order.deleteOrder'));
    }
    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('myorder')
                ->withErrors($validator);
        }
       
        $id =  $request->id;
        // dd($request->id);
        $order = Order::find($id);
        $order->address = $request->addressme;
        $order->order_time = $request->order_time;
        $order->phone = $request->phone;
        $order->people_number = $request->people_number;
        $order->price_table = $request->price_table;
        //dd($request->address);
        $order->save();
        return  redirect()->route('myorder');
    }
    public function adddateOrder(Request $request)
    {
      $orderdate=$request->order_date;
      $strDay=explode (',',$orderdate);
      $post_id=$request->idpost;

      $detail =DB::table('details')
      ->join('restaurants', 'details.restaurant_id', '=', 'restaurants.id')
      ->join('posts', 'posts.restaurant_id', '=', 'restaurants.id')
      ->where('posts.id', '=', $post_id)
      ->select('details.room','details.service','details.people_number','details.id','details.price')
      ->get();
      $detailAvalible = DB::table('orders')
          ->join('restaurants','restaurants.id','=','orders.restaurant_id')
          ->join('posts','posts.restaurant_id','=','restaurants.id')
          ->select('orders.detail_id as id1')
          ->where([
                  ['posts.id','=',$post_id],
                  [ 'orders.order_date','=',$orderdate]
            ])
          ->get();
      $detailx =DB::table('details')
        ->join('restaurants', 'details.restaurant_id', '=', 'restaurants.id')
        ->join('posts', 'posts.restaurant_id', '=', 'restaurants.id')
        ->where('posts.id', '=', $post_id)
        ->select('details.id as id1')
        ->get();
      $ex_detailx=explode (':',$detailx);
      $ex_detailAvalible=explode (':',$detailAvalible);
      $result=array_diff($ex_detailx,$ex_detailAvalible);
      $strNow =  date("Y-m-d");
      
      $idrestaurant = DB::table('posts')
        ->select('posts.restaurant_id')
        ->where('posts.id','=',$post_id)->first()->restaurant_id;
        
      $iddetailorder = DB::table('orders')
                ->join('restaurants','restaurants.id','=','orders.restaurant_id')
        ->join('posts','posts.restaurant_id','=','restaurants.id')
        ->join('details','details.id','=','orders.detail_id')
        ->select('orders.detail_id','details.id','details.room','details.service','details.people_number','details.price')
        ->where([
        ['order_date', '=', $orderdate],
        ['posts.id', '=', $post_id]
      ])
      ->get();
    //dd($iddetailorder);

        $iddetail =DB::table('details')
      ->select('details.id','details.room','details.service','details.people_number','details.price')
      ->where('details.restaurant_id', '=', $idrestaurant)
      ->whereNotIn('id', DB::table('orders')
                ->join('restaurants','restaurants.id','=','orders.restaurant_id')
        ->join('posts','posts.restaurant_id','=','restaurants.id')
        ->select('detail_id')->where([
          ['order_date', '=', $orderdate],
        ['posts.id', '=', $post_id]
             ]))
      ->get();

      if(!empty($result) &&  strtotime($strNow) < strtotime($orderdate)) 
      {
          $restaurant_id =$request->restaurantid;
          $restaurantdate =$request->restaurantdate;
         // dd($restaurantdate);

          return view('pages.addorderDate',['restaurant_id'=>$restaurant_id,'restaurantdate'=>$restaurantdate,'orderdate'=>$orderdate,'detail'=>$detail,'iddetailorder'=>$iddetailorder,'iddetail'=>$iddetail]);
      }
      else{
        return redirect()->back()->with('error', Config::get('constant.order.error'));
      }
    }
}
