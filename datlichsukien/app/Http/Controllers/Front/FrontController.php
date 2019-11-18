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
		$strDay8 = date('Y-m-d', strtotime($strNow. ' + 8 days'));
		$strDay9 = date('Y-m-d', strtotime($strNow. ' + 9 days'));
		$strDay10 = date('Y-m-d', strtotime($strNow. ' + 10 days'));
		$strDay11 = date('Y-m-d', strtotime($strNow. ' + 11 days'));
		$strDay12 = date('Y-m-d', strtotime($strNow. ' + 12 days'));
		$strDay13 = date('Y-m-d', strtotime($strNow. ' + 13 days'));
		
		// $strDay72 = new DateTime( $strDay7 );

		// $strDay14 = date('Y-m-d', strtotime($strNow. ' + 13 days'));
		// $strDay142 = new DateTime( $strDay14 );

		// $arrDay = array();
		// for($i = $strDay72; $i <= $strDay142; $i->modify('+1 day')){
		//     // $i->format("Y-m-d");
		//     array_push($arrDay,$i->format("Y-m-d"));
		// }
		// dd($arrDay);
	    $strDay1=explode (',',$strDay7);
	    $strDay2=explode (',',$strDay8);
	    $strDay3=explode (',',$strDay9);
	    $strDay4=explode (',',$strDay10);
	    $strDay5=explode (',',$strDay11);
	    $strDay6=explode (',',$strDay12);
	    $strDay0=explode (',',$strDay13);
		$dateAvalible = DB::table('orders')
		        ->join('posts','posts.restaurant_id','=','orders.restaurant_id')
                ->select('orders.order_date')
                ->where('posts.id','=',$post_id)->get();
        //dd($dateAvalible);
         $ep_dateAvalible=explode ('"',$dateAvalible);
         
         $result=array_diff($strDay1,$ep_dateAvalible);
         $result2=array_diff($strDay2,$ep_dateAvalible);
         $result3=array_diff($strDay3,$ep_dateAvalible);
         $result4=array_diff($strDay4,$ep_dateAvalible);
         $result5=array_diff($strDay5,$ep_dateAvalible);
         $result6=array_diff($strDay6,$ep_dateAvalible);
         $result7=array_diff($strDay0,$ep_dateAvalible);
         
         $weekday1 = date('l', strtotime($strDay7));
         $weekday2 = date('l', strtotime($strDay8));
         $weekday3 = date('l', strtotime($strDay9));
         $weekday4 = date('l', strtotime($strDay10));
         $weekday5 = date('l', strtotime($strDay11));
         $weekday6 = date('l', strtotime($strDay12));
         $weekday7 = date('l', strtotime($strDay13));

         //dd($weekday5);
		return view('pages/detail', ['data' => $data, 'rating' => $rating, 'user_rate' => $user_rate, 'strDay7' => $strDay7,'strDay8' => $strDay8,'strDay9' => $strDay9,'strDay10' => $strDay10,'strDay11' => $strDay11,'strDay12' => $strDay12,'strDay13' => $strDay13, 'dateAvalible' => $dateAvalible,'result'=>$result,'result2'=>$result2,'result3'=>$result3,'result4'=>$result4,'result5'=>$result5,'result6'=>$result6,'result7'=>$result7,'weekday1'=>$weekday1,'weekday2'=>$weekday2,'weekday3'=>$weekday3,'weekday4'=>$weekday4,'weekday5'=>$weekday5,'weekday6'=>$weekday6,'weekday7'=>$weekday7]);
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
