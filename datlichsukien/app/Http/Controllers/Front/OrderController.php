<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Response;
use App\Order_time;
use App\Order;
use App\Restaurant;
use App\Post;
use App\User;
use DB;
use Config;
use App\Accept;
use App\Events\NotiOrderHandler;
use App\Notifications\NotiOrder;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Mail\AcceptCreated;
use App\Notifications\AcceptRequest;
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
        
        // $restaurant = DB::table('restaurants')
        // ->select('restaurants.id')
        // ->where('restaurants.id','=',$id)->first()->id;
        $order = new Order;
        $order_time=Order_time::all();
        $restaurant=Restaurant::all();

        $order->people_number=$request->people_number;
        $order->address=$request->address;
        $order->phone=$request->phone;
        $order->user_id=Auth::id();
        $order->price_table=$request->price_table;  
        $order->order_date=$request->order_date;
        $order->order_time=$request->time;
        $order->restaurant_id=$request->restaurant_id;
        $restaurant =$request->restaurant_id;
        //dd($restaurant);
        $order->status=0;   
        $order->save();
        event(new NotiOrderHandler($order));
            $toUsers = User::join('posts','posts.user_id','=','users.id')
                             ->select( 'users.id as id')
                             ->where('posts.restaurant_id','=',$restaurant)->get();
             // $toUsers = User::where('role','=','1')->get();
                           //dd( $toUsers);
            \Notification::send($toUsers, new NotiOrder($order));
        return redirect()->route('myorder');
    }
    public function manageOrder ()
    {
       $id = Auth::id();
       $order =Order::join('restaurants','orders.restaurant_id','=','restaurants.id')
               ->join('posts','posts.restaurant_id','=','restaurants.id')
               ->join('users','users.id','=','orders.user_id')
               ->select('orders.id','orders.user_id','orders.order_time','orders.phone','orders.people_number','orders.price_table','orders.order_date','orders.status','users.email','orders.address')
               ->where('posts.user_id','=',$id)->get();
      

       return view('pages.manageOrder',['order'=>$order]);
    }
     public function cancel($id,Request $request)
    {
        $order = Order::find($id);
        // $check = $order->role;
        // if($check == 1){

        //     return redirect()->back()->with('error' , Config::get('constant.user.blockAdminUser'));
        // }
        // else{
           $order->status=0;
           $order->save();
           return redirect()->back()->with('success',Config::get('constant.user.blockUser')); 
      // }
    }
    public function accept(Request $request)
    {
        $id =  $request->id;
        $order = Order::find($id);
        $order->email = $request->email;
        do {
          //generate a random string using Laravel's str_random helper
         $token = str_random();
          } //check if the token already exists and if it does, try again
         while (Accept::where('token', $token)->first());

          //create a new invite record
          $accept1= new Accept();
          $accept1->email=$request->get('email');
          //dd($request->get('email'));
          $accept1->token= md5(uniqid(rand(), true));

          $accept1->save();
          // send the email
          Mail::to($request->get('email'))->send(new AcceptCreated($accept1));
          // redirect back where we came from
        $order->status=1;
        $order->save();
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
                ->select('orders.id','orders.user_id','orders.order_time','orders.phone','orders.people_number','orders.price_table','orders.order_date','orders.status','orders.restaurant_id','orders.address')
                ->where('user_id','=',$id)->get();

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
        $order->address = $request->address;
        $order->order_time = $request->order_time;
        $order->phone = $request->phone;
        $order->people_number = $request->people_number;
        $order->price_table = $request->price_table;
        //dd($request->address);
        $order->save();
        return  redirect()->route('myorder');
    }
}
