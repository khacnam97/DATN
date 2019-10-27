<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Rating;
use App\User;
use Auth;
use Response;
use Config;
use App\Restaurant;
use DB;

class FrontController extends Controller
{
     public function index()
    {
    	//show post newest
		$new_post = Post::join('photos', 'posts.id', '=', 'photos.post_id')
		->leftjoin('ratings', 'posts.id', '=', 'ratings.post_id')
		->select('posts.id', 'title', 'photos.photo_path', \DB::raw('avg(ratings.rating) as avg_rating'))
		->orderBy('posts.id', 'desc')
		->groupBy('posts.id')
		->groupBy('title')
		->groupBy('photos.photo_path')
		->where([
			['is_approved', '=', '1'],
			['photos.flag', '=', '1']
		])
		->take(Config::get('constant.numberRecord2'))
		->get();
		//show posts have rating highest
		$top_rating = Post::join('ratings', 'posts.id', '=', 'ratings.post_id')
		->join('photos', 'posts.id', '=', 'photos.post_id')
		->select('posts.id', 'posts.title', 'photos.photo_path', \DB::raw('avg(ratings.rating) as avg_rating'))
		->orderBy('avg_rating', 'desc')
		->groupBy('posts.id')
		->groupBy('posts.title')
		->groupBy('photos.photo_path')
		->where([
			['is_approved', '=', '1'],
			['photos.flag', '=', '1']
		])
		->take(Config::get('constant.numberRecord1'))
		->get();
        return view('pages.index',['new_post'=>$new_post,'top_rating'=>$top_rating]);
    }
    public function detail($id)
	{
		// if(Post::where('id',$id)->first() == null){
		// 	return view('includes.erro404');
		// }
		$post = Post::where('id',$id)->first();
		$post_id = DB::table('posts')
		->select('posts.id')
		->where('posts.id','=',$id)->first()->id;
		$data = DB::table('posts')
		->join('photos', 'posts.id', '=', 'photos.post_id')
		->join('users', 'posts.user_id', '=', 'users.id')
		->join('restaurants', 'posts.restaurant_id', '=', 'restaurants.id')
		->leftJoin('ratings', 'posts.id', '=', 'ratings.post_id')
		->leftJoin('users as userscmt', 'ratings.user_id', '=', 'userscmt.id')
		->select('posts.id', 'posts.restaurant_id', 'posts.title', 'posts.user_id', 'posts.describer','posts.id','posts.created_at as create_at', 'photos.photo_path', 'users.name', 'restaurants.name as restaurant', 'restaurants.lat', 'restaurants.lng','restaurants.address','ratings.id as rating_id' , 'ratings.rating as rate', 'ratings.created_at', 'userscmt.id as cmtid', 'userscmt.name as cmtname', 'userscmt.avatar')
		->where('posts.id', '=', $post_id)
		->get();
		$rating = DB::table('ratings')
		->where('post_id', $post_id)
		->avg('rating');
		$rating = number_format($rating, 1);
		$user_id = \Auth::id();
		$user_rate =  DB::table('ratings')->select('rating')->where([
			['user_id', '=', $user_id],
			['post_id', '=', $post_id],
		])->whereNotNull('rating')
		->orderBy('id', 'desc')->first();
		session()->put('link',  url()->current());
		$data2 = DB::table('posts')
		->join('photos', 'posts.id', '=', 'photos.post_id')
		->join('restaurants', 'posts.restaurant_id', '=', 'restaurants.id')
		->leftJoin('ratings', 'posts.id', '=', 'ratings.post_id')
		->select('posts.id', 'posts.title','posts.id', 'photos.photo_path')
		->where([
			['posts.restaurant_id', '=', $data[0]->restaurant_id],
			['photos.flag', '=', 1],
			['posts.id', '<>', $post_id]
		])
		->distinct()
		->take(Config::get('constant.numberRecord1'))
		->get();
		foreach ($data2 as $index => $value) {
			$value->rate = DB::table('ratings')
			->where('post_id', $value->id)
			->avg('rating');
		}
		return view('pages/detail', ['data' => $data, 'rating' => $rating, 'user_rate' => $user_rate,'post_relate'=>$data2]);
	}
	public function rate(Request $request)
	{
		$rating = $request->get('rating');
		if ($rating != NULL && $rating !=1 && $rating !=2 &&$rating !=3 && $rating !=4 && $rating !=5){
			return back();
		}
		//$cmt = htmlspecialchars($request->get('commentarea'));
		$user_id = Auth::id();
		$post_id = $request->session()->pull('post_id');
		$rate = new Rating;
		//$rate->cmt = $cmt;
		$rate->user_id = $user_id;
		$rate->post_id = $post_id;
		if ($rating === NULL) {
			$rate->save();
		} else {
			DB::table('ratings')->where([
				['user_id', '=', $user_id],
				['post_id', '=', $post_id],
			])->update(['rating' => null]);
			$rate->rating = $rating;
			$rate->save();
		}
		return back();
	}
    
}
