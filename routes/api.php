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

// TODO: Implement verified mail

// browse
Route::middleware('auth:api', 'role:apiadmin')
  ->get($mapi_route.'/emails', 'Api\EmailController@index')
  ->name('emails.index');

// view
//Route::middleware('auth:api', 'can:view,App\Email')
//  ->post($mapi_route.'/emails/{email}', 'Api\EmailController@show')
//  ->name('emails.view');

// update
Route::middleware('auth:api', 'role:apiadmin')
  ->patch($mapi_route.'/emails/{email}', 'Api\EmailController@update')
  ->name('emails.update');

// create
Route::middleware('auth:api', 'role:apiadmin')
  ->post($mapi_route.'/emails', 'Api\EmailController@create')
  ->name('emails.create');

// delete
Route::middleware('auth:api', 'role:apiadmin')
  ->delete($mapi_route.'/emails/{email}', 'Api\EmailController@delete')
  ->name('emails.delete');

// Get a test result
Route::middleware('auth:api', 'role:apiadmin')
  ->get($mapi_route.'/test', 'Api\TestController@index')
  ->name('test.index');

