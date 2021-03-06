<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Post;
use App\User;
use Carbon\Carbon;
use App\Photo;
use App\Detail;
use File;
use App\District;
use App\Restaurant;
use App\Rating;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Config;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postss = POST::all();
        $user = USER::all();
        $restaurant = restaurant::all();
        $district=District::all();
        return view('admin.post.index', ['posts'=>$postss , 'user'=>$user ,'restaurant'=>$restaurant,'district'=>$district]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        //
        $request-> validate([
            'user_id' => 'reiquired',
            'title' => 'required',
            'describer' => 'required',
            'restaurantid' => 'required',
        ]);

        // import posts
        $posts = new POST;
        $newRestaurant = new Restaurant;
        $newRestaurant->name = $request->restaurantid;
        $newRestaurant->address = $request->address;
        $newRestaurant->phone = $request->phone;
        $newRestaurant->lat = $request->lat;
        $newRestaurant->longt = $request->lng;                
        $newRestaurant->district_id =$request->district_id;
        
        $posts ->user_id = User::where('name', $request->userid)->first()->id;
        $newRestaurant -> save();
        $posts ->restaurant_id = $newRestaurant->id;
        $posts ->title = $request ->title;
        $posts ->describer = $request ->input('describer');
        if($request->checkbox){
            $posts ->is_approved = $request ->checkbox;
        }
        else{
        $posts ->is_approved =0;
        }
         // $posts ->slug = Str::slug($request->title, '-');
        //make folder chứa photo
        $path = 'picture/admin/post/'.$posts->id;
        if(!File::exists($path)){
            File::makeDirectory($path, 0644);
        }

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
        //insert multi photo
        $posts -> save();
        if($request->has('filename')){
            foreach($request->file('filename') as $image)
            {   

                $name=$image->getClientOriginalName();

                //check photo exit
                $namet=$path."/".$name;                
                $t = DB::table('photos')
                ->where("post_id", "=", $posts->id)->get();
                foreach ($t as $key => $value) {
                        if($value->photo_path ==  $namet  ){
                            $p = POST::find($posts->id)->delete();
                            return redirect()->back()->with(config::get('constant.error'), config::get('constant.message_fail_photo'));
                        }
                }  

                $image->move($path, $name);  
                $photo = new photo;
                $photo->photo_path = $path."/".$name;
                $photo->flag = 0;
                $photo->post_id=$posts->id;
                $photo ->save ();
            }
            $photoflag = Photo::where('post_id', $posts->id)->first();
            $photoflag->flag =1;
            $photoflag->save();
            return back()->with(config::get('constant.success'), config::get('constant.message_add_success'));
        }
 

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function showformedit($id)
    {
        $posts = POST::find($id);
         $user = USER::all();
        $restaurant = RESTAURANT::all();
         $detail =DB::table('details')
        ->join('restaurants', 'details.restaurant_id', '=', 'restaurants.id')
        ->join('posts', 'posts.restaurant_id', '=', 'restaurants.id')
        ->where('posts.id', '=', $id)
        ->select('details.room','details.service','details.people_number','details.id','details.price')
        ->get();
        return view('admin.post.edit', ['post'=>$posts, 'user'=>$user ,'restaurant'=>$restaurant,'detail'=>$detail] );
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        // xu li edit info
        $request-> validate([
            'user_id' => 'reiquired',
            'title' => 'required',
            'describer' => 'required'
        ]);
        $posts = POST::find($id);
        //check user id có thay đổi không
        if(POST::find($id)->user_id != USER::where('name',$request->userid)->first()->user_id){
            $posts ->user_id = User::where('name',$request ->userid)->first()->id;

        }  
        $posts ->is_approved = $request->approved;
        $posts ->title = $request ->title;
        $posts ->describer = $request->input('describer');
        $newRestaurant=$posts->restaurant_id;
         $detail =DB::table('details')
        ->join('restaurants', 'details.restaurant_id', '=', 'restaurants.id')
        ->join('posts', 'posts.restaurant_id', '=', 'restaurants.id')
        ->where('posts.id', '=', $id)
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

        // xu li them anh moi
        $path = 'picture/admin/post/'.$posts->id;
        if($request->has('filename')){
            foreach($request->file('filename') as $image)
            {   
                $name=$image->getClientOriginalName();

                //check photo exit
                $namet=$path."/".$name;                
                $t = DB::table('photos')
                ->where("post_id", "=", $id)->get();
                foreach ($t as $key => $value) {
                          if($value->photo_path ==  $namet  )
                              return "Photo exits";
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
            return redirect() ->back()->with(config::get('constant.error'), config::get('constant.message_fail_photo'));
        }

        $photoflag = Photo::where('post_id', $posts->id)->first();
        $photoflag->flag =1;
        $photoflag->save();

        
        return redirect (route('admin.post.detail', $posts->id))->with(config::get('constant.success'), config::get('constant.message_edit_success'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //query bulder

        $order = DB::table('orders')
            ->join('restaurants','restaurants.id','=','orders.restaurant_id')
            ->join('posts','posts.restaurant_id','=','restaurants.id')
            ->where('posts.id','=',$id)
            ->delete();
        $detail = DB::table('details')
            ->join('restaurants','restaurants.id','=','details.restaurant_id')
            ->join('posts','posts.restaurant_id','=','restaurants.id')
            ->where('posts.id','=',$id)
            ->delete();
        $restaurant =DB::table('restaurants')
            ->join('posts','posts.restaurant_id','=','restaurants.id')
            ->where('posts.id', '=' ,$id)->delete();
        $photo =DB::table('photos')
            ->where('post_id', '=' ,$id)->delete();
        $path = "/picture/admin/post/".$id; 
        File::deleteDirectory(public_path($path));
        $rating = Rating::where('post_id', $id)->delete();
        $posts = DB::table('posts')
            ->where('id' , '=' ,$id)->delete();
        //$rating =Rating::where('post_id', $id)->delete();
        $postss = POST::all();
        return redirect (route('admin.post.index'))->with(config::get('constant.success'), config::get('constant.message_delete_success'));
    }

    public function approved($id)
    {
        //eloquent
        $posts = DB::table('posts')
            ->where('id', '=' , $id)
            ->update(['is_approved' => 1]);
        $posts= POST::all();
        return redirect (route('admin.post.index'));
    }   

    public function unapproved($id)
    {
        //eloquent
        $posts = DB::table('posts')
            ->where('id', '=' , $id )
            ->update(['is_approved' => 0]);
        return redirect (route('admin.post.index'));

    }   

    //show detail posts
    public function detail($id)
    {
        $posts = POST::find($id);
         $detail =DB::table('details')
        ->join('restaurants', 'details.restaurant_id', '=', 'restaurants.id')
        ->join('posts', 'posts.restaurant_id', '=', 'restaurants.id')
        ->where('posts.id', '=', $id)
        ->select('details.room','details.service','details.people_number','details.id','details.price')
        ->get();
        return view('admin.post.detail', ['post'=>$posts,'detail'=>$detail] );
  
    }
    public function deletephoto($id)
    {
        $photos = PHOTO::find($id);
        $photos ->delete();
        $path =$photos->photo_path; 
        File::delete($path);
        return back();
    }

    public function autocompleteUser(Request $request){
        $search = $request->get('term');
        $result = User::where('name', 'LIKE','%'.$search. '%')->get();
        return response()->json($result);
    }

    public function autocompleteRestaurant(Request $request){
        $search = $request->get('term');
        $result = Restaurant::where('name', 'LIKE','%'.$search. '%')->get();
        return response()->json($result);
    }

}
