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
 
        $order->people_number=$request->people_number;
        $order->address=$request->address;
        $order->phone=$request->phone;
        $order->user_id=Auth::id();
        $order->price_table=$request->price_table;  
        $order->order_date=$request->order_date;
        $order->order_time_id=$request->order_time_id;
        $order->restaurant_id=$request->restaurant_id; 
        // dd($request);   
        $order->save();
        return view('pages.order',['order'=>$order]);
    }
    public function myOrder ()
    {
       $id = Auth::id();
       $order =Order::join('restaurants','orders.restaurant_id','=','restaurants.id')
               ->join('posts','posts.restaurant_id','=','restaurants.id')
               ->select('orders.id','orders.user_id','orders.order_time_id','orders.phone','orders.people_number','orders.price_table','orders.order_date')
               ->where('posts.user_id','=',$id)->get();
      

       return view('pages.myOrder',['order'=>$order]);
    }
}
