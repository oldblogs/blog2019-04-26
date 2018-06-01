<?php

// Authentication Routes...
if ( config('app.form_login') ) {
  Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
  Route::post('login', 'Auth\LoginController@login');
} else {
  if( 'form_login' === config('app.default_auth') ){
    // When we disable form_login , we must also change the default_auth in .env
    abort(500, 'Error: Misconfiguration.');
  } else {
    // default_auth is made uppercase andsoute is formed
    $routetg = 'Auth\\'                . ucfirst( config('app.default_auth') ) . 
               'Controller@redirectTo' . ucfirst( config('app.default_auth') );
    Route::get('login', $routetg)->name('login');
  }
}

Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


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

// ------------------------------------------------------------
// Posts
// ------------------------------------------------------------
  
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
// TODO: Check the route above
  
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

// ------------------------------------------------------------
// Abouts
// ------------------------------------------------------------
  
// Get Abouts list in manage view
Route::middleware('auth:web')->get($manage_route.'/abouts',
  'AboutController@index_m')->name('abouts.index.m')->middleware('can:browse,App\About');

// Get New About Form
Route::middleware('auth:web')->get($manage_route.'/abouts/create',
  'AboutController@create')->name('abouts.create')->middleware('can:create,App\About');
  
// Create a new about record with given form data
Route::middleware('auth:web')->post($manage_route.'/abouts',
  'AboutController@store')->name('abouts.store')->middleware('can:store,App\About');
  
// Show an about record in the manage view
Route::middleware('auth:web')->get($manage_route.'/abouts/{about}',
  'AboutController@show')->name('abouts.show')->middleware('can:show,about'); 
  
// Edit an about record
Route::middleware('auth:web')->get($manage_route.'/abouts/{about}/edit',
  'AboutController@edit')->name('abouts.edit')->middleware('can:edit,about'); 

// Update an about record
Route::middleware('auth:web')->patch($manage_route.'/abouts/{about}',
  'AboutController@update')->name('abouts.update')->middleware('can:update,about');

// Delete an about record
Route::middleware('auth:web')->delete($manage_route.'/abouts/{about}',
  'AboutController@delete')->name('abouts.delete')->middleware('can:delete,about');
  

// ------------------------------------------------------------
// Tests - Playground
// ------------------------------------------------------------
// Test page
// Route::middleware('auth:web')->get($manage_route.'/test',
//   'ManageController@test');
