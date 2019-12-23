<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Restaurant;
use App\Category;
use App\Photo;
use App\District;
use DB;
use Auth;
use File;
use App\Detail;
use App\Rating;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Validator;
use App\Notifications\CreatePost;
use Illuminate\Support\Str;
use App\Events\CreatePostHandler;
use App\Rules\PostRule;
use Config;
class PostController extends Controller
{
     public function showformAddPost() {
		$restaurant = Restaurant::all();
		$district = District::all();
    	return view('pages.addpost',[ 'restaurant' => $restaurant,  'district' => $district]);
    }
    //function add one Post
    public function addpost(Request $request){
    // dd($request->all());
    	$request-> validate([
            'name' => 'required',
            'phone' => 'required ',
            'title' => 'required',
            'descrice' => 'required',
            
        ]);
        // Transaction database
        	$restaurant = Restaurant::all();
        	$post = new Post;
        	$post ->user_id = Auth::id();
    
        		$newRestaurant = new Restaurant;
        		$newRestaurant->name = $request->name;
        		$newRestaurant->address = $request->address;
                $newRestaurant->phone = $request->phone;
                $newRestaurant->lat = $request->lat;
                $newRestaurant->longt = $request->lng;                
                $newRestaurant->district_id =$request->district_id;

            $post ->title = $request ->title;
            $post ->is_approved = 0;
            $post ->describer = $request->descrice;
            $strNow =  date("d-m-Y");
            $post ->slug = Str::slug($request->title.$strNow, '-');
            //dd( $post ->slug);
            //check image
            if($request->has('filename')){
            	foreach ($request->file('filename') as $pho) {
            		$name=$pho->getClientOriginalName();
    	        }
            }

            //save new Restaurant
                $newRestaurant -> save();
                $post ->restaurant_id = $newRestaurant->id;
                $n=count($request->room);
                //dd($i);
                for ($i=0;$i<$n-1;$i++ ) {
                    $newDetail=new Detail;
                    $newDetail->room=$request->room[$i];
                    $newDetail->people_number=$request->peopleNumber[$i];
                    $newDetail->service=$request->service[$i];
                    $newDetail->price=$request->price[$i];
                    $newDetail ->restaurant_id = $newRestaurant->id;
                    $newDetail ->save();
                }
                
            //save post
            $post ->save();
            // event(new CreatePostHandler($post));
            //$toUsers = User::where('role','1')->get();
            //create folder
            $path="picture/admin/post/".$post->id;
            if (!file_exists($path)) {
                File::makeDirectory($path);
            }
            //save image
            if($request->has('filename')){
                foreach ($request->file('filename') as $pho) {
                    $name=$pho->getClientOriginalName();
                    $photo = new Photo;
                    $photo->post_id = $post->id;
                    $pho->move($path, $name);  
                    $photo->photo_path = "picture/admin/post/".$post->id."/".$name;
                    $photo->flag = 0;
                    $photo->save();
                }
            }
            //Check flag photo and save
            $photoflag = Photo::where('post_id', $post->id)->first();
            $photoflag->flag =1;
            $photoflag->save();
        return redirect()->route('mypost')->with(config::get('constant.success'), config::get('constant.message_add_success'));
    }
     public function autocomplete(Request $request)
    {
        $search = $request->get('term');
        $result = Restaurant::where('name', 'LIKE',$search. '%')->get();
        return response()->json($result);
    }
     public function autocompleteAddress(Request $request){
        $result = Restaurant::join('districts', 'restaurants.districts_id', '=', 'districts.id')
                ->select('districts.name as districtname', 'cities.name as cityname' ,'restaurants.address as address')
                ->where('restaurants.name','=',$request->term)
                ->first();
        return response()->json($result);
    }
    //show form edit post
    public function showformEditPost($idPost)
    {
        //dd($idPost);
        $id = Auth::id();
        //check  
        if(Post::where('id', $idPost)->first() == null){
            return view('includes.error404');
        }
        if( Post::where('id', $idPost)->first()->user_id != $id){
            return view('includes.error404');            
        }
        $post = Post::where('id',$idPost)->first();
        $detail =DB::table('details')
        ->join('restaurants', 'details.restaurant_id', '=', 'restaurants.id')
        ->join('posts', 'posts.restaurant_id', '=', 'restaurants.id')
        ->where('posts.id', '=', $idPost)
        ->select('details.room','details.service','details.people_number','details.id')
        ->get();
        //dd($detail);
        $restaurant = Restaurant::all();
        $district = District::all();
        return view('pages.editPost',[ 'restaurant' => $restaurant,  'district' => $district, 'post' => $post,'detail'=>$detail]);
    }

    //edit post
    public function edit(Request $request, $idpost){
      
        //dd($request->all());
        $request-> validate([
            'phone' => 'required ',
            'title' => 'required',
            'descrice' => 'required',
            'district_id' => 'required',
            'address' => [
                'required',            ]
        ]);
        //check input dia diem
        //check idpost input 
        if(POST::find($idpost) == null || POST::find($idpost)->user_id != Auth::id()){
            return redirect()->back()->with(config::get('constant.error'), config::get('constant.message_edit_fail'));
        }
        $posts = POST::find($idpost);
        if($request->approved != null){
            $posts ->is_approved = $request->approved;
        }
        $posts ->title = $request ->title;
        $posts ->describer= $request->input('descrice');
        

        $restaurant = Restaurant::find($posts->restaurant_id);
        $restaurant ->name = $request->name;
        $restaurant ->address = $request->address;
        $restaurant->district_id = $request->district_id;
        $restaurant ->phone = $request->phone;
        $newRestaurant=$posts->restaurant_id;
        //dd($newRestaurant);
        $detail =DB::table('details')
        ->join('restaurants', 'details.restaurant_id', '=', 'restaurants.id')
        ->join('posts', 'posts.restaurant_id', '=', 'restaurants.id')
        ->where('posts.id', '=', $idpost)
        ->delete();
        $n=count($request->room);
                //dd($i);
                for ($i=0;$i<$n-1;$i++ ) {
                    $newDetail=new Detail;
                    $newDetail->room=$request->room[$i];
                    $newDetail->people_number=$request->peopleNumber[$i];
                    $newDetail->service=$request->service[$i];
                    $newDetail->price=$request->price[$i];
                    $newDetail ->restaurant_id = $newRestaurant;
                    $newDetail ->save();
                }
        //edit photos
        $path = 'picture/admin/post/'.$posts->id;
        if($request->has('filename')){
            foreach($request->file('filename') as $image)
            {   
                $name=$image->getClientOriginalName();

                //check photo exit
                $namet=$path."/".$name;                
                $t = DB::table('photos')
                ->where("post_id", "=", $idpost)->get();
                foreach ($t as $key => $value) {
                        if($value->photo_path ==  $namet  )
                        return redirect()->back()->with(config::get('constant.error'),'Photo does exitst');

                }  
                $image->move($path, $name);  
                $photo = new photo;
                $photo->photo_path = $path."/".$name;
                $photo->flag = 0;
                $photo->post_id=$posts->id;
                $photo ->save ();
            }
        }

        $restaurant -> save();
        $posts -> save();

        //delete photo
        $photoedit = $request->p1; // This will get all the request data.
        $edit = explode('/',$photoedit);
        foreach ($edit as $da => $value) {
            if(PHOTO::find($value))
            {
                $findphoto = PHOTO::find($value);
                $path =$findphoto->photo_path; 
                File::delete($path);
                $findphoto ->delete();
                
            }
        }

        $photocheck = Photo::where('post_id', $posts->id);
        if($photocheck->count() == 0){
            return "NOT Image chosed";
        }
        $photoflag = Photo::where('post_id', $posts->id)->first();
        $photoflag->flag =1;
        $photoflag->save();

        return redirect()->route('mypost')->with(config::get('constant.success'), config::get('constant.message_edit_success'));

    }
    //Delete myposst
    public function delete($id)
    {
        
        if(POST::where('id', $id)->first() == null){
            return redirect()->back()->with(config::get('constant.error'), config::get('constant.message_delete_fail'));            
        }
        $check = POST::where('id', $id)->first()->user_id;
        if($check != Auth::id()) {
            return redirect()->back()->with(config::get('constant.error'), config::get('constant.message_delete_fail'));
        }
        else
        {
            $detail = DB::table('details')
                ->join('restaurants','restaurants.id','=','details.restaurant_id')
                ->join('posts','posts.restaurant_id','=','restaurants.id')
                ->where('posts.id','=',$id)
                ->delete();
            $order = DB::table('orders')
                ->join('restaurants','restaurants.id','=','orders.restaurant_id')
                ->join('posts','posts.restaurant_id','=','restaurants.id')
                ->where('posts.id','=',$id)
                ->delete();
            $restaurant =DB::table('restaurants')
                ->join('posts','posts.restaurant_id','=','restaurants.id')
                ->where('posts.id', '=' ,$id)->delete();
            $posts = DB::table('posts')
                ->where('id' , '=' ,$id)->delete();
            $photo =DB::table('photos')
                ->where('post_id', '=' ,$id)->delete();
            $path = "/picture/admin/post/".$id;
            $rating = Rating::where('post_id', $id)->delete(); 
            File::deleteDirectory(public_path($path));
           
            return redirect()->route('mypost')->with(config::get('constant.success'), config::get('constant.message_delete_success'));
        }
    }

}
