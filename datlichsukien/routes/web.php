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

Route::group(['prefix' => 'admin','middleware' => 'auth'], function () {
    Route::get('/', 'AdminController@index')->name('admin.index')->middleware('admin');
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
	Route::group(['prefix' => 'rating','namespace'=>'rating'], function(){
		Route::get('/', 'RatingController@index')->name('admin.rating.index');
		Route::post('/add','RatingController@add')->name('admin.rating.add');
		Route::get('edit/{id}', 'RatingController@edit')->name('admin.rating.edit');
		Route::get('/select', 'RatingController@select')->name('admin.rating.select');
		Route::post('update/{id}', 'RatingController@update')->name('admin.rating.update');
		Route::post('/delete/{id}', 'RatingController@delete')->name('admin.rating.delete');
	});
	Route::group(['prefix' => 'order','namespace'=>'order'], function(){
		Route::get('/', 'OrderController@index')->name('admin.order.index');
		Route::get('/delete/{id}', 'OrderController@delete')->name('admin.order.delete');
		Route::post('/add', 'OrderController@addOrder')->name('admin.order.addOrder');
		Route::get('/cancel/{id}', 'OrderController@cancel')->name('admin.order.cancel');
		Route::get('/accept/{id}', 'OrderController@accept')->name('admin.order.accept');
		Route::get('/edit/{id}', 'OrderController@showedit')->name('admin.order.edit');
		Route::post('/edit/{id}', 'OrderController@edit')->name('admin.order.edit');
		
	});
});
Route::group(['namespace'=>'Front'],function(){
Route::get('/', 'FrontController@index')->name('index'); 
Route::get('/home', function(){
		return view('pages.index');
	})->name('home');
    Route::get('profile', 'ProfileController@show')->name('profile');
	Route::get('/edit', 'ProfileController@edit')->name('profile.edit');
	Route::get('/post/{id}', 'FrontController@showPosts')->name('show.posts');
	Route::post('/update', 'ProfileController@update')->name('profile.update');
	Route::post('/update_avatar', 'ProfileController@update_avatar')->name('avatar.update');

	Route::get('/detail/{id}','FrontController@detail')->name('detail');
	Route::post('/detail/rate','FrontController@rate');
	Route::post('/checkdate','FrontController@checkdate')->name('checkdate');

	Route::get('/order/{id}','OrderController@index')->name('order');
	Route::post('/order','OrderController@addOrder')->name('order.add');
    Route::post('/check','OrderController@check')->name('order.check');
    Route::post('/order_date','OrderController@adddateOrder')->name('order.add.date');

	Route::get('/search_list', 'SearchListController@getsearch')->name('search.list');
	Route::get('/autocomplete', 'SearchListController@autocomplete')->name('autocomplete');
	Route::get('/search_date', 'SearchListController@search_date')->name('search.date');

	Route::get('/mypost','ProfileController@mypost')->name('mypost');
	Route::post('/mypost/{id}/delete','PostController@delete')->name('mypost.delete');
    
    Route::post('/upgrade', 'FrontController@upgrade')->name('upgrade');

	Route::group(['prefix' => 'account', 'middleware' => 'auth'],function(){
		Route::get('/post', 'PostController@showformAddPost')->name('account.addpost');
		Route::post('/post', 'PostController@addpost')->name('account.addpost');
		Route::get('/autocomplete', 'PostController@autocomplete')->name('post.autocomplete');
		Route::get('/autocompleteAddress', 'PostController@autocompleteAddress')->name('post.autocompleteAddress');
		Route::get('/edit/{idpost}', 'PostController@showformEditPost')->name('account.editpost');
		Route::post('/edit/{idpost}', 'PostController@edit')->name('account.editpost');
		Route::get('/manageOrder','OrderController@manageOrder')->name('manage.order');
		Route::get('/cancel/{id}', 'OrderController@cancel')->name('myorder.cancel');
		Route::post('/accept', 'OrderController@accept')->name('myorder.accept');
		Route::get('/confirm/{id}', 'OrderController@confirm')->name('confirm');

		Route::get('/myorder','OrderController@myOrder')->name('myorder');
		Route::get('/delete/{id}','OrderController@delete')->name('myorder.delete');
		Route::post('/edit','OrderController@edit')->name('myorder.edit');
		
	});
});
//Route::get('register', 'Auth\RegisterController@showFormRegister')->name('show.register');
Route::post('signup', 'Auth\RegisterController@register')->name('signup');
// Route::get('login', 'Auth\LoginController@showFormLogin')->name('show.login');
// Route::post('login', 'Auth\LoginController@login')->name('auth.login');
Route::get('/change_password', 'Auth\ChangePasswordController@show')->name('show_changePass');
Route::post('/update_password', 'Auth\ChangePasswordController@update')->name('update_changePass');
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
