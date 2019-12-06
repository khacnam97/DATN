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
    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function detail(){
    	return $this->belongsTo('App\Detail');
    }
}
