<?php

namespace App;
use App\Post;
use App\District;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    public function posts ()
    {
        return $this->hasMany(Post::class);
    }
     public function district()
    {
    	return $this->belongsTo(District::class); 
    }
    public function order(){
        return $this->hasMany('App\Order');
    }

}
