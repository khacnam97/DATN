<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Restaurant;
// use App\Category;
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
        $restaurant->lng=$request->lng;     
        $restaurant->save();
        $restaurant=Restaurant::all();
        // $category=Category::all();
       
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
        $restaurant->lng=$request->get('lng');
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
