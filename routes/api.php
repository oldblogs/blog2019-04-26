<?php

use Illuminate\Http\Request;
use App\Email;
use App\Http\Resources\EmailResource;
use App\Http\Controllers\Api\EmailController;
use App\Sociallink;
use App\Http\Resources\SociallinkResource;
use App\Http\Controllers\Api\SociallinkController;

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

// browse mail
Route::middleware('auth:api', 'role:apiadmin')
  ->get($mapi_route.'/emails', 'Api\EmailController@index')
  ->name('emails.index');

// update mail
Route::middleware('auth:api', 'role:apiadmin')
  ->patch($mapi_route.'/emails/{email}', 'Api\EmailController@update')
  ->name('emails.update');

// create mail
Route::middleware('auth:api', 'role:apiadmin')
  ->post($mapi_route.'/emails', 'Api\EmailController@create')
  ->name('emails.create');

// delete mail
Route::middleware('auth:api', 'role:apiadmin')
  ->delete($mapi_route.'/emails/{email}', 'Api\EmailController@delete')
  ->name('emails.delete');


// browse sociallink
Route::middleware('auth:api', 'role:apiadmin')
  ->get($mapi_route.'/sociallinks', 'Api\SociallinkController@index')
  ->name('sociallinks.index');

// update sociallink
Route::middleware('auth:api', 'role:apiadmin')
  ->patch($mapi_route.'/sociallinks/{sociallink}', 'Api\SociallinkController@update')
  ->name('sociallinks.update');

// create sociallink
Route::middleware('auth:api', 'role:apiadmin')
  ->post($mapi_route.'/sociallinks', 'Api\SociallinkController@create')
  ->name('sociallinks.create');

// delete sociallink
Route::middleware('auth:api', 'role:apiadmin')
  ->delete($mapi_route.'/sociallinks/{sociallink}', 'Api\SociallinkController@delete')
  ->name('emails.delete');


// Get a test result
Route::middleware('auth:api', 'role:apiadmin')
  ->get($mapi_route.'/test', 'Api\TestController@index')
  ->name('test.index');

