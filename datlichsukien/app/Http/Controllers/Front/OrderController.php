<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Response;
use App\Order_time;
use App\Order;
use App\Restaurant;
use App\Post;
use DB;
use Config;
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
            [   'price_table'=>'required',
                'order_date'=>'required',
                'people_number'=>'required',
                'phone'=>'required',
                'address'=>'required',
                
            ],
            [
                'price_table.required'=>'bạn chưa nhập giá mỗi bàn ',
                'order_date.required'=>'bạn chưa nhập ngày tổ chức',
                'people_number.required'=>'bạn chưa nhập số lượng người',
                'phone.required'=>'bạn chưa nhập tên địa điểm',
                'address.required'=>'bạn chưa nhập địa chỉ',   
            ]
         );
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
          
        $order->status=0;
        // dd($request);   
        $order->save();
        return view('pages.test',['order'=>$order,'order_time'=>$order_time,'restaurant'=>$restaurant]);
    }
    public function manageOrder ()
    {
       $id = Auth::id();
       $order =Order::join('restaurants','orders.restaurant_id','=','restaurants.id')
               ->join('posts','posts.restaurant_id','=','restaurants.id')
               ->select('orders.id','orders.user_id','orders.order_time','orders.phone','orders.people_number','orders.price_table','orders.order_date','orders.status')
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
    public function accept($id,Request $request)
    {
        $order = Order::find($id);
        $order->status=1;
        $order->save();
        return redirect()->back()->with('success',Config::get('constant.user.unblockUser'));
    }
    public function confirm ()
    {
       return view('pages.confirm');
    }
    public function myorder()
    {
        $id=Auth::id();
        $order =Order::join('restaurants','orders.restaurant_id','=','restaurants.id')
                ->select('orders.id','orders.user_id','orders.order_time','orders.phone','orders.people_number','orders.price_table','orders.order_date','orders.status','orders.restaurant_id')
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
}
