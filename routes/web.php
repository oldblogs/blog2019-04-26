<?php

Auth::routes();

// ------------------------------------------------------------
// Front view
// ------------------------------------------------------------

// Main page
Route::get('/', 'PostController@index')->name('mainpage');

// List Posts
Route::get('/posts', 'PostController@index');

// Get a single Post
Route::get('/posts/{post}', 'PostController@show');

// About page
Route::get('/about', 'AboutController@show')->name('about');


// ------------------------------------------------------------
// Manage
// ------------------------------------------------------------

$manage_route = '/'.config('app.management', 'manage');

// ------------------------------------------------------------
// Social Logins
// ------------------------------------------------------------
// https://laravel.com/docs/5.6/socialite


// Google Sign In
// https://hdtuto.com/article/laravel-56-login-with-google-with-socialite
// TODO : Check routes exist
if( null !== config('services.google.client_id')  ) {
  
  Route::get( config('services.google.auth_endpoint') ,
    'Auth\GoogleController@redirectToGoogle')->name('google_auth_endpoint');

  Route::get( config('services.google.token_exchange_endpoint') ,
    'Auth\GoogleController@handleGoogleCallback');
}

// Github Sign In
// 
// TODO : Check routes exist
if( null !== config('services.github.client_id')  ) {

  Route::get( config('services.github.auth_endpoint') ,
    'Auth\GithubController@redirectToGithub')->name('github_auth_endpoint');

  Route::get( config('services.github.token_exchange_endpoint') ,
    'Auth\GithubController@handleGithubCallback');
}


// User Home Page Web
Route::middleware('auth:web')->get('/home',
  'HomeController@index')->name('home');

// Blog Management Page
Route::middleware('auth:web')->get($manage_route, 'DashboardController@index')
  ->name('dashboard')->middleware('can:view,App\Dashboard');

// TODO: Modify implementation as in 
// https://laravel.com/docs/5.6/controllers
// Actions Handled By Resource Controller
  
// Get New Post Form
Route::middleware('auth:web')->get($manage_route.'/posts/create',
  'PostController@create')->name('get_post_create_form')
  ->middleware('can:create,App\Post');

// Create a new post with given form data
Route::middleware('auth:web')->post($manage_route.'/posts',
  'PostController@store')->name('save_new_post')
  ->middleware('can:create,App\Post');

// Get Posts list in manage view
Route::middleware('auth:web')->get($manage_route.'/posts',
  'ManageController@postslist')->name('manage_posts_list')
  ->middleware('can:browse,App\Post');

// View post in manage view
Route::middleware('auth:web')->get($manage_route.'/posts/{post}',
  'ManageController@viewpost')->name('manage_view_post')
  ->middleware('can:view,post');

// Get Post Edit Form for selected post
Route::middleware('auth:web')->get($manage_route.'/posts/{post}/edit',
  'PostController@edit')->name('get_post_edit_form')
  ->middleware('can:update,post');

// Update post
Route::middleware('auth:web')->patch($manage_route.'/posts/{post}',
  'PostController@update')->name('update_post')->middleware('can:update,post');

// Delete post
Route::middleware('auth:web')->delete($manage_route.'/posts/{post}',
  'PostController@delete')->name('delete_post')->middleware('can:delete,post');

// Test page
Route::middleware('auth:web')->get($manage_route.'/test',
  'ManageController@test');
