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
		
		->Paginate(12);
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
		->select('posts.id', 'posts.restaurant_id','users.id','posts.title', 'posts.user_id', 'posts.describer','posts.id','posts.created_at as create_at', 'photos.photo_path', 'users.name', 'restaurants.name as restaurant', 'restaurants.lat', 'restaurants.longt','restaurants.address','restaurants.phone','ratings.id as rating_id' , 'ratings.rating as rate', 'ratings.created_at', 'userscmt.id as cmtid', 'userscmt.name as cmtname', 'userscmt.avatar','ratings.cmt')
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
        
         $weekday11 = date('l', strtotime($strDay7));
         $weekday22 = date('l', strtotime($strDay8));
         $weekday33 = date('l', strtotime($strDay9));
         $weekday44 = date('l', strtotime($strDay10));
         $weekday55 = date('l', strtotime($strDay11));
         $weekday66 = date('l', strtotime($strDay12));
         $weekday77 = date('l', strtotime($strDay13));
         
         switch($weekday11) {
		  case 'Monday':  // if (x === 'value1')
		    $weekday1='Thứ 2';
		    break;

		  case 'Tuesday':  // if (x === 'value2')
		     $weekday1='Thứ 3';
		    break;
          case 'Wednesday':  // if (x === 'value2')
		     $weekday1='Thứ 4';
		    break;
		  case 'Thursday':  // if (x === 'value2')
		     $weekday1='Thứ 5';
		    break;
		  case 'Friday':  // if (x === 'value2')
		     $weekday1='Thứ 6';
		    break;
          case 'Saturday':  // if (x === 'value2')
		     $weekday1='Thứ 7';
		    break;

		  default:
		     $weekday1='Chủ nhật';
		    break;
		}
		 switch($weekday22) {
		  case 'Monday':  // if (x === 'value1')
		    $weekday2='Thứ 2';
		    break;

		  case 'Tuesday':  // if (x === 'value2')
		     $weekday2='Thứ 3';
		    break;
          case 'Wednesday':  // if (x === 'value2')
		     $weekday2='Thứ 4';
		    break;
		  case 'Thursday':  // if (x === 'value2')
		     $weekday2='Thứ 5';
		    break;
		  case 'Friday':  // if (x === 'value2')
		     $weekday2='Thứ 6';
		    break;
          case 'Saturday':  // if (x === 'value2')
		     $weekday2='Thứ 7';
		    break;

		  default:
		     $weekday2='Chủ nhật';
		    break;
		}
		 switch($weekday33) {
		  case 'Monday':  // if (x === 'value1')
		    $weekday3='Thứ 2';
		    break;

		  case 'Tuesday':  // if (x === 'value2')
		     $weekday3='Thứ 3';
		    break;
          case 'Wednesday':  // if (x === 'value2')
		     $weekday3='Thứ 4';
		    break;
		  case 'Thursday':  // if (x === 'value2')
		     $weekday3='Thứ 5';
		    break;
		  case 'Friday':  // if (x === 'value2')
		     $weekday3='Thứ 6';
		    break;
          case 'Saturday':  // if (x === 'value2')
		     $weekday3='Thứ 7';
		    break;

		  default:
		     $weekday3='Chủ nhật';
		    break;
		}
		 switch($weekday44) {
		  case 'Monday':  // if (x === 'value1')
		    $weekday4='Thứ 2';
		    break;

		  case 'Tuesday':  // if (x === 'value2')
		     $weekday4='Thứ 3';
		    break;
          case 'Wednesday':  // if (x === 'value2')
		     $weekday4='Thứ 4';
		    break;
		  case 'Thursday':  // if (x === 'value2')
		     $weekday4='Thứ 5';
		    break;
		  case 'Friday':  // if (x === 'value2')
		     $weekday4='Thứ 6';
		    break;
          case 'Saturday':  // if (x === 'value2')
		     $weekday4='Thứ 7';
		    break;

		  default:
		     $weekday4='Chủ nhật';
		    break;
		}
		 switch($weekday55) {
		  case 'Monday':  // if (x === 'value1')
		    $weekday5='Thứ 2';
		    break;

		  case 'Tuesday':  // if (x === 'value2')
		     $weekday5='Thứ 3';
		    break;
          case 'Wednesday':  // if (x === 'value2')
		     $weekday5='Thứ 4';
		    break;
		  case 'Thursday':  // if (x === 'value2')
		     $weekday5='Thứ 5';
		    break;
		  case 'Friday':  // if (x === 'value2')
		     $weekday5='Thứ 6';
		    break;
          case 'Saturday':  // if (x === 'value2')
		     $weekday5='Thứ 7';
		    break;

		  default:
		     $weekday5='Chủ nhật';
		    break;
		}
		 switch($weekday66) {
		  case 'Monday':  // if (x === 'value1')
		    $weekday6='Thứ 2';
		    break;

		  case 'Tuesday':  // if (x === 'value2')
		     $weekday6='Thứ 3';
		    break;
          case 'Wednesday':  // if (x === 'value2')
		     $weekday6='Thứ 4';
		    break;
		  case 'Thursday':  // if (x === 'value2')
		     $weekday6='Thứ 5';
		    break;
		  case 'Friday':  // if (x === 'value2')
		     $weekday6='Thứ 6';
		    break;
          case 'Saturday':  // if (x === 'value2')
		     $weekday6='Thứ 7';
		    break;

		  default:
		     $weekday6='Chủ nhật';
		    break;
		}
		 switch($weekday77) {
		  case 'Monday':  // if (x === 'value1')
		    $weekday7='Thứ 2';
		    break;

		  case 'Tuesday':  // if (x === 'value2')
		     $weekday7='Thứ 3';
		    break;
          case 'Wednesday':  // if (x === 'value2')
		     $weekday7='Thứ 4';
		    break;
		  case 'Thursday':  // if (x === 'value2')
		     $weekday7='Thứ 5';
		    break;
		  case 'Friday':  // if (x === 'value2')
		     $weekday7='Thứ 6';
		    break;
          case 'Saturday':  // if (x === 'value2')
		     $weekday7='Thứ 7';
		    break;

		  default:
		     $weekday7='Chủ nhật';
		    break;
		}

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
		      
	     $ex_detailx=explode (':',$detailx);
	     $ex_detailAvalible1=explode (':',$detailAvalible1);
	     $ex_detailAvalible2=explode (':',$detailAvalible2);
	     $ex_detailAvalible3=explode (':',$detailAvalible3);
	     $ex_detailAvalible4=explode (':',$detailAvalible4);
	     $ex_detailAvalible5=explode (':',$detailAvalible5);
	     $ex_detailAvalible6=explode (':',$detailAvalible6);
	     $ex_detailAvalible7=explode (':',$detailAvalible7);
         foreach ($detailx as $detailx ) {	
					$datax[] = $detailx->id1; 
				}
		// dd($ex_detailAvalible4);
        $arrayName = array(1 => '[]' );
		 $arr_detailAvalible1=array_diff($ex_detailAvalible1,$arrayName);
		 //dd($result);
         if(!empty($arr_detailAvalible1)){
         	    foreach ($detailAvalible1 as $detailAvalible1 ) {	
					$data1[] = $detailAvalible1->id1; 
				}
				$result=array_diff($datax,$data1);
		       // dd($result);
         }else{
         	$result='a';
         }
		
		 $arr_detailAvalible2=array_diff($ex_detailAvalible2,$arrayName);
         if(!empty($arr_detailAvalible2)){
         	    foreach ($detailAvalible2 as $detailAvalible2 ) {	
					$data2[] = $detailAvalible2->id1; 
				}
				$result2=array_diff($datax,$data2);
         }else{
         	$result2='a';
         }

         $arr_detailAvalible3=array_diff($ex_detailAvalible3,$arrayName);
         if(!empty($arr_detailAvalible3)){
         	    foreach ($detailAvalible3 as $detailAvalible3 ) {	
					$data3[] = $detailAvalible3->id1; 
				}
				$result3=array_diff($datax,$data3);
         }else{
         	$result3='a';
         }

         $arr_detailAvalible4=array_diff($ex_detailAvalible4,$arrayName);
         if(!empty($arr_detailAvalible4)){
         	    foreach ($detailAvalible4 as $detailAvalible4 ) {	
					$data4[] = $detailAvalible4->id1; 
				}
				$result4=array_diff($datax,$data4);
         }else{
         	$result4='a';
         }
         $arr_detailAvalible5=array_diff($ex_detailAvalible5,$arrayName);
         if(!empty($arr_detailAvalible5)){
         	    foreach ($detailAvalible5 as $detailAvalible5 ) {	
					$data5[] = $detailAvalible5->id1; 
				}
				$result5=array_diff($datax,$data5);
         }else{
         	$result5='a';
         }

         $arr_detailAvalible6=array_diff($ex_detailAvalible6,$arrayName);
         if(!empty($arr_detailAvalible6)){
         	    foreach ($detailAvalible6 as $detailAvalible6 ) {	
					$data6[] = $detailAvalible6->id1; 
				}
				$result6=array_diff($datax,$data6);
         }else{
         	$result6='a';
         }

         $arr_detailAvalible7=array_diff($ex_detailAvalible7,$arrayName);
         if(!empty($arr_detailAvalible7)){
         	    foreach ($detailAvalible7 as $detailAvalible7 ) {	
					$data7[] = $detailAvalible7->id1; 
				}
				$result7=array_diff($datax,$data7);
         }else{
         	$result7='a';
         }
	     
	     $idrestaurant = DB::table('posts')
	     ->select('posts.restaurant_id')
	     ->where('posts.id','=',$id)->first()->restaurant_id;
			//dd($idre);

				$iddetailorder = DB::table('orders')
				->join('restaurants','restaurants.id','=','orders.restaurant_id')
				->join('posts','posts.restaurant_id','=','restaurants.id')
				->join('details','details.id','=','orders.detail_id')
				->select('orders.detail_id','details.id','details.room','details.service','details.people_number','details.price')
				->where([
					['order_date', '=', $strDay7],
					['posts.id', '=', $id]
				])
				->get();
				$arrdetailorder = '';
				foreach ($iddetailorder as $d ) {
			// dd($d.id);	
					$arrdetailorder = $arrdetailorder . (string)$d->id . ':' . (string)$d->room .':'. (string)$d->service .':'. (string)$d->people_number .':'. (string)$d->price .','; 
				}
		//dd($iddetailorder);
				$iddetail =DB::table('details')
				->select('details.id','details.room','details.service','details.people_number','details.price')
				->where('details.restaurant_id', '=', $idrestaurant)
				->whereNotIn('id', DB::table('orders')
					->join('restaurants','restaurants.id','=','orders.restaurant_id')
					->join('posts','posts.restaurant_id','=','restaurants.id')
					->select('detail_id')->where([
						['order_date', '=', $strDay7],
						['posts.id', '=', $id]
					]))
				->get();
				$arr = '';
				foreach ($iddetail as $d ) {	
					$arr = $arr . (string)$d->id . ':' . (string)$d->room .':'. (string)$d->service .':'. (string)$d->people_number .':'.(string)$d->price .','; 
				}
		
				$iddetailorder1 = DB::table('orders')
				->join('restaurants','restaurants.id','=','orders.restaurant_id')
				->join('posts','posts.restaurant_id','=','restaurants.id')
				->join('details','details.id','=','orders.detail_id')
				->select('orders.detail_id','details.id','details.room','details.service','details.people_number','details.price')
				->where([
					['order_date', '=', $strDay8],
					['posts.id', '=', $id]
				])
				->get();
	
				$arrdetailorder1 = '';
				foreach ($iddetailorder1 as $d ) {	
					$arrdetailorder1 = $arrdetailorder1 . (string)$d->id . ':' . (string)$d->room .':'. (string)$d->service .':'. (string)$d->people_number .':'.(string)$d->price .','; 
				}
				$iddetail1 =DB::table('details')
				->select('details.id','details.room','details.service','details.people_number','details.price')
				->where('details.restaurant_id', '=', $idrestaurant)
				->whereNotIn('id', DB::table('orders')
					->join('restaurants','restaurants.id','=','orders.restaurant_id')
					->join('posts','posts.restaurant_id','=','restaurants.id')
					->select('detail_id')->where([
						['order_date', '=', $strDay8],
						['posts.id', '=', $id]
					]))
				->get();
				$arr1 = '';
				foreach ($iddetail1 as $d ) {	
					$arr1 = $arr1 . (string)$d->id . ':' . (string)$d->room .':'. (string)$d->service .':'. (string)$d->people_number .':'.(string)$d->price .','; 
				}

				$iddetailorder2 = DB::table('orders')
				->join('restaurants','restaurants.id','=','orders.restaurant_id')
				->join('posts','posts.restaurant_id','=','restaurants.id')
				->join('details','details.id','=','orders.detail_id')
				->select('orders.detail_id','details.id','details.room','details.service','details.people_number','details.price')
				->where([
					['order_date', '=', $strDay9],
					['posts.id', '=', $id]
				])
				->get();
	
				$arrdetailorder2 = '';
				foreach ($iddetailorder2 as $d ) {	
					$arrdetailorder2 = $arrdetailorder2 . (string)$d->id . ':' . (string)$d->room .':'. (string)$d->service .':'. (string)$d->people_number .':'.(string)$d->price .','; 
				}
				$iddetail2 =DB::table('details')
				->select('details.id','details.room','details.service','details.people_number','details.price')
				->where('details.restaurant_id', '=', $idrestaurant)
				->whereNotIn('id', DB::table('orders')
					->join('restaurants','restaurants.id','=','orders.restaurant_id')
					->join('posts','posts.restaurant_id','=','restaurants.id')
					->select('detail_id')->where([
						['order_date', '=', $strDay9],
						['posts.id', '=', $id]
					]))
				->get();
				$arr2 = '';
				foreach ($iddetail2 as $d ) {	
					$arr2 = $arr2 . (string)$d->id . ':' . (string)$d->room .':'. (string)$d->service .':'. (string)$d->people_number .':'.(string)$d->price .','; 
				}

				$iddetailorder3 = DB::table('orders')
				->join('restaurants','restaurants.id','=','orders.restaurant_id')
				->join('posts','posts.restaurant_id','=','restaurants.id')
				->join('details','details.id','=','orders.detail_id')
				->select('orders.detail_id','details.id','details.room','details.service','details.people_number','details.price')
				->where([
					['order_date', '=', $strDay10],
					['posts.id', '=', $id]
				])
				->get();
	
				$arrdetailorder3 = '';
				foreach ($iddetailorder3 as $d ) {	
					$arrdetailorder3 = $arrdetailorder3 . (string)$d->id . ':' . (string)$d->room .':'. (string)$d->service .':'. (string)$d->people_number .':'.(string)$d->price .','; 
				}
				$iddetail3 =DB::table('details')
				->select('details.id','details.room','details.service','details.people_number','details.price')
				->where('details.restaurant_id', '=', $idrestaurant)
				->whereNotIn('id', DB::table('orders')
					->join('restaurants','restaurants.id','=','orders.restaurant_id')
					->join('posts','posts.restaurant_id','=','restaurants.id')
					->select('detail_id')->where([
						['order_date', '=', $strDay10],
						['posts.id', '=', $id]
					]))
				->get();
				$arr3 = '';
				foreach ($iddetail3 as $d ) {	
					$arr3 = $arr3 . (string)$d->id . ':' . (string)$d->room .':'. (string)$d->service .':'. (string)$d->people_number .':'.(string)$d->price .','; 
				}

				$iddetailorder4 = DB::table('orders')
				->join('restaurants','restaurants.id','=','orders.restaurant_id')
				->join('posts','posts.restaurant_id','=','restaurants.id')
				->join('details','details.id','=','orders.detail_id')
				->select('orders.detail_id','details.id','details.room','details.service','details.people_number','details.price')
				->where([
					['order_date', '=', $strDay11],
					['posts.id', '=', $id]
				])
				->get();
	
				$arrdetailorder4 = '';
				foreach ($iddetailorder4 as $d ) {	
					$arrdetailorder4 = $arrdetailorder4 . (string)$d->id . ':' . (string)$d->room .':'. (string)$d->service .':'. (string)$d->people_number .':'.(string)$d->price .','; 
				}
				$iddetail4 =DB::table('details')
				->select('details.id','details.room','details.service','details.people_number','details.price')
				->where('details.restaurant_id', '=', $idrestaurant)
				->whereNotIn('id', DB::table('orders')
					->join('restaurants','restaurants.id','=','orders.restaurant_id')
					->join('posts','posts.restaurant_id','=','restaurants.id')
					->select('detail_id')->where([
						['order_date', '=', $strDay11],
						['posts.id', '=', $id]
					]))
				->get();
				$arr4 = '';
				foreach ($iddetail4 as $d ) {	
					$arr4 = $arr4 . (string)$d->id . ':' . (string)$d->room .':'. (string)$d->service .':'. (string)$d->people_number .':'.(string)$d->price .','; 
				}
                
                $iddetailorder5 = DB::table('orders')
				->join('restaurants','restaurants.id','=','orders.restaurant_id')
				->join('posts','posts.restaurant_id','=','restaurants.id')
				->join('details','details.id','=','orders.detail_id')
				->select('orders.detail_id','details.id','details.room','details.service','details.people_number','details.price')
				->where([
					['order_date', '=', $strDay12],
					['posts.id', '=', $id]
				])
				->get();
	
				$arrdetailorder5 = '';
				foreach ($iddetailorder5 as $d ) {	
					$arrdetailorder5 = $arrdetailorder5 . (string)$d->id . ':' . (string)$d->room .':'. (string)$d->service .':'. (string)$d->people_number .':'.(string)$d->price .','; 
				}
				$iddetail5 =DB::table('details')
				->select('details.id','details.room','details.service','details.people_number','details.price')
				->where('details.restaurant_id', '=', $idrestaurant)
				->whereNotIn('id', DB::table('orders')
					->join('restaurants','restaurants.id','=','orders.restaurant_id')
					->join('posts','posts.restaurant_id','=','restaurants.id')
					->select('detail_id')->where([
						['order_date', '=', $strDay12],
						['posts.id', '=', $id]
					]))
				->get();
				$arr5 = '';
				foreach ($iddetail5 as $d ) {	
					$arr5 = $arr5 . (string)$d->id . ':' . (string)$d->room .':'. (string)$d->service .':'. (string)$d->people_number .':'.(string)$d->price .','; 
				}

				$iddetailorder6 = DB::table('orders')
				->join('restaurants','restaurants.id','=','orders.restaurant_id')
				->join('posts','posts.restaurant_id','=','restaurants.id')
				->join('details','details.id','=','orders.detail_id')
				->select('orders.detail_id','details.id','details.room','details.service','details.people_number','details.price')
				->where([
					['order_date', '=', $strDay13],
					['posts.id', '=', $id]
				])
				->get();
	
				$arrdetailorder6 = '';
				foreach ($iddetailorder6 as $d ) {	
					$arrdetailorder6 = $arrdetailorder6 . (string)$d->id . ':' . (string)$d->room .':'. (string)$d->service .':'. (string)$d->people_number .':'.(string)$d->price .','; 
				}
				$iddetail6 =DB::table('details')
				->select('details.id','details.room','details.service','details.people_number','details.price')
				->where('details.restaurant_id', '=', $idrestaurant)
				->whereNotIn('id', DB::table('orders')
					->join('restaurants','restaurants.id','=','orders.restaurant_id')
					->join('posts','posts.restaurant_id','=','restaurants.id')
					->select('detail_id')->where([
						['order_date', '=', $strDay13],
						['posts.id', '=', $id]
					]))
				->get();
				$arr6 = '';
				foreach ($iddetail6 as $d ) {	
					$arr6 = $arr6 . (string)$d->id . ':' . (string)$d->room .':'. (string)$d->service .':'. (string)$d->people_number .':'.(string)$d->price .','; 
				}

		return view('pages/detail', ['data' => $data, 'rating' => $rating,'detail'=>$detail, 'user_rate' => $user_rate, 'strDay7' => $strDay7,'strDay8' => $strDay8,'strDay9' => $strDay9,'strDay10' => $strDay10,'strDay11' => $strDay11,'strDay12' => $strDay12,'strDay13' => $strDay13, 'dateAvalible' => $dateAvalible,'result'=>$result,'result2'=>$result2,'result3'=>$result3,'result4'=>$result4,'result5'=>$result5,'result6'=>$result6,'result7'=>$result7,'weekday1'=>$weekday1,'weekday2'=>$weekday2,'weekday3'=>$weekday3,'weekday4'=>$weekday4,'weekday5'=>$weekday5,'weekday6'=>$weekday6,'weekday7'=>$weekday7,'arr'=>$arr,'arrdetailorder'=>$arrdetailorder,'arr1'=>$arr1,'arrdetailorder1'=>$arrdetailorder1,'arr2'=>$arr2,'arrdetailorder2'=>$arrdetailorder2,'arr3'=>$arr3,'arrdetailorder3'=>$arrdetailorder3,'arr4'=>$arr4,'arrdetailorder4'=>$arrdetailorder4,'arr5'=>$arr5,'arrdetailorder5'=>$arrdetailorder5,'arr6'=>$arr6,'arrdetailorder6'=>$arrdetailorder6]);

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
	public function notification()
	{
		return view('pages.notification');
	}
}