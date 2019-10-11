<?php
use Illuminate\Routing\Controller;
// use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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
    Route::group(['prefix'=>'user','namespace'=>'user'],function(){
    	Route::get('/', 'UserController@index')->name('admin.user.index');
    	Route::post('/add', 'UserController@store')->name('admin.user.add');

		Route::get('/edit/{id}', 'UserController@getedit')->name('admin.user.edit');
		Route::post('/edit/{id}', 'UserController@postedit')->name('admin.user.edit1');

		Route::get('/delete/{id}', 'UserController@xoa')->name('admin.user.delete');
		Route::get('/block/{id}', 'UserController@block')->name('admin.user.block');
		Route::get('/unblock/{id}', 'UserController@unblock')->name('admin.user.unblock');
    });
    Route::group(['prefix' => 'post','namespace'=>'post'], function(){
		Route::get('/', 'PostController@index')->name('admin.post.index');

	});
    
});
Route::group(['namespace'=>'Front'],function(){
Route::get('/', 'FrontController@index')->name('index'); 
});
Route::get('register', 'Auth\RegisterController@showFormRegister')->name('show.register');
Route::post('register', 'Auth\RegisterController@register')->name('auth.register');
Route::get('login', 'Auth\LoginController@showFormLogin')->name('show.login');
Route::post('login', 'Auth\LoginController@login')->name('auth.login');
