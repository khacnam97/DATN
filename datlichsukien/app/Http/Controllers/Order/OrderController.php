<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
class OrderController extends Controller
{
    public function index()
    {
    	$order=Order::all();
    	return view('admin.order.index',['order'=>$order]);
    }
    public function delete($id)
    {
        $order = Order::find($id);
        $order->delete();
        
        return redirect()->back()->with('success', 'Xóa thành công ');
    }
}
