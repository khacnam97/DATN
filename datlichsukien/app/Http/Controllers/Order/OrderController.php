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
}
