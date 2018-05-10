<?php

/*
|--------------------------------------------------------------------------
| Basic REST concepts
|--------------------------------------------------------------------------
|
| From the tutorial
| 
| List Posts
| GET /posts
| 
| Request New Post Form
| GET /posts/create
| 
| Submit new form content to site
| POST /posts
| 
| Get a single post for editing
| GET /posts/{id}/edit
| 
| Update edited post on site
| PATCH /posts/{id}
| 
| Delete a post
| DELETE /posts/{id}
|
| https://laravel.com/docs/5.6/routing#form-method-spoofing
| 
| HTML forms do not support PUT, PATCH or DELETE actions. 
| So, when defining PUT, PATCH or DELETE routes that are called from an HTML form, 
| you will need to add a hidden _method field to the form. 
| The value sent with the _method field will be used as the HTTP request method:
| 
| <form action="/foo/bar" method="POST">
|   @method('PUT')
|   @csrf
| </form>
*/

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Relation of controller, model, migration names: 
| controller => PostController
| Eloquent model => Post
| migration => create_posts_table
|
*/

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
// User Home Page Web
// ------------------------------------------------------------

Route::middleware('auth:web')->get('/home', 'HomeController@index')->name('home');


// ------------------------------------------------------------
// Manage
// ------------------------------------------------------------

$manage_route = '/'.config('app.management', 'manage');

// Blog Management Page
// Route::get($manage_route, 'DashboardController@index')->name('dashboard')->middleware('can:view,App\Dashboard');
Route::middleware('auth:web')->get($manage_route, 'DashboardController@index')->name('dashboard')->middleware('can:view,App\Dashboard');

// Get New Post Form
Route::middleware('auth:web')->get($manage_route.'/posts/create', 'PostController@create')->name('get_post_create_form')->middleware('can:create,App\Post');

// Create a new post with given form data
Route::middleware('auth:web')->post($manage_route.'/posts', 'PostController@store')->name('save_new_post')->middleware('can:create,App\Post');

// Get Posts list in manage view
Route::middleware('auth:web')->get($manage_route.'/posts', 'ManageController@postslist')->name('manage_posts_list')->middleware('can:browse,App\Post'); 

// View post in manage view
Route::middleware('auth:web')->get($manage_route.'/posts/{post}', 'ManageController@viewpost')->name('manage_view_post')->middleware('can:view,post');

// Get Post Edit Form for selected post
Route::middleware('auth:web')->get($manage_route.'/posts/{post}/edit', 'PostController@edit')->name('get_post_edit_form')->middleware('can:update,post');

// Update post
Route::middleware('auth:web')->patch($manage_route.'/posts/{post}', 'PostController@update')->name('update_post')->middleware('can:update,post');

// Delete post
Route::middleware('auth:web')->delete($manage_route.'/posts/{post}', 'PostController@delete')->name('delete_post')->middleware('can:delete,post');

