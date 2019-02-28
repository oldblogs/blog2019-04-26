<?php

use Illuminate\Http\Request;

use App\Email;
use App\Http\Resources\EmailResource;
use App\Http\Controllers\Api\EmailController;

use App\Sociallink;
use App\Http\Resources\SociallinkResource;
use App\Http\Controllers\Api\SociallinkController;

use App\Csocial;
use App\Http\Resources\CsocialResource;
use App\Http\Controllers\Api\CsocialController;

use App\Test;
use App\Http\Resources\TestResource;
use App\Http\Controllers\Api\TestController;

use App\About;
use App\Http\Resources\AboutResource;
use App\Http\Controllers\Api\AboutController;

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

// TODO: Implement verified email

// browse email
// All emails
// Route::middleware('auth:api', 'role:apiadmin')
//   ->get($mapi_route.'/emails', 'Api\EmailController@index')
//   ->name('emails.index');

// browse email
// Emails that belongs to the logged in user
Route::middleware('auth:api', 'role:apiadmin')
  ->get($mapi_route.'/emails', 'Api\EmailController@index_p')
  ->name('emails.index');

// update email
Route::middleware('auth:api', 'role:apiadmin')
  ->patch($mapi_route.'/emails/{email}', 'Api\EmailController@update')
  ->name('emails.update');

// create email
Route::middleware('auth:api', 'role:apiadmin')
  ->post($mapi_route.'/emails', 'Api\EmailController@create')
  ->name('emails.create');

// delete email
Route::middleware('auth:api', 'role:apiadmin')
  ->delete($mapi_route.'/emails/{email}', 'Api\EmailController@delete')
  ->name('emails.delete');


// browse sociallink
Route::middleware('auth:api', 'role:apiadmin')
  ->get($mapi_route.'/sociallinks', 'Api\SociallinkController@index_p')
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


// Test Records

// browse test records
Route::middleware('auth:api', 'role:apiadmin')
  ->get($mapi_route.'/tests', 'Api\TestController@index')
  ->name('tests.index');

// update test
Route::middleware('auth:api', 'role:apiadmin')
  ->patch($mapi_route.'/tests/{test}', 'Api\TestController@update')
  ->name('tests.update');

// create test record
Route::middleware('auth:api', 'role:apiadmin' )
  ->post($mapi_route.'/tests', 'Api\TestController@create')
  ->name('tests.create');

// delete test record
Route::middleware('auth:api', 'role:apiadmin')
  ->delete($mapi_route.'/tests/{test}', 'Api\TestController@delete')
  ->name('tests.delete');


// About Records

// no browse, create, delete route

Route::middleware('auth:api', 'role:apiadmin')
  ->get($mapi_route.'/about', 'Api\AboutController@view')
  ->name('about.view');

// update about
Route::middleware('auth:api', 'role:apiadmin')
  ->patch($mapi_route.'/about/{about}', 'Api\AboutController@update')
  ->name('about.update');




