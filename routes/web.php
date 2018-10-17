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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::prefix('admin')->group(function(){
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/addpost', 'AdminPostController@create')->name('admin.dashboard.addpost');
    Route::post('/addpost', 'AdminPostController@store')->name('admin.dashboard.addpost');
});


Route::get('/viewpost/{id}', 'UserPostController@show');

Route::get('/like/{id}', 'UserPostController@like');
Route::get('/dislike/{id}', 'UserPostController@dislike');
// Route::get('/viewpost/{id}', 'AdminPostController@show');