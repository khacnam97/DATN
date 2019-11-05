<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function order_time(){
    	return $this->belongsTo('App\Order_time');
    }
    public function restaurant(){
    	return $this->belongsTo('App\Restaurant');
    }
}
