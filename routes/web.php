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

Route::get('/', function () {
    return view('home');
});
Route::get('/home', function () {
    return view('home');
});


Auth::routes();

Route::get('/login/socialite/{provider}', 'Auth\LoginController@redirectToProvider')->name('login.socialite');
Route::get('/login/socialite/{provider}/callback', 'Auth\LoginController@handleProviderCallback');


Route::group(['middleware' => 'role:super-admin'], function() {
	Route::view('admin', 'admin.dashboard')->name('admin');
	Route::resource('admin/permission', 'Admin\\PermissionController');
	Route::resource('admin/role', 'Admin\\RoleController');
	Route::resource('admin/user', 'Admin\\UserController');
});
