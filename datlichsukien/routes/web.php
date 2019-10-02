<?php

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

Route::post('/register', 'Auth\RegisterController@store')->name('register');
