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
    public function add(Request $request){
    	$request-> validate([
            'name' => 'required',
            'phone' => 'required|min:10 ',
            'title' => 'required',
            'descrice' => 'required',
            'districts_id' => 'required',
            'address' => [
                'required',            ]
        ]);
        // Transaction database
         
        	$restaurant = Restaurant::all();
            dd($request);
        	$post = new Post;
        	$post ->user_id = Auth::id();

        	$post ->phone = $request ->phone;
            //check again  input tỉnh huyên
            // if(District::where('name' , $request->districts_id)->first() == null){
            //     return redirect()->back()->with(config::get('constant.error'), constant::get('constant.message_fail_input'))->withInput($request->input());
            // }
            // else{
            //     if(City::where('id',District::where('name' , $request->districts_id)->first()->cities_id)->first()->id == City::where('name',$request->city)->first()->id){
            //             $findIdPDistrict = District::where('name' , $request->districts_id)->first()->id;
            //     }
            //     else{
            //         return redirect()->back()->with(config::get('constant.error'), config::get('constant.message_fail_input'))->withInput($request->input());
            //     }
            // }
        	//check Restaurant exist
        	// $findRestaurant = Restaurant::where([
         //        ['name', '=', $request->name],
         //        ['districts_id', '=', $findIdPDistrict]
         //        ])->first();
        	
        		$newRestaurant = new Restaurant;
        		$newRestaurant->name = $request->name;
        		$newRestaurant->address = $request->address;
                $newRestaurant->lat = $request->lat;
                $newRestaurant->longt = $request->lng;                
                $newRestaurant->districts_id =$request->$district_id;

        	

            $post ->title = $request ->title;
            $post ->is_approved = 0;
            $post ->describer = $request->descrice;
    	    
            //check image
            if($request->has('filename')){
            	foreach ($request->file('filename') as $pho) {
            		$name=$pho->getClientOriginalName();
                    $thumbnailImage = Image::make($pho);
                    if($thumbnailImage->width() < 800 || $thumbnailImage->height()<400)
                    {
                        return redirect()->back()->with(config::get('constant.error'), config::get('constant.message_fail_photo'))->withInput($request->input());
                    }
                    if($thumbnailImage->width() > 2500 && $thumbnailImage->height()>1300)
                    {
                        return redirect()->back()->with(config::get('constant.error'), config::get('constant.message_fail_photo'))->withInput($request->input());
                    }
    	        }
            }

            //save new Restaurant
            // if($findRestaurant == null){
                $newRestaurant -> save();
                $post ->restaurant_id = $newRestaurant->id;

            // }
            //save post
            $post ->save();
            event(new CreatePostHandler($post));
            $toUsers = User::where('role','1')->get();
            \Notification::send($toUsers, new CreatePost($post));
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

        $id = Auth::id();
        //check  
        if(Post::where('id', $idPost)->first() == null){
            return view('includes.erro404');
        }
        if( Post::where('id', $idPost)->first()->user_id != $id){
            return view('includes.erro404');            
        }
        $post = Post::where('id',$idPost)->first();
        $category = Category::all();
        $place = Place::all();
        $city = City::all();
        $district = District::all();
        return view('pages.editPost',['category' => $category, 'place' => $place, 'city' =>$city, 'district' => $district, 'post' => $post]);
    }

    //edit post
    public function edit(Request $request, $idpost){
        //validate dữ liiêu
        $request-> validate([
            'phone' => 'required ',
            'title' => 'required',
            'descrice' => 'required',
            'districts_id' => 'required',
            'address' => [
                'required',            ]
        ]);
        //check input dia diem
        //check idpost input 
        if(POST::find($idpost) == null || POST::find($idpost)->user_id != Auth::id()){
            return redirect()->back()->with(config::get('constant.error'), config::get('constant.message_edit_fail'));
        }
        $posts = POST::find($idpost);
        $posts ->phone = $request->phone;
        if($request->approved != null){
            $posts ->is_approved = $request->approved;
        }
        $posts ->title = $request ->title;
        $posts ->describer= $request->input('descrice');

        //edit place
        $place = Place::where([
            ['name', $request->name],
            ['districts_id', District::where('name',$request->districts_id)->first()->id]
            ])->first();
        $place ->address = $request->address;
        $place->districts_id = District::where('name', $request->districts_id)->first()->id; 
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
                $thumbnailImage = Image::make($image);
                if($thumbnailImage->width() < 800 || $thumbnailImage->height()<500)
                {
                    return redirect()->back()->with(config::get('constant.error'), config::get('constant.message_fail_photo'));
                }
                if($thumbnailImage->width() > 2500 && $thumbnailImage->height()>1300)
                {
                    return redirect()->back()->with(config::get('constant.error'), config::get('constant.message_fail_photo'));
                }
                $image->move($path, $name);  
                $photo = new photo;
                $photo->photo_path = $path."/".$name;
                $photo->flag = 0;
                $photo->post_id=$posts->id;
                $photo ->save ();
            }
        }

        $posts -> save();
        $place->save();
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
        //Check input
        if(POST::where('id', $id)->first() == null){
            return redirect()->back()->with(config::get('constant.error'), config::get('constant.message_delete_fail'));            
        }
        $check = POST::where('id', $id)->first()->user_id;
        if($check != Auth::id()) {
            return redirect()->back()->with(config::get('constant.error'), config::get('constant.message_delete_fail'));
        }
        else
        {
            //transaction database
            // DB::transaction(function(){
                $posts = DB::table('posts')
                    ->where('id' , '=' ,$id)->delete();
                $photo =DB::table('photos')
                    ->where('post_id', '=' ,$id)->delete();
                $path = "/picture/admin/post/".$id;
                $rating = Rating::where('post_id', $id)->delete(); 
                File::deleteDirectory(public_path($path));
            // });
            return redirect()->route('mypost')->with(config::get('constant.success'), config::get('constant.message_delete_success'));
        }
    }

}
