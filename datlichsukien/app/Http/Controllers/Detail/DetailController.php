<?php

namespace App\Http\Controllers\Detail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Detail;
use DB;
class DetailController extends Controller
{
    public function index()
    {
        $detail=Detail::all();
        return view('admin.detail.index',['detail'=>$detail]);
    }
     public function delete($id)
    {
        $detail = detail::find($id);
        $order = DB::table('orders')
            ->where('orders.detail_id','=',$id)
            ->delete();
        $detail->delete();
        
        return redirect()->back()->with('success', 'Xóa thành công ');
    }
    public function showedit ($id)
    {
       $detail=Detail::find($id);
       return view('admin.detail.edit',['detail'=>$detail]);
    }
    public function edit(Request $request,$id)
    {
        $detail = detail::find($id);

        $this->validate($request,
            [        
                'room' =>'required',
                'peopleNumber' =>'required',
                'service' =>'required'
            ],
            [
                'room.required' =>'Bạn chưa nhập tên khu',
                'service.required' =>'Bạn chưa nhập dịch vụ',
                'peopleNumber.required' =>'Bạn chưa nhập sức chứa khu'
            ]
        );
        $detail->room = $request->get('room');
        $detail->service = $request->get('service');
        $detail->people_number = $request->get('peopleNumber');
        
        $detail->save();
        return redirect()->back()->with('success','edit success');
    }
}
