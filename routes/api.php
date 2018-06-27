<?php

use Illuminate\Http\Request;
use App\Email;
use App\Http\Resources\EmailResource;
use App\Http\Controllers\Api\EmailController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$mapi_route = '/'.config('app.mapi', 'manage');

//Route::middleware('auth:api')->get('/user', 'Api\UserController@index');

// Get Emails list in for about contacts list
//Route::middleware('auth:api', 'role:admin')
Route::get($mapi_route.'/emails', 'Api\EmailController@index')
  ->name('emails.index');

Route::get($mapi_route.'/emails/{email}', 'Api\EmailController@view')
  ->name('emails.view');

Route::post($mapi_route.'/emails', 'Api\EmailController@create')
  ->name('emails.create');
  
// Delete email
//Route::middleware('auth:api', 'can:delete,email')
Route::delete($mapi_route.'/emails/{email}', 'Api\EmailController@delete')
  ->name('emails.delete');



// Get a test result
// Route::middleware('auth:api', 'role:admin')
Route::get($mapi_route.'/test', 'Api\TestController@index')
  ->name('test.index');

// Route::get('/emails', 'Api\EmailController@index');
