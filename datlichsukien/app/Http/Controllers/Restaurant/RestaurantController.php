<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Restaurant;
use App\District;
use DB;
use Config;
class RestaurantController extends Controller
{
    
    public function index()
    {
        
       $restaurant=Restaurant::all();
       return view('admin.restaurant.index',['restaurant'=>$restaurant]);
   }
   public function getadd()
   {
    $restaurant=Restaurant::all();
    // $category=Category::all();
    $district=District::all();
    return view('admin.restaurant.add',['restaurant'=>$restaurant,'district'=>$district]);
    }
    
    public function store(Request $request)
    {
        $this->validate($request,
            [   'name'=>'required',
                'address'=>'required',
                
            ],
            [
                'name.required'=>'bạn chưa nhập tên địa điểm',
                'address.required'=>'bạn chưa nhập địa chỉ',
                
            ]
        );
        $restaurant = new restaurant;
        $restaurant->name=$request->name;
        $restaurant->address=$request->address;
        $restaurant->phone=$request->phone;
        $restaurant->district_id=$request->district_id;  
        $restaurant->lat=$request->lat;
        $restaurant->longt=$request->lng;     
        $restaurant->save();
        $restaurant=Restaurant::all();
        // $category=Category::all();
       
        $district=District::all();
        return \Redirect::route('admin.restaurant.index',['restaurant'=>$restaurant,'district'=>$district])->with('message', Config::get('constant.restaurant.addPlace'));
    }

    public function xoa($id)
    {
        $order = DB::table('orders')
            ->where('orders.restaurant_id','=',$id)
            ->delete();
        $detail = DB::table('details')
                ->join('restaurants','restaurants.id','=','details.restaurant_id')
                ->where('details.restaurant_id','=',$id)
                ->delete();
        $rating = DB::table('ratings')
                ->join('posts','posts.id','=','ratings.post_id')
                ->where('posts.restaurant_id','=',$id)
                ->delete();
        $photo =DB::table('photos')
            ->join('posts','posts.id','=','photos.post_id')
            ->join('restaurants','restaurants.id','=','posts.restaurant_id')
            ->where('restaurants.id', '=' ,$id)->delete();
        $post = DB::table('posts')
            ->where('posts.restaurant_id','=',$id)
            ->delete();
        $restaurant = restaurant::find($id);
        $restaurant->delete();
        
        return redirect()->back()->with('success', Config::get('constant.restaurant.deletePlace'));
        
    }

    public function getedit ($id)
    {
     $restaurant=restaurant::find($id);
     // $category=Category::all();
     // $city=City::all();
     $district=District::all();
     return view('admin.restaurant.edit',['restaurant'=>$restaurant,'district'=>$district]);
    }
    public function postedit (Request $request,$id)
    {
        $restaurant = restaurant::find($id);

        $restaurant->name = $request->get('name');
        $restaurant->address = $request->get('address');
        // $restaurant->category_id = $request->get('category_id');
        $restaurant->district_id = $request->get('district_id');
        $restaurant->lat=$request->get('lat');
        $restaurant->longt=$request->get('lng');
        $restaurant->save();

        return \Redirect::route('admin.restaurant.edit', [$restaurant->id,'restaurant'=>$restaurant])->with('message',  Config::get('constant.restaurant.editPlace'));
        
    }
    public function getdetail ($id)
    {
     $restaurant=restaurant::find($id);
     
     $district=District::all();
     return view('admin.restaurant.detail',['restaurant'=>$restaurant,'district'=>$district]);
    }
}
