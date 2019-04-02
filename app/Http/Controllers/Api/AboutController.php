<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\About;
use Carbon\Carbon;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\AboutResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class AboutController extends Controller {
    
  public function view(){
    try{
      // TODO: Show max file size limit
      // TODO: User input validation of $about
      // $about = new About();
      $aboutAry = About::where( 'user_id', auth()->user()->id )->get();

      if ( 0 === $aboutAry->count() ){
        // Create an empty new record and return it

        $about = new About();
        $about->user_id = auth()->user()->id;
        $about->save();
        
        return $about;
      }
      elseif( 1 < $aboutAry->count() ){
        // Duplicate records 
        // TODO: Log
        response()->json(['result' => 'error'], 500);
      }
      elseif( 1 === $aboutAry->count() ){
        return $aboutAry[0];
      }

    }
    catch(\Exception $e){
      // TODO: Log Error
      // TODO: Generate more proper response
      response()->json(['result' => 'error'], 500);
    }
  }

  public function update(Request $request, About $about){
    // Validate uploaded file
    $validateData = $request->validate([
      'title' => 'string',
      'subtitle' => 'string',
      'body' => 'string',
      // 'photo' => 'file',
    ]);

    try{
      // TODO: check ownership
      // TODO: remove older file if exists
      $about->title = $request->title ;
      $about->subtitle = $request->subtitle;
      $about->body = $request->body;

      // TODO: Check uploaded file
      if ( null !== $request->file('photofile') )  {
        $about->photo  = $request->file('photofile')->store('images', 'public');
      }
      $about->save();

      $result = [];
      $result['result'] = "ok";
      $result['message'] = "About updated.";
      $result['about'] = About::where('user_id', auth()->user()->id )->first();
      return $result;

    }
    catch(\Exception $e){
      // TODO: Log Error
      // TODO: Generate more proper response
      response()->json(['result' => 'error'], 500);
    }

  }

  public function delete(About $about){
    // TODO: Delete this method if not needed
    // TODO: check user input validation
    try{
      $about->delete();
      return true;
    }
    catch(\Exception $e){
      // TODO: Log Error
      // TODO: Generate more proper response
      return false;
    }
  }

  public function deletephoto(Request $request, About $about){
    try{
      if ( auth()->user()->id !== $about->user_id ){
        // TODO: Generate more proper response
        response()->json(['result' => 
          'You do not have the permission to delete this file.'], 401);
      }
      else{
        Storage::disk('public')->delete( $about->photo );
        $about->photo = null;
        $about->save();
        response()->json(['result' => 'success'], 200);
      }
    }
    catch(\Exception $e){
      // TODO: Log Error
      // TODO: Generate more proper response
      response()->json(['result' => 'error'], 500);
    }
  }
}

