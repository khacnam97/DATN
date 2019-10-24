<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
class AdminController extends Controller
{
    private $ADMIN_VIEW = 'admin.index';
    public function index()
    {
        return view($this->ADMIN_VIEW);
    }
}
