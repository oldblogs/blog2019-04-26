<?php 

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Medium;
use App\MediumType;
use Carbon\Carbon;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\MediumResource;
use App\Http\Resources\MediumCollection;
use App\Http\Resources\MediumTypeResource;
use App\Http\Resources\MediumTypeCollection;
use App\Http\Controllers\Controller;

class MediumTypeController extends Controller {
  
  public function index(Request $request){
    try{
      $result = [];
      $result["mediumtypes"] = new MediumTypeCollection( MediumType::all() );
      return response($result, 200);
    }
    catch(\Exception $e){
      response()->json( ['result' => 'error'], 500);
    }
  }

  public function show(MediumType $mediumtype){
    try{
      // TODO: User input validation
      $result = MediumType::where('id', $mediumtype)->get();
  
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
      'mtype' => 'string',
      'msubtype' => 'string',
      'mclass' => 'string',

    ]);

    try{
      $mediumtype = new MediumType();
      $mediumtype->mtype = $request->mtype;
      $mediumtype->msubtype = $request->msubtype;
      $mediumtype->mclass = $request->mclass;
      $mediumtype->save();

      $result = MediumType::where('id', $mediumtype->id)->first();
      return $result;
    }
    catch(\Exception $e){
      // TODO: Log Error
      // TODO: Generate more proper response
      response()->json(['result' => 'error'], 500);
    }
  }


  public function update(Request $request, MediumType $mediumtype){
    // TODO: Input validation
    $isValidated = $request->validate([
      'id' => 'integer',
      'mtype' => 'string',
      'msubtype' => 'string',
      'mclass' => 'string',
    ]);

    try{
      $mediumtype->mtype = $request->mtype;
      $mediumtype->msubtype = $request->msubtype;
      $mediumtype->mclass = $request->mclass;
      $mediumtype->save();

      $result = MediumType::where('id', $mediumtype->id)->first();
      return $result;
    }
    catch(\Exception $e){
      // TODO: Log Error
      // TODO: Generate more proper response
      response()->json(['resut' => 'error'], 500);
    }
  }

  public function delete(Request $request, MediumType $mediumtype){
    // TODO: Check user input validation
    $isValidated = $request->validate([
      'id' => 'integer',
    ]);
    
    try{
      $mediumtype->delete();
      response()->json(['result' => 'success'], 200);
    }
    catch(\Exception $e){
      // TODO: Log Error
      // TODO: Generate more proper response
      response()->json(['result' => 'error'], 500 );
    }
  } 

}

