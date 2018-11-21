<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Sociallink;
use App\Csocial;
use Carbon\Carbon;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\SociallinkResource;
use App\Http\Resources\SociallinkCollection;
use App\Http\Resources\CsocialResource;
use App\Http\Resources\CsocialCollection;
use App\Http\Controllers\Controller;


class SociallinkController extends Controller
{
    public function index(){
      try{
        $result = [];
        $result['sociallinks']    = new SociallinkCollection( Sociallink::all() );
        $result['socialnetworks'] = new CsocialCollection( Csocial::all() );
        return $result;
      }
      catch(\Exception $e){
        // TODO: Log Error
        // TODO: Generate more proper response
        response()->json( ['result' => 'error'], 500 );
      }
    }

    public function index_p(){
      try{
        $result = [];
        $result['sociallinks']    = new SociallinkCollection( Sociallink::self()->with('csocial')->get() );
        $result['socialnetworks'] = new CsocialCollection( Csocial::all() );
        return $result;
      }
      catch(\Exception $e){
        // TODO: Log Error
        // TODO: Generate more proper response
        response()->json(['result' => 'error'], 500);
      }
    }

    public function show(Sociallink $sociallink){
      try{
        // TODO: User input validation of $sociallink
        $result = Sociallink::where('id', $sociallink)->self()->with('csocial')->get() ;

        if( 0 === $result->count() ) {
          abort(403, 'Not found.');
        }
        elseif( 1 === $result->count() ){
          return $result;
        }

        // TODO: Log, must not come to this point
        abort(500, 'Unauthorized action.');  
      }
      catch(\Exception $e){
        // TODO: Log Error
        // TODO: Generate more proper response
        response()->json(['result' => 'error'], 500);
      }
    }

    public function create(Request $request){
      // TODO: Input validation
      // TODO: Check unique sociallink
      
      // $validatedData = $request->validate([
      //   'title' => 'required|string|min:3|max:255',
      //   'csocial_id' => 'required|integer|min:1',
      //   'link' => 'required|min:13|max:255',
      // ]);

      $validatedData = $request->validate([
        'title' => 'required',
        'csocial_id' => 'required',
        'link' => 'required',
      ]);

      try{
        $sociallink = new Sociallink();
        $sociallink->user_id = auth()->user()->id;
        $sociallink->title = $request->title;
        $sociallink->csocial_id = $request->csocial_id;
        $sociallink->link = $request->link;
        $sociallink->save();

        $result = Sociallink::where('id', $sociallink->id )->with('csocial')->first() ;
        return $result;
      }
      catch(\Exception $e){
        // TODO: Log Error
        // TODO: Generate more proper response
        response()->json(['result' => 'error'], 500);
      }

    }

    public function update(Request $request, Sociallink $sociallink){
      // TODO: Input validation
      $validateData = $request->validate([
        'title' => 'required|string|min:3|max:255',
        'csocial_id' => 'required|integer|min:1',
        'link' => 'required|min:5|max:255',
      ]);

      try{
        if ( auth()->user()->id != $sociallink->user_id ){
          // TODO: Generate more proper response
          response()->json([
            'result' => 'You do not have the permission to change this record.'
          ], 401);
        }
        else{
          $sociallink->title = request('title');
          $sociallink->csocial_id = request('csocial_id');
          $sociallink->link = request('link');
          $sociallink->save();
         
          // Return the updated record with extra info about social network
          $result = Sociallink::where('id', $sociallink->id )->with('csocial')->first() ;
          return $result;
        }
      }
      catch(\Exception $e){
        // TODO: Log Error
        // TODO: Generate more proper response
        response()->json(['result' => 'error'], 500);
      }
    }

    public function delete(Request $request, Sociallink $sociallink){
      try{
        if ( auth()->user()->id != $sociallink->user_id ){
          // TODO: Generate more proper response
          response()->json(['result' => 
            'You do not have the permission to delete this record.'], 401);
        }
        else{
          $sociallink->delete();
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

