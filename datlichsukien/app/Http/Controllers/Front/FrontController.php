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
		
		->Paginate(9);
		$restaurant = DB::table('restaurants')->get();
        return view('pages.index',['top_rating'=>$top_rating,'restaurant'=>$restaurant,'all_post'=>$all_post]);
    }
    public function detail($id)
	{
		if(Post::where('id',$id)->first() == null){
			return view('includes.error404');
		}
		$post = Post::where('id',$id)->first();
		$post_id = DB::table('posts')
		->select('posts.id')
		->where('posts.id','=',$id)->first()->id;
		//dd($id);
		$data = DB::table('posts')
		->join('photos', 'posts.id', '=', 'photos.post_id')
		->join('users', 'posts.user_id', '=', 'users.id')
		->join('restaurants', 'posts.restaurant_id', '=', 'restaurants.id')
		->leftJoin('ratings', 'posts.id', '=', 'ratings.post_id')
		->leftJoin('users as userscmt', 'ratings.user_id', '=', 'userscmt.id')
		->select('posts.id', 'posts.restaurant_id','users.id','posts.title', 'posts.user_id', 'posts.describer','posts.id','posts.created_at as create_at', 'photos.photo_path', 'users.name', 'restaurants.name as restaurant', 'restaurants.lat', 'restaurants.longt','restaurants.address','ratings.id as rating_id' , 'ratings.rating as rate', 'ratings.created_at', 'userscmt.id as cmtid', 'userscmt.name as cmtname', 'userscmt.avatar','ratings.cmt')
		->where('posts.id', '=', $post_id)
		->get();
		
		$detail =DB::table('details')
		->join('restaurants', 'details.restaurant_id', '=', 'restaurants.id')
		->join('posts', 'posts.restaurant_id', '=', 'restaurants.id')
		->where('posts.id', '=', $post_id)
		->select('details.room','details.service','details.people_number','details.id')
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
		$strDay77 = date('Y-m-d', strtotime($strNow. ' + 7 days'));
		$strDay88 = date('Y-m-d', strtotime($strNow. ' + 8 days'));
		$strDay7 = date('Y-m-d', strtotime($strNow. ' + 7 days'));
		$strDay8 = date('Y-m-d', strtotime($strNow. ' + 8 days'));
		$strDay9 = date('Y-m-d', strtotime($strNow. ' + 9 days'));

		$strDay10 = date('Y-m-d', strtotime($strNow. ' + 10 days'));
		$strDay11 = date('Y-m-d', strtotime($strNow. ' + 11 days'));
		$strDay12 = date('Y-m-d', strtotime($strNow. ' + 12 days'));
		$strDay13 = date('Y-m-d', strtotime($strNow. ' + 13 days'));
		
		
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

         $ep_dateAvalible=explode ('"',$dateAvalible);
        
         $weekday1 = date('l', strtotime($strDay7));
         $weekday2 = date('l', strtotime($strDay8));
         $weekday3 = date('l', strtotime($strDay9));
         $weekday4 = date('l', strtotime($strDay10));
         $weekday5 = date('l', strtotime($strDay11));
         $weekday6 = date('l', strtotime($strDay12));
         $weekday7 = date('l', strtotime($strDay13));

         $detailAvalible1 = DB::table('orders')
                ->join('restaurants','restaurants.id','=','orders.restaurant_id')
		        ->join('posts','posts.restaurant_id','=','restaurants.id')
                ->select('orders.detail_id as id1')
                ->where([
                	['posts.id','=',$post_id],
                	[ 'orders.order_date','=',$strDay7]
                  ])
                ->get();
         $detailAvalible2 = DB::table('orders')
                ->join('restaurants','restaurants.id','=','orders.restaurant_id')
		        ->join('posts','posts.restaurant_id','=','restaurants.id')
                ->select('orders.detail_id as id1')
                ->where([
                	['posts.id','=',$post_id],
                	[ 'orders.order_date','=',$strDay8]
                  ])
                ->get();
          $detailAvalible3 = DB::table('orders')
                ->join('restaurants','restaurants.id','=','orders.restaurant_id')
		        ->join('posts','posts.restaurant_id','=','restaurants.id')
                ->select('orders.detail_id as id1')
                ->where([
                	['posts.id','=',$post_id],
                	[ 'orders.order_date','=',$strDay9]
                  ])
                ->get();
          $detailAvalible4 = DB::table('orders')
                ->join('restaurants','restaurants.id','=','orders.restaurant_id')
		        ->join('posts','posts.restaurant_id','=','restaurants.id')
                ->select('orders.detail_id as id1')
                ->where([
                	['posts.id','=',$post_id],
                	[ 'orders.order_date','=',$strDay10]
                  ])
                ->get();
          $detailAvalible5 = DB::table('orders')
                ->join('restaurants','restaurants.id','=','orders.restaurant_id')
		        ->join('posts','posts.restaurant_id','=','restaurants.id')
                ->select('orders.detail_id as id1')
                ->where([
                	['posts.id','=',$post_id],
                	[ 'orders.order_date','=',$strDay11]
                  ])
                ->get();
          $detailAvalible6 = DB::table('orders')
                ->join('restaurants','restaurants.id','=','orders.restaurant_id')
		        ->join('posts','posts.restaurant_id','=','restaurants.id')
                ->select('orders.detail_id as id1')
                ->where([
                	['posts.id','=',$post_id],
                	[ 'orders.order_date','=',$strDay12]
                  ])
                ->get();
          $detailAvalible7 = DB::table('orders')
                ->join('restaurants','restaurants.id','=','orders.restaurant_id')
		        ->join('posts','posts.restaurant_id','=','restaurants.id')
                ->select('orders.detail_id as id1')
                ->where([
                	['posts.id','=',$post_id],
                	[ 'orders.order_date','=',$strDay13]
                  ])
                ->get();
         // dd($detailAvalible1);

         $detailx =DB::table('details')
				->join('restaurants', 'details.restaurant_id', '=', 'restaurants.id')
				->join('posts', 'posts.restaurant_id', '=', 'restaurants.id')
				->where('posts.id', '=', $post_id)
				->select('details.id as id1')
				->get();
		//dd($detailx);
	     $ex_detailx=explode (':',$detailx);
	     $ex_detailAvalible1=explode (':',$detailAvalible1);
	     $ex_detailAvalible2=explode (':',$detailAvalible2);
	     $ex_detailAvalible3=explode (':',$detailAvalible3);
	     $ex_detailAvalible4=explode (':',$detailAvalible4);
	     $ex_detailAvalible5=explode (':',$detailAvalible5);
	     $ex_detailAvalible6=explode (':',$detailAvalible6);
	     $ex_detailAvalible7=explode (':',$detailAvalible7);

	     $result=array_diff($ex_detailx,$ex_detailAvalible1);
	     $result2=array_diff($ex_detailx,$ex_detailAvalible2);
	     $result3=array_diff($ex_detailx,$ex_detailAvalible3);
	     $result4=array_diff($ex_detailx,$ex_detailAvalible4);
	     $result5=array_diff($ex_detailx,$ex_detailAvalible5);
	     $result6=array_diff($ex_detailx,$ex_detailAvalible6);
	     $result7=array_diff($ex_detailx,$ex_detailAvalible7);

	     //dd($result6);
		//$x=array_diff($detailAvalible,$detailx);
	     $idrestaurant = DB::table('posts')
				->select('posts.restaurant_id')
				->where('posts.id','=',$id)->first()->restaurant_id;
			//dd($idre);
        $iddetailorder = DB::table('orders')
                ->join('restaurants','restaurants.id','=','orders.restaurant_id')
 				->join('posts','posts.restaurant_id','=','restaurants.id')
 				->join('details','details.id','=','orders.detail_id')
 				->select('orders.detail_id','details.id','details.room','details.service','details.people_number')
 				->where([
 				['order_date', '=', $strDay7],
 				['posts.id', '=', $id]
 			])
			->get();
		//dd($iddetailorder);
        $iddetail =DB::table('details')
 			->select('details.id','details.room','details.service','details.people_number')
 			->where('details.restaurant_id', '=', $idrestaurant)
 			->whereNotIn('id', DB::table('orders')
                ->join('restaurants','restaurants.id','=','orders.restaurant_id')
 				->join('posts','posts.restaurant_id','=','restaurants.id')
 				->select('detail_id')->where([
 			    ['order_date', '=', $strDay7],
 				['posts.id', '=', $id]
 			       ]))
			->get();

		$iddetailorder1 = DB::table('orders')
                ->join('restaurants','restaurants.id','=','orders.restaurant_id')
 				->join('posts','posts.restaurant_id','=','restaurants.id')
 				->join('details','details.id','=','orders.detail_id')
 				->select('orders.detail_id','details.id','details.room','details.service','details.people_number')
 				->where([
 				['order_date', '=', $strDay8],
 				['posts.id', '=', $id]
 			])
			->get();
		//dd($iddetailorder);
        $iddetail1 =DB::table('details')
 			->select('details.id','details.room','details.service','details.people_number')
 			->where('details.restaurant_id', '=', $idrestaurant)
 			->whereNotIn('id', DB::table('orders')
                ->join('restaurants','restaurants.id','=','orders.restaurant_id')
 				->join('posts','posts.restaurant_id','=','restaurants.id')
 				->select('detail_id')->where([
 			    ['order_date', '=', $strDay8],
 				['posts.id', '=', $id]
 			       ]))
			->get();
      //  dd($iddetail);

		return view('pages/detail', ['data' => $data, 'rating' => $rating,'detail'=>$detail, 'user_rate' => $user_rate, 'strDay7' => $strDay7,'strDay8' => $strDay8,'strDay9' => $strDay9,'strDay10' => $strDay10,'strDay11' => $strDay11,'strDay12' => $strDay12,'strDay13' => $strDay13, 'dateAvalible' => $dateAvalible,'result'=>$result,'result2'=>$result2,'result3'=>$result3,'result4'=>$result4,'result5'=>$result5,'result6'=>$result6,'result7'=>$result7,'weekday1'=>$weekday1,'weekday2'=>$weekday2,'weekday3'=>$weekday3,'weekday4'=>$weekday4,'weekday5'=>$weekday5,'weekday6'=>$weekday6,'weekday7'=>$weekday7,'iddetailorder'=>$iddetailorder,'iddetail'=>$iddetail,'strDay77'=>$strDay77,'iddetailorder1'=>$iddetailorder1,'iddetail1'=>$iddetail1,'strDay88'=>$strDay88]);

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
    public function upgrade(Request $request)
	{
		$user = Auth::user();
		$user->role = '2';
		$user->save();
		return redirect('/');
	}
}