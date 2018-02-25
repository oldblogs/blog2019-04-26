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

// use App\Task;
// Route::get('/tasks', 'TasksController@index');
// Route::get('/tasks/{task}', 'TasksController@show');

// controller => PostsController
// Eloquent model => Post
// migration => create_posts_table

// Main page
Route::get('/', 'PostsController@index')->name('home');

// Get New Post Form
Route::get('/posts/create', 'PostsController@create');

// Create a new post with given form data
Route::post('/posts', 'PostsController@store');

// List Posts
Route::get('/posts', 'PostsController@index');

// Get a single Post
Route::get('/posts/{post}', 'PostsController@show');


// Create a new comment with given form data
Route::post('/posts/{post}/comments', 'CommentsController@store');


// Get Registration Form
Route::get('/register', 'RegistrationsController@create');

// Create a new User with given form data
Route::post('/register', 'RegistrationsController@store');


// Get Login Form
Route::get('/login', 'SessionsController@create');

// Login to blog with given form data
Route::post('/login', 'SessionsController@store');

// Logout from blog
// "post request would be better" 
Route::get('/logout', 'SessionsController@destroy');