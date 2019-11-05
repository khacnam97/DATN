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
       
  //       $post = DB::table('posts')
  //       ->join('restaurants', 'posts.restaurant_id', '=', 'restaurants.id')
		// ->select('restaurants.name')
		// ->where('restaurants.id','=',$id);
		return view('pages.order',['order_time'=>$order_time]);
	}
	public function addOrder(Request $request,$id)
    {
        // $this->validate($request,
        //     [   'name'=>'required',
        //         'address'=>'required',
                
        //     ],
        //     [
        //         'name.required'=>'bạn chưa nhập tên địa điểm',
        //         'address.required'=>'bạn chưa nhập địa chỉ',   
        //     ]
        // // );
        $restaurant=Restaurant::all();
        $order = new order;

        $order->number_people=$request->number_people;
        $order->address=$request->address;
        $order->phone=$request->phone;
        $order->price_table=$request->price_table;  
        $order->order_date=$request->date;
        // $order->=$request->order_date; 
        dd($request->phone);   
        $order->save();
        return view('' ,['restaurant'=>$restaurant]);
    }
}
