<?php

namespace App\Http\Controllers\Detail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Detail;

class DetailController extends Controller
{
    public function index()
    {
        $detail=Detail::all();
        return view('admin.detail.index',['detail'=>$detail]);
    }
}
