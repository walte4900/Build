<?php

use Illuminate\Support\Facades\Route;

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
//
// Route::get('/index', function () {
//     return "Welcome";
// });

Route::get('/','App\Http\Controllers\MainController@index');
Route::post('/select_by', 'App\Http\Controllers\MainController@select_by');
Route::get('/favourite','App\Http\Controllers\MainController@favourite');

Route::get('/login','App\Http\Controllers\MainController@login');
// Route::get('/login','App\Http\Controllers\UserController@login');

Route::get('/logon','App\Http\Controllers\MainController@logon');

Route::resource('users', 'App\Http\Controllers\UserController');
Route::post('user/login', 'App\Http\Controllers\UserController@login');
Route::any('user/logout','App\Http\Controllers\UserController@logout');

Route::Group(["prefix"=>"user/profile"], function (){
    Route::get('add', 'App\Http\Controllers\UserController@add');
    Route::get('del', 'App\Http\Controllers\UserController@del');
    Route::get('update', 'App\Http\Controllers\UserController@update');
    Route::get('select', 'App\Http\Controllers\UserController@select');
});

Route::any('/user/post_page', 'App\Http\Controllers\UserController@post_page');
Route::post('/user/post', 'App\Http\Controllers\UserController@post');

Route::get('/user/profile', 'App\Http\Controllers\UserController@profile');
Route::get('/user/setting', 'App\Http\Controllers\UserController@setting');
Route::get('/user/coupon', 'App\Http\Controllers\UserController@coupon_list');
Route::post('/user/use_coupon', 'App\Http\Controllers\UserController@use_coupon');


//map
Route::get('/map', 'App\Http\Controllers\MainController@mapinit');
//map navigate
Route::any('/map/navigation/{eid}','App\Http\Controllers\EventController@map_navigation');
Route::any('/map/{latitude}/{longitude}', 'App\Http\Controllers\MainController@map_jump');


//event
Route::get('/likePost/{pid}', 'App\Http\Controllers\PostController@unLike');
Route::get('/unlikePost/{pid}', 'App\Http\Controllers\PostController@like');
Route::any('/postDetails/{pid}', 'App\Http\Controllers\PostController@postLoad')->name('post');


Route::get('/book/{eid}', 'App\Http\Controllers\EventController@book');
Route::get('/cancel/{eid}', 'App\Http\Controllers\EventController@cancel');
Route::any('/eventDetails/{eid}', 'App\Http\Controllers\EventController@eventLoadDetail')->name('event');


Route::get('/couponDetail/{cid}','App\Http\Controllers\EventController@couponLoadDetail')->name('coupon');
Route::get('/punch/{eid}','App\Http\Controllers\EventController@punch')->name('punch');
Route::get('/punchInGo/{eid}','App\Http\Controllers\EventController@punchInGo');
Route::get('/punchInStay/{eid}','App\Http\Controllers\EventController@punchInStay');

//Route::post('/commentEvent', 'App\Http\Controllers\MainController@comment_store');
//Route::post('/commentPost', 'App\Http\Controllers\MainController@commentPost');

Route::post('/comment', 'App\Http\Controllers\MainController@comment_store');


