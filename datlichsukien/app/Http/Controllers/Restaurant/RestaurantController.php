<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Restaurant;
use App\Category;
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
    $category=Category::all();
    $district=District::all();
    return view('admin.restaurant.add',['restaurant'=>$restaurant,'district'=>$district]);
    }
    // public function getCityList(Request $request)
    // {
    //     $districts = DB::table("districts")
    //     ->where("cities_id",$request->cities_id)
    //     ->pluck("name","id");
    //     return response()->json($districts);

    // }
    public function store(Request $request)
    {
        $this->validate($request,
            [   'name'=>'required',
                'address'=>'required',
                'districts_id'=>'required'
            ],
            [
                'name.required'=>'bạn chưa nhập tên địa điểm',
                'address.required'=>'bạn chưa nhập địa chỉ',
                'districts_id.required'=>'bạn chưa chọn quận huyện'
            ]
        );
        $restaurant = new restaurant;
        $restaurant->name=$request->name;
        $restaurant->address=$request->address;
       
        $restaurant->districts_id=$request->districts_id;  
        $restaurant->lat=$request->lat;
        $restaurant->longt=$request->lng;     
        $restaurant->save();
        $restaurant=Restaurant::all();
        $category=Category::all();
       
        $district=District::all();
        return \Redirect::route('admin.restaurant.index',['restaurant'=>$restaurant,'district'=>$district])->with('message', Config::get('constant.restaurant.addPlace'));
    }

    public function xoa($id)
    {
        $restaurant = restaurant::find($id);
        $restaurant->delete();
        
        return redirect()->back()->with('success', Config::get('constant.restaurant.deletePlace'));
        
    }

    public function getedit ($id)
    {
     $restaurant=restaurant::find($id);
     $category=Category::all();
     $city=City::all();
     $district=District::all();
     return view('admin.restaurant.edit',['restaurant'=>$restaurant,'category'=>$category,'district'=>$district,'city'=>$city]);
    }
    public function postedit (Request $request,$id)
    {
        $restaurant = restaurant::find($id);

        $restaurant->name = $request->get('name');
        $restaurant->address = $request->get('address');
        $restaurant->category_id = $request->get('category_id');
        $restaurant->districts_id = $request->get('districts_id');
        $restaurant->lat=$request->get('lat');
        $restaurant->longt=$request->get('lng');
        $restaurant->save();

        return \Redirect::route('admin.restaurant.edit', [$restaurant->id,'restaurant'=>$restaurant])->with('message',  Config::get('constant.restaurant.editPlace'));
        
    }
    public function getdetail ($id)
    {
     $restaurant=restaurant::find($id);
     
     $category=Category::all();
     $city=City::all();
     $district=District::all();
     return view('admin.restaurant.detail',['restaurant'=>$restaurant,'category'=>$category,'district'=>$district,'city'=>$city]);
    }
}
