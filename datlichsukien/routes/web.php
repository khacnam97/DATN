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
		Route::post('/delete/{id}', 'PostController@destroy')->name('admin.post.delete');
		Route::get('/approved/{id}', 'PostController@approved')->name('admin.post.approved');
		Route::get('/unapproved/{id}', 'PostController@unapproved')->name('admin.post.unapproved');
		Route::post('/add', 'PostController@store')->name('admin.post.add');
		Route::get('/{id}/detail', 'PostController@detail')->name('admin.post.detail');
		Route::get('/{id}/edit', 'PostController@showformedit')->name('admin.post.showedit');
		Route::post('/{id}/edit', 'PostController@edit')->name('admin.post.edit');
		Route::get('/{id}/edit/deletephoto', 'PostController@deletephoto')->name('admin.post.deletephoto');
		Route::get('/autocompleteUser', 'PostController@autocompleteUser')->name('post.autocompleteUser');
		Route::get('/autocompleteRestaurant', 'PostController@autocompleteRestaurant')->name('post.autocompleteRestaurant');

	});
    Route::group(['prefix' => 'restaurant','namespace'=>'restaurant'], function(){
		Route::get('/', 'RestaurantController@index')->name('admin.restaurant.index');
		Route::get('/delete/{id}', 'RestaurantController@xoa')->name('admin.restaurant.delete');

		Route::get('/edit/{id}', 'RestaurantController@getedit')->name('admin.restaurant.edit');
		Route::post('/edit/{id}', 'RestaurantController@postedit')->name('admin.restaurant.edit');

        Route::get('/detail/{id}', 'RestaurantController@getdetail')->name('admin.restaurant.detail');

		Route::get('/add', 'RestaurantController@getadd')->name('admin.restaurant.add');
		Route::post('/add', 'RestaurantController@store')->name('admin.restaurant.add');
		
	});
});
Route::group(['namespace'=>'Front'],function(){
Route::get('/', 'FrontController@index')->name('index'); 
});
// Route::get('register', 'Auth\RegisterController@showFormRegister')->name('show.register');
// Route::post('register', 'Auth\RegisterController@register')->name('auth.register');
// Route::get('login', 'Auth\LoginController@showFormLogin')->name('show.login');
// Route::post('login', 'Auth\LoginController@login')->name('auth.login');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
