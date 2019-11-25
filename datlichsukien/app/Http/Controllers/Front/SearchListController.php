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
       $restaurantid = DB::table('orders')
       ->select('orders.restaurant_id')
       ->where('orders.order_date','=',$search)->get();
       dd($restaurantid);
		$post= DB::table('posts')
		->join('restaurants','posts.restaurant_id','=','restaurants.id')
		->join('orders','posts.restaurant_id','=','orders.restaurant_id')
		->leftjoin('ratings', 'posts.id', '=', 'ratings.post_id')
		->join('photos', 'posts.id', '=', 'photos.post_id')->select('posts.id','posts.describer','restaurants.address', 'posts.title','photos.photo_path',\DB::raw('avg(ratings.rating) as avg_rating'))->groupBy('posts.id')->groupBy('posts.title')->groupBy('photos.photo_path')->groupBy('posts.describer')->groupBy('restaurants.address')
		->where([
			['orders.order_date','LIKE','%'.$search.'%'],
			['photos.flag', '=', '1'],
			['is_approved','=','1']
			
		])
		->Paginate(Config::get('constant.pagination'));
		$post->appends([$search1=>$search]);
		return view('pages.searchDate',['post' => $post],[$search=>$search]);
    }
}
