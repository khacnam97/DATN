<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_time extends Model
{
     public function order(){
        return $this->hasMany('App\Order');
    }
}
