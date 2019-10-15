<?php

namespace App;
use App\User;
use App\Restaurant;
use App\Photo;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function photos()
    {
    	return $this->hasMany('App\Photo');
    }
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
