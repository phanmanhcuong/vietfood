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
use \App\Post;

Route::get('/', 'WelcomeController@index');

/*Sign up */
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

/* Log in */
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

// Ranking
Route::get('ranking/like', 'RankingController@like')->name('ranking.like');

//Comment
Route::post('comments/{userId}/{postId}', 'CommentsController@comment')->name('comments.create');

//Search
Route::get('posts/search', 'PostsController@search')->name('posts.search');

Route::group(['middleware' => ['auth']], function(){
    /* user profile */
    Route::get('users/{id}', 'UsersController@showEditProfileForm')->name('users.edit_profile_get');
    Route::put('users/{id}', 'UsersController@edit_profile')->name('users.edit_profile_post');
    
    /* post */
    Route::resource('posts', 'PostsController', ['only' => ['create', 'store', 'show', 'edit', 'update', 'destroy']]);
    
    /* like post */
    Route::group(['prefix' => 'users/{id}'], function(){
        Route::post('like', 'UserLikeController@like')->name('user_like.like');
        Route::delete('like', 'UserLikeController@unlike')->name('user_like.unlike');
        Route::get('is_like', 'UserLikeController@is_like')->name('user_like.is_like');
        Route::get('show_posts', 'UsersController@show_posts')->name('users.show_posts');
        
            
        // search users'posts
        Route::get('search_posts', 'UsersController@search_posts')->name('users.search_posts');

    });
});

