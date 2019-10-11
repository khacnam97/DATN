<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Http\Request;
use Redirect;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showFormLogin(){
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request,
            [
                
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:8']
            ],
            [
               
                'email.required'=>'bạn chưa nhập email',
                'email.email'=>'bạn chưa nhập đúng định dạng',
                'password.required'=>'bạn chưa nhập mk',
                'password.min(8)'=>'bạn nhập ít nhất 8 kí tự',
            ]
        );
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];
       
       // if (Auth::attempt($data)) {
            return redirect('/')->with('message','Đăng nhập thành công');
       // } 
           
              
       
       
    }
}
