<?php
use Illuminate\Routing\Controller;
//use App\Http\Controllers\HomeController;
// use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('auth/register');
// });

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::group(['prefix'=>'user'],function(){
    
    });
});
Route::group(['namespace'=>'Front'],function(){
  Route::get('/', 'FrontController@index');
});
Route::get('show-register', 'Auth\RegisterController@showFormRegister')->name('show.register');
Route::post('register', 'Auth\RegisterController@store')->name('auth.register');
