<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Response;

class ScheduleController extends Controller
{
    public function index()
	{

		return view('pages.schedule');
	}
}
