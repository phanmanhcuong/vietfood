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
use \App\User;

Route::get('/', 'WelcomeController@index');

/*Sign up */
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

/* Log in */
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

Route::group(['middleware' => ['auth']], function(){
    Route::get('users/{id}', 'UsersController@showEditProfileForm')->name('users.edit_profile_get');
    Route::put('users/{id}', 'UsersController@edit_profile')->name('users.edit_profile_post');
    /* 
    Route::get('posts', 'PostsController@showPostForm')->name('posts.post_register_get');
    Route::post('posts', 'PostsController@register_post')->name('posts.post_register_post'); 
    */
    Route::resource('posts', 'PostsController', ['only' => ['create', 'store', 'show', 'edit', 'update', 'destroy']]);
});