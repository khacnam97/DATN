<?php

namespace App;
use App\Restaurant;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
     public function restaurants()
    {
    	return $this->hasMany('App\Restaurant');
    }}
