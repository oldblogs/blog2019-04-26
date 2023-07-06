<?php

Route::get('register/{code}/{email}', 'Auth\RegisterController@showRegistrationForm')->name('getregister');
Route::post('register/{code}/{email}', 'Auth\RegisterController@register')->name('postregister');

// E-mail verification routes
Route::get('email/verify',      'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend',      'Auth\VerificationController@resend')->name('verification.resend');     

// Authentication Routes...
if ( config('app.form_login') ) {
  Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
  Route::post('login', 'Auth\LoginController@login');
  
  // Blog admin makes password reset request with terminal artisan command :
  // php artisan user:reset-password <user email>
  // An email is sent to the user with a link.
    
  // Password Reset Routes...
  Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
  Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.reset.process');

} else {
  if( 'form_login' === config('app.default_auth') ){
    // When we disable form_login , we must also change the default_auth in .env
    // TODO: Log error
    abort(500, 'Error: Misconfiguration.');
  } else {
    // default_auth ' s first letter is made uppercase and route is formed
    // TODO: check for strings starting with letter i
    $routetg = 'Auth\\'                . ucfirst( config('app.default_auth') ) .
               'Controller@redirectTo' . ucfirst( config('app.default_auth') );
    Route::get('login', $routetg)->name('login');
  }
}

// ------------------------------------------------------------
// Social Logins
// ------------------------------------------------------------
// https://laravel.com/docs/5.7/socialite


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

Route::post('logout', 'Auth\LoginController@logout')->name('logout');


// ------------------------------------------------------------
// Front view - Pages that non administrator visitors see
// ------------------------------------------------------------

// Main page
Route::get('/', 'PostController@homepage')->name('mainpage');

// List Posts
Route::get('/posts', 'PostController@index');

// Get a single Post
Route::get('/posts/{post}', 'PostController@show');

// About page
Route::get('/about', 'AboutController@index')->name('about');

// ------------------------------------------------------------
// Manage View - Pages that registered users see.
//   Every registered users can see /profile page.
//   Authorization needed for certain pages.
// ------------------------------------------------------------

$manage_route = '/'.config('app.management', 'manage');

// User Profile Page Web
Route::middleware('auth:web', 'verified')->get('/profile',
  'ProfileController@index')->name('profile');

// Blog Management Page
Route::middleware('auth:web', 'role:admin')
  ->get($manage_route, 'DashboardController@index')
  ->name('dashboard');

// ------------------------------------------------------------
// Posts
// ------------------------------------------------------------

// Get New Post Form
Route::middleware('auth:web', 'role:admin')
  ->get($manage_route.'/posts/create', 'PostController@create')
  ->name('get_post_create_form');

// Create a new post with given form data
Route::middleware('auth:web', 'role:admin')
  ->post($manage_route.'/posts', 'PostController@store')
  ->name('save_new_post');

// Get Posts list in manage view
Route::middleware('auth:web', 'role:admin')
  ->get($manage_route.'/posts', 'ManageController@postslist')
  ->name('manage_posts_list');

// View post in manage view
Route::middleware('auth:web', 'role:admin')
  ->get($manage_route.'/posts/{post}', 'ManageController@viewpost')
  ->name('manage_view_post');

// Get Post Edit Form for selected post
Route::middleware('auth:web', 'role:admin')
  ->get($manage_route.'/posts/{post}/edit', 'PostController@edit')
  ->name('get_post_edit_form');

// Update post
Route::middleware('auth:web', 'role:admin')
  ->patch($manage_route.'/posts/{post}', 'PostController@update')
  ->name('update_post');

// Delete post
Route::middleware('auth:web', 'role:admin')
  ->delete($manage_route.'/posts/{post}', 'PostController@delete')
  ->name('delete_post');

// ------------------------------------------------------------
// Csocials
// ------------------------------------------------------------

// Get Csocials list in manage view
Route::middleware('auth:web', 'role:admin')
  ->get($manage_route.'/csocials',  'CsocialController@index')
  ->name('csocials.index');

// Get New Csocial Form
Route::middleware('auth:web', 'role:admin')
  ->get($manage_route.'/csocials/create', 'CsocialController@create')
  ->name('csocials.create');

// Create a new contact record with given form data
Route::middleware('auth:web', 'role:admin')
  ->post($manage_route.'/csocials', 'CsocialController@store')
  ->name('csocials.store');

// Show an contact record in the manage view
Route::middleware('auth:web', 'role:admin')
  ->get($manage_route.'/csocials/{csocial}',  'CsocialController@show')
  ->name('csocials.show');

// Edit an contact record
Route::middleware('auth:web', 'role:admin')
  ->get($manage_route.'/csocials/{csocial}/edit', 'CsocialController@edit')
  ->name('csocials.edit');

// Update an contact record
Route::middleware('auth:web', 'role:admin')
  ->patch($manage_route.'/csocials/{csocial}',  'CsocialController@update')
  ->name('csocials.update');

// Delete an contact record
Route::middleware('auth:web', 'role:admin')
  ->delete($manage_route.'/csocials/{csocial}', 'CsocialController@delete')
  ->name('csocials.delete');

