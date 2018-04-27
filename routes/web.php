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
Route::get('/', 'PostController@index')->name('home');

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

// Blog Management Page
Route::get($manage_route, 'ManageController@index')->name('manage');

// Get New Post Form
Route::get($manage_route.'/posts/create', 'PostController@create')->name('getpostform');

// Create a new post with given form data
Route::post($manage_route.'/posts', 'PostController@store')->name('savenewpost');

// Get Posts list in manage view
Route::get($manage_route.'/posts', 'ManageController@postslist')->name('managepostslist');

// View post in manage view
Route::get($manage_route.'/posts/{post}', 'ManageController@viewpost')->name('manageviewpost');

// Get Post Edit Form for selected post
Route::get($manage_route.'/posts/{post}/edit', 'PostController@edit')->name('getposteditform');

// Update post
Route::patch($manage_route.'/posts/{post}', 'PostController@update')->name('updatepost');

// Delete post
Route::delete($manage_route.'/posts/{post}', 'PostController@delete')->name('deletepost');




