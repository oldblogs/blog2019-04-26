<?php 

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Medium;
use App\MediumType;
use App\License;
use Carbon\Carbon;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\MediumResource;
use App\Http\Resources\MediumCollection;
use App\Http\Resources\MediumTypeResource;
use App\Http\Resources\MediumTypeCollection;
use App\Http\Resources\LicenseResource;
use App\Http\Resources\LicenseCollection;
use App\Http\Controllers\Controller;

class MediumController extends Controller {

  public function index(Request $request){
    // TODO: User input validation
    $isValidated = $request->validate([
      'page' => 'integer',
    ]);
    
    // TODO: user input sanitation
    try{
      if( isset($request->page) ){
        $page = (int)$request->page;
      }
      else{
        $page = 1;
      }
      
      // TODO: Return related pagination page
      $mpp = (int)config('app.media_per_page', 10);
      $result = [];
      $result["media"] = new MediumCollection( Medium::latest()
                           ->with('medium_type')
                           ->with('license') 
                           ->paginate( $mpp, $columns =['*'], $pageName = null, $page)
                           ->withPath("media") );
      $result["licences"] = new LicenseCollection( License::all() );
      $result["mediumtypes"] = new MediumTypeCollection( MediumType::all() );
      return response($result, 200);
      // return [
      //   "media" => new MediumCollection(  Medium::latest()
      //                                       ->with('medium_type')
      //                                       ->with('license') 
      //                                     ->paginate( $mpp, $columns =['*'], $pageName = null, $page)
      //                                     ->withPath("media") ),
      //   "mediumtypes" => new MediumTypeCollection( MediumType::all() ),
      //   "licences" => new LicenseCollection( License::all() )
      // ];

    }
    catch(\Exception $e){
      // TODO: Log Error
      // TODO: Generate more proper response
      response()->json( ['result' => 'error'], 500);
    }
  }

  public function show(Medium $medium){
    try{
      // TODO: User input validation
      $result = Medium::where('id', $medium)->get();
  
      if( 0 === $result->count() ){
        abort(403, 'Not found.');
      }
      elseif( 1 === $result->count() ){
        return $result;
      }

      // TODO: Log Unexpected state
      // TODO: Proper error message
      response()->json(['result' => 'error'], 500);
    }
    catch(\Exception $e){
      // TODO: Log Error
      // TODO: Generate more proper response
      response()->json( ['result' => 'error'], 500);
    }
  
  }

  public function create(Request $request){
    // TODO: User input validation
    $isValidated = $request->validate([
      'medium_type_id' => 'integer',
      'license_id' => 'integer',
      'file' => 'string',
      'external_url' => 'text',
      'stock_url' => 'text',
      'stock_desc' => 'string',

    ]);

    try{
      $medium = new Medium();
      $medium->medium_type_id = $request->medium_type_id;
      $medium->license_id = $request->license_id;
      // $medium->file = $request
      $medium->external_url = $request->external_url;
      $medium->stock_url = $request->stock_url;
      $medium->stock_desc = $request->stock_desc;
      $medium->save();

      $result = Medium::where('id', $medium->id)->first();
      return $result;
    }
    catch(\Exception $e){
      // TODO: Log Error
      // TODO: Generate more proper response
      response()->json(['result' => 'error'], 500);
    }
  }

  public function update(Request $request, Medium $medium){
    // TODO: Input validation
    $isValidated = $request->validate([
      'medium_type_id' => 'integer',
      'license_id' => 'integer',
      'file' => 'string',
      'external_url' => 'text',
      'stock_url' => 'text',
      'stock_desc' => 'string',

    ]);

    try{
      $medium->medium_type_id = $request->medium_type_id;
      $medium->license_id = $request->license_id;
      // $medium->file = $request
      $medium->external_url = $request->external_url;
      $medium->stock_url = $request->stock_url;
      $medium->stock_desc = $request->stock_desc;
      $medium->save();

      $result = Medium::where('id', $medium->id)->first();
      return $result;
    }
    catch(\Exception $e){
      // TODO: Log Error
      // TODO: Generate more proper response
      response()->json(['result' => 'error'], 500);
    }
  }

  public function delete(Request $request, Medium $medium){
    // TODO: Check user input validation
    $isValidated = $request->validate([
      'id' => 'integer',
    ]);
    
    try{
      $medium->delete();
      response()->json(['result' => 'success'], 200);
    }
    catch(\Exception $e){
      // TODO: Log Error
      // TODO: Generate more proper response
      response()->json(['result' => 'error'], 500 );
    }
  }

}

