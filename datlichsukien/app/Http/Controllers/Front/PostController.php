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
    	$category = Category::all();
		$Restaurant = Restaurant::all();
		$district = District::all();
    	return view('pages.addpost',['category' => $category, 'Restaurant' => $Restaurant,  'district' => $district]);
    }
    //function add one Post
    public function Add(Request $request){
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
        // DB:transaction(function(){
        	$restaurant = Restaurant::all();
        	$post = new Post;
        	$post -> user_id = Auth::id();
        	$post -> phone = $request ->phone;

            //check again  input tỉnh huyên
            if(District::where('name' , $request->districts_id)->first() == null){
                return redirect()->back()->with(config::get('constant.error'), constant::get('constant.message_fail_input'))->withInput($request->input());
            }
            else{
                if(City::where('id',District::where('name' , $request->districts_id)->first()->cities_id)->first()->id == City::where('name',$request->city)->first()->id){
                        $findIdPDistrict = District::where('name' , $request->districts_id)->first()->id;
                }
                else{
                    return redirect()->back()->with(config::get('constant.error'), config::get('constant.message_fail_input'))->withInput($request->input());
                }
            }
        	//check Restaurant exist
        	$findRestaurant = Restaurant::where([
                ['name', '=', $request->name],
                ['districts_id', '=', $findIdPDistrict]
                ])->first();
        	if($findRestaurant){
        	    $post ->Restaurant_id = $findRestaurant->id;
        	}
        	else{
        		$newRestaurant = new Restaurant;
        		$newRestaurant->name = $request->name;
        		$newRestaurant->address = $request->address;
                $newRestaurant->lat = $request->lat;
                $newRestaurant->longt = $request->lng;
        		$newRestaurant->category_id = Category::where('name', $request->category)->first()->id;
                
                $newRestaurant->districts_id = $findIdPDistrict;

        	}

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
            if($findRestaurant == null){
                $newRestaurant -> save();
                $post ->Restaurant_id = $newRestaurant->id;

            }
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
        // });
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
}
