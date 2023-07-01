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

use App\Post;
use App\Http\Resources\PostResource;
use App\Http\Controllers\Api\PostController;

use App\Medium;
use App\Http\Resources\MediumResource;
use App\Http\Controllers\Api\MediumController;

use App\MediumType;
use App\Http\Resources\MediumTypeResource;
use App\Http\Controllers\Api\MediumTypeController;

use App\License;
use App\Http\Resources\LicenseResource;
// use App\Http\Controllers\Api\LicenseController;


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
  ->name('sociallinks.delete');


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

// delete profile photo
Route::middleware('auth:api', 'role:apiadmin')
  ->delete($mapi_route.'/aboutphoto/{about}', 'Api\AboutController@deletephoto')
  ->name('about.photodelete');


// Post Records

// browse post records
Route::middleware('auth:api', 'role:apiadmin')
  ->get($mapi_route.'/posts/{page?}', 'Api\PostController@index')
  ->name('posts.index');

// update post
Route::middleware('auth:api', 'role:apiadmin')
  ->patch($mapi_route.'/posts/{post}', 'Api\PostController@update')
  ->name('posts.update');

// create post
Route::middleware('auth:api', 'role:apiadmin' )
  ->post($mapi_route.'/posts', 'Api\PostController@create')
  ->name('posts.create');

// delete post
Route::middleware('auth:api', 'role:apiadmin')
  ->delete($mapi_route.'/posts/{post}', 'Api\PostController@delete')
  ->name('posts.delete');


// Medium Records

// Browse medium records
// Route::middleware('auth:api', 'role:apiadmin')
//   ->get($mapi_route.'/media/{page?}', 'Api\MediumController@index')
//   ->name('media.index');

Route::middleware('auth:api')
  ->get($mapi_route.'/media/{page?}', 'Api\MediumController@index')
  ->name('media.index');



// Update
Route::middleware('auth:api', 'role:apiadmin')
  ->patch($mapi_route.'/media/{medium}', 'Api\MediumController@update')
  ->name('media.update');

// // Create
// Route::middleware('auth:api', 'role:apiadmin')
//   ->post($mapi_route.'/media', 'Api\MediumController@create')
//   ->name('media.create');

// Delete
// Route::middleware('auth:api', 'role:apiadmin')
//   ->delete($mapi_route.'/media/{medium}', 'Api\MediumController@delete')
//   ->name('media.delete');

// View
Route::middleware('auth:api', 'role:apiadmin')
  ->get($mapi_route.'/media/{id}', 'Api\MediumController@view')
  ->name('media.view');
