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
use App\Order;
use App\Restaurant;
use DB;
use DateTime;

class FrontController extends Controller
{
     public function index()
    {
	
		//show posts have rating highest
		$top_rating = Post::join('ratings', 'posts.id', '=', 'ratings.post_id')
		->join('photos', 'posts.id', '=', 'photos.post_id')
		->join('restaurants','posts.restaurant_id','=','restaurants.id')
		->select('posts.id', 'posts.title', 'photos.photo_path','restaurants.name','restaurants.address', \DB::raw('avg(ratings.rating) as avg_rating'))
		->orderBy('avg_rating', 'desc')
		->groupBy('posts.id')
		->groupBy('posts.title')
		->groupBy('restaurants.name')
		->groupBy('restaurants.address')
		->groupBy('photos.photo_path')
		->where([
			['is_approved', '=', '1'],
			['photos.flag', '=', '1']
		])
		->take(Config::get('constant.numberRecord1'))
		->get();
        //show all post
		$all_post = Post::join('photos', 'posts.id', '=', 'photos.post_id')
		->leftjoin('ratings', 'posts.id', '=', 'ratings.post_id')
		->join('restaurants','posts.restaurant_id','=','restaurants.id')
		->select('posts.id', 'title', 'photos.photo_path','restaurants.name','restaurants.address', \DB::raw('avg(ratings.rating) as avg_rating'))
		->orderBy('posts.id', 'desc')
		->groupBy('posts.id')
		->groupBy('title')
		->groupBy('restaurants.name')
		->groupBy('restaurants.address')
		->groupBy('photos.photo_path')
		->where([
			['is_approved', '=', '1'],
			['photos.flag', '=', '1']
		])
		->take(Config::get('constant.numberRecord3'))
		->get();
		$restaurant = DB::table('restaurants')->get();
        return view('pages.index',['top_rating'=>$top_rating,'restaurant'=>$restaurant,'all_post'=>$all_post]);
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
		->select('posts.id', 'posts.restaurant_id', 'posts.title', 'posts.user_id', 'posts.describer','posts.id','posts.created_at as create_at', 'photos.photo_path', 'users.name', 'restaurants.name as restaurant', 'restaurants.lat', 'restaurants.longt','restaurants.address','ratings.id as rating_id' , 'ratings.rating as rate', 'ratings.created_at', 'userscmt.id as cmtid', 'userscmt.name as cmtname', 'userscmt.avatar')
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
		
		$strNow =  date("Y-m-d");
		$strDay7 = date('Y-m-d', strtotime($strNow. ' + 7 days'));
		$strDay72 = new DateTime( $strDay7 );

		$strDay14 = date('Y-m-d', strtotime($strNow. ' + 14 days'));
		$strDay142 = new DateTime( $strDay14 );

		$arrDay = array();
		for($i = $strDay72; $i <= $strDay142; $i->modify('+1 day')){
		    // $i->format("Y-m-d");
		    array_push($arrDay,$i->format("Y-m-d"));
		}
		// dd($arrDay);

		$dateAvalible = DB::table('orders')
			->where('restaurant_id','=',$id)
			->select('order_date')
			->get();
		// dd($dateAvalible);
		 $arrDayNotAvalble = array();
		foreach ($dateAvalible as $key => $value) {
			array_push($arrDayNotAvalble,$value);

		}
		// dd($arrDayNotAvalble);
		$result=array_diff($arrDay,$arrDayNotAvalble);

		dd($result);
		return view('pages/detail', ['data' => $data, 'rating' => $rating, 'user_rate' => $user_rate, 'strDay7' => $strDay7, 'dateAvalible' => $dateAvalible, 'arrDay' => $arrDay]);
	}
	public function rate(Request $request)
	{
		$rating = $request->get('rating');
		$stars = $request->get('inputHidenRating');
		if ($rating != NULL && $rating !=1 && $rating !=2 &&$rating !=3 && $rating !=4 && $rating !=5){
			return back();
		}
		$cmt = htmlspecialchars($request->get('commentarea'));
		$user_id = Auth::id();
		$post_id = $request->session()->pull('post_id');
		$rate = new Rating;
		$rate->cmt = $cmt;
		$rate->user_id = $user_id;
		$rate->post_id = $post_id;
		if ($stars === NULL) {
			$rate->save();
		} else {
			DB::table('ratings')->where([
				['user_id', '=', $user_id],
				['post_id', '=', $post_id],
			])->update(['rating' => null]);
			$rate->rating = $stars;
			$rate->save();
		}
		return back();
	}
    public function checkdate(Request $request){
       $order_date =$request->order_date;
        $order = DB::table('orders')->select('orders.order_date')->get();
       // dd($order);
        
       if($order_date==$order ) {
          printf('a');
       }
       else printf("format");
    }
}
