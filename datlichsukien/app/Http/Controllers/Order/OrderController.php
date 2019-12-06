<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\Detail;
use App\Restaurant;
use DB;
class OrderController extends Controller
{
    public function index()
    {
    	$order=Order::all();
        $user =User::all();
        $restaurant=Restaurant::all();
    	return view('admin.order.index',['order'=>$order,'user'=>$user,'restaurant'=>$restaurant]);
    }
    public function delete($id)
    {
        $order = Order::find($id);
        $order->delete();
        
        return redirect()->back()->with('success', 'Xóa thành công ');
    }
    public function addOrder (Request $request)
    {
        $this->validate($request,
            [   'phone'=>'required',
                'address'=>'required',
                'order_time'=>'required',
                'order_date'=>'required',
                'price_table'=>['required','integer'],
                'people_number'=>['required','integer']
            ],
            [
                'phone.required'=>'bạn chưa nhập số điện thoại',
                'address.required'=>'bạn chưa nhập địa chỉ',
                'order_time.required'=>'bạn chưa nhập thời gian',
                'order_date.required'=>'bạn chưa nhập ngày tháng',
                'people_number.required'=>'bạn chưa nhập số lượng người ',
                'price_table.required'=>'bạn chưa nhập số bàn'
            ]
        );
        $order = new Order;

        $order->people_number=$request->people_number;
        $order->address=$request->address;
        $order->phone=$request->phone;
        $order->user_id=$request->user_id;
        $order->price_table=$request->price_table;  
        $order->order_date=$request->order_date;
        $order->order_time=$request->order_time;
        $order->restaurant_id=$request->restaurant_id;
        //dd($restaurant);
        $order->status=0;   
        $order->save();
        return redirect()->back()->with('success', 'Add success ');
    }
     public function cancel($id,Request $request)
    {
        $order = Order::find($id);
           $order->status=0;
           $order->save();
           return redirect()->back()->with('success','success'); 
    }
    public function accept($id,Request $request)
    {
        $order = Order::find($id);
           $order->status=1;
           $order->save();
           return redirect()->back()->with('success','success'); 
    }
    public function showedit ($id)
    {
       $order=Order::find($id);
       $user =User::all();
       $detail =Detail::all();
       $iddetail = DB::table('orders')
                ->select('orders.detail_id')
                ->where('orders.id','=',$id)->first()->detail_id;
       $detail =DB::table('details')
                      ->join('restaurants','restaurants.id','=','details.restaurant_id')
                      ->join('orders','orders.restaurant_id','=','restaurants.id')
                      ->select('details.room','details.service','details.people_number')
                      ->where('orders.id','=',$id)
                      ->get();

        //dd($detail);
       $restaurant=Restaurant::all();
       return view('admin.order.edit',['order'=>$order,'user'=>$user,'restaurant'=>$restaurant,'detail'=>$detail]);
    }
    public function edit(Request $request,$id)
    {
        $order = Order::find($id);

        $this->validate($request,
            [        
                'order_time' =>'required',
                'order_date' =>'required',
                'address' =>'required',
                'phone' =>'required'
            ],
            [
                'order_time.required' =>'Bạn chưa nhập thời gian',
                'address.required' =>'Bạn chưa nhập địa chỉ',
                'phone.required' =>'Bạn chưa nhập số điện thoại',
                'order_date.required' =>'Bạn chưa nhập ngày tháng'
            ]
        );
        $order->user_id = $request->get('user_id');
        $order->address = $request->get('address');
        $order->phone = $request->get('phone');
        $order->order_date = $request->get('order_date');
        $order->order_time = $request->get('order_time');
        $order->people_number = $request->get('people_number');
        $order->price_table = $request->get('price_table');
        $order->save();
        return redirect()->back()->with('success','edit success');
    }
}
