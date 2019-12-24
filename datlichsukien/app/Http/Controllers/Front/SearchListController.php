<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Photo;
use App\Restaurant;
use App\Post;
use App\Rating;
use DB;
use Config;
class SearchListController extends Controller
{
   public function getsearch(Request $request)
	{   
		$search1 ='search';
        $this->validate($request,
        [
            $search1=>'required',
        ],
        [
            'search.required'=>'Bạn chưa nhập từ khóa tìm kiếm',
        ]
    );
		$search = $request ->search;

		$post= DB::table('posts')
		->join('restaurants','posts.restaurant_id','=','restaurants.id')
		->leftjoin('ratings', 'posts.id', '=', 'ratings.post_id')
		->join('photos', 'posts.id', '=', 'photos.post_id')->select('posts.id','posts.describer','restaurants.address', 'posts.title','photos.photo_path',\DB::raw('avg(ratings.rating) as avg_rating'))->groupBy('posts.id')->groupBy('posts.title')->groupBy('photos.photo_path')->groupBy('posts.describer')->groupBy('restaurants.address')
		->where([
			['restaurants.name','LIKE','%'.$search.'%'],
			['photos.flag', '=', '1'],
			['is_approved','=','1']
			
		])
		->Paginate(Config::get('constant.pagination'));
		$post->appends([$search1=>$search]);
		return view('pages.searchList',['post' => $post],[$search1=>$search]);
	}
    
    public function autocomplete(Request $request)
    {
        $data = Restaurant::select("name")
                ->where("name","LIKE","%{$request->input('query')}%")
                ->get();
        return response()->json($data);
    }
    public function search_date(Request $request)
    {
       $search1 ='date';
        
       $search = $request ->date;

       // SYY
       // dd($search);
       // dd(var_dump($search));
   //     $finRestaurantNotOdder = DB::table('orders')
   //     		->leftjoin('restaurants','orders.restaurant_id','=','restaurants.id')
 		// 	->select('restaurants.id')
 		// 	->whereDate('orders.order_date','=',date($search))
 		// 	->distinct()
 		// 	->get();
 		$finRestaurantNotOdder =DB::table('restaurants')
 			->select('id')
 			->whereNotIn('id', DB::table('orders')->select('restaurant_id')->where('order_date', '=', $search))
			->get();
       
    	foreach ($finRestaurantNotOdder as $finRestaurantNotOdder) {
                $data[] = $finRestaurantNotOdder->id;
            }
            // dd($data);
 		// dd($data);
 		// dd($finRestaurantNotOdder);

       // $restaurantid = DB::table('orders')
       // ->select('orders.restaurant_id')
       // ->where('orders.order_date','=',$search)->get();
       //dd($restaurantid);
		$post= DB::table('posts')
		->join('restaurants','posts.restaurant_id','=','restaurants.id')
		->join('orders','posts.restaurant_id','=','orders.restaurant_id')
		->leftjoin('ratings', 'posts.id', '=', 'ratings.post_id')
		->join('photos', 'posts.id', '=', 'photos.post_id')->select('posts.id','posts.describer','restaurants.address', 'posts.title','photos.photo_path',\DB::raw('avg(ratings.rating) as avg_rating'))->groupBy('posts.id')->groupBy('posts.title')->groupBy('photos.photo_path')->groupBy('posts.describer')->groupBy('restaurants.address')
		->where([
			
			['photos.flag', '=', '1'],
			['is_approved','=','1']
		])
		->whereIn('restaurants.id', $data)
		->get();
		 dd($post);
		$post->appends([$search1=>$search]);
		return view('pages.searchDate',['post' => $post],[$search=>$search]);
    }

    public function search_number_people()
    {

      $post= DB::table('posts')
      ->join('restaurants','posts.restaurant_id','=','restaurants.id')
      ->join('details','details.restaurant_id','=','restaurants.id')
      ->leftjoin('ratings', 'posts.id', '=', 'ratings.post_id')
      ->join('photos', 'posts.id', '=', 'photos.post_id')->select('posts.id','posts.describer','restaurants.address', 'posts.title','photos.photo_path',\DB::raw('avg(ratings.rating) as avg_rating'))->groupBy('posts.id')->groupBy('posts.title')->groupBy('photos.photo_path')->groupBy('posts.describer')->groupBy('restaurants.address')
      ->where('details.people_number','<' ,500)
      ->where([
        ['photos.flag', '=', '1'],
        ['is_approved','=','1']
        
      ])
      ->Paginate(Config::get('constant.pagination'));
      return view('pages.search_Numberpeople',['post' => $post]);
    }
    public function searchNumberPeople()
    {

      $post= DB::table('posts')
      ->join('restaurants','posts.restaurant_id','=','restaurants.id')
      ->join('details','details.restaurant_id','=','restaurants.id')
      ->leftjoin('ratings', 'posts.id', '=', 'ratings.post_id')
      ->join('photos', 'posts.id', '=', 'photos.post_id')->select('posts.id','posts.describer','restaurants.address', 'posts.title','photos.photo_path',\DB::raw('avg(ratings.rating) as avg_rating'))->groupBy('posts.id')->groupBy('posts.title')->groupBy('photos.photo_path')->groupBy('posts.describer')->groupBy('restaurants.address')
      ->whereBetween('details.people_number', array(500, 1000))
      ->where([
        ['photos.flag', '=', '1'],
        ['is_approved','=','1']
        
      ])
      ->Paginate(Config::get('constant.pagination'));
      return view('pages.search_Number_People',['post' => $post]);
    }
    public function search_people()
    {

      $post= DB::table('posts')
      ->join('restaurants','posts.restaurant_id','=','restaurants.id')
      ->join('details','details.restaurant_id','=','restaurants.id')
      ->leftjoin('ratings', 'posts.id', '=', 'ratings.post_id')
      ->join('photos', 'posts.id', '=', 'photos.post_id')->select('posts.id','posts.describer','restaurants.address', 'posts.title','photos.photo_path',\DB::raw('avg(ratings.rating) as avg_rating'))->groupBy('posts.id')->groupBy('posts.title')->groupBy('photos.photo_path')->groupBy('posts.describer')->groupBy('restaurants.address')
      ->where('details.people_number','>' ,1000)
      ->where([
        ['photos.flag', '=', '1'],
        ['is_approved','=','1']
        
      ])
      ->Paginate(Config::get('constant.pagination'));
      return view('pages.search_people',['post' => $post]);
    }
    public function search_pricetable()
    {

      $post= DB::table('posts')
      ->join('restaurants','posts.restaurant_id','=','restaurants.id')
      ->join('details','details.restaurant_id','=','restaurants.id')
      ->leftjoin('ratings', 'posts.id', '=', 'ratings.post_id')
      ->join('photos', 'posts.id', '=', 'photos.post_id')->select('posts.id','posts.describer','restaurants.address', 'posts.title','photos.photo_path',\DB::raw('avg(ratings.rating) as avg_rating'))->groupBy('posts.id')->groupBy('posts.title')->groupBy('photos.photo_path')->groupBy('posts.describer')->groupBy('restaurants.address')
      ->where('details.price','<' ,2000000)
      ->where([
        ['photos.flag', '=', '1'],
        ['is_approved','=','1']
        
      ])
      ->Paginate(Config::get('constant.pagination'));
      return view('pages.search_pricetable',['post' => $post]);
    }
    public function searchpricetable()
    {

      $post= DB::table('posts')
      ->join('restaurants','posts.restaurant_id','=','restaurants.id')
      ->join('details','details.restaurant_id','=','restaurants.id')
      ->leftjoin('ratings', 'posts.id', '=', 'ratings.post_id')
      ->join('photos', 'posts.id', '=', 'photos.post_id')->select('posts.id','posts.describer','restaurants.address', 'posts.title','photos.photo_path',\DB::raw('avg(ratings.rating) as avg_rating'))->groupBy('posts.id')->groupBy('posts.title')->groupBy('photos.photo_path')->groupBy('posts.describer')->groupBy('restaurants.address')
      ->whereBetween('details.price', array(2000000, 5000000))
      ->where([
        ['photos.flag', '=', '1'],
        ['is_approved','=','1']
        
      ])
      ->Paginate(Config::get('constant.pagination'));
      return view('pages.searchpricetable',['post' => $post]);
    }
    public function search_price_table()
    {

      $post= DB::table('posts')
      ->join('restaurants','posts.restaurant_id','=','restaurants.id')
      ->join('details','details.restaurant_id','=','restaurants.id')
      ->leftjoin('ratings', 'posts.id', '=', 'ratings.post_id')
      ->join('photos', 'posts.id', '=', 'photos.post_id')->select('posts.id','posts.describer','restaurants.address', 'posts.title','photos.photo_path',\DB::raw('avg(ratings.rating) as avg_rating'))->groupBy('posts.id')->groupBy('posts.title')->groupBy('photos.photo_path')->groupBy('posts.describer')->groupBy('restaurants.address')
      ->whereBetween('details.price', array(5000000, 10000000))
      ->where([
        ['photos.flag', '=', '1'],
        ['is_approved','=','1']
        
      ])
      ->Paginate(Config::get('constant.pagination'));
      return view('pages.search_price_table',['post' => $post]);
    }
    public function search_price()
    {

      $post= DB::table('posts')
      ->join('restaurants','posts.restaurant_id','=','restaurants.id')
      ->join('details','details.restaurant_id','=','restaurants.id')
      ->leftjoin('ratings', 'posts.id', '=', 'ratings.post_id')
      ->join('photos', 'posts.id', '=', 'photos.post_id')->select('posts.id','posts.describer','restaurants.address', 'posts.title','photos.photo_path',\DB::raw('avg(ratings.rating) as avg_rating'))->groupBy('posts.id')->groupBy('posts.title')->groupBy('photos.photo_path')->groupBy('posts.describer')->groupBy('restaurants.address')
      ->where('details.price','>' ,10000000)
      ->where([
        ['photos.flag', '=', '1'],
        ['is_approved','=','1']
        
      ])
      ->Paginate(Config::get('constant.pagination'));
      return view('pages.search_price',['post' => $post]);
    }
}
