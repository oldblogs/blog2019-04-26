<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Csocial;
use Carbon\Carbon;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CsocialResource;
use App\Http\Resources\CsocialCollection;
use App\Http\Controllers\Controller;


class CsocialController extends Controller
{
    // TODO: better return values

    public function index(){
      try{
        $result = new CsocialCollection(Csocial::all());
        return $result;
      }
      catch(\Exception $e){
        // TODO: Log Error
        // TODO: Generate more proper response
        response()->json(['result' => 'error'], 500);
      }
    }

    public function show(Csocial $csocial){
      try{
        // TODO: User input validation
        $result =  new CsocialCollection( Csocial::where('id', $csocial)->get() );
        return $result;
      }
      catch(\Exception $e){
        // TODO: Log Error
        // TODO: Generate more proper response
        response()->json(['result' => 'error'], 500);
      }

    }

    public function create(Request $request){
      // TODO: Input validation
      // TODO: Check unique email
      $validatedData = $request->validate([
        'title' => 'required|min:3|max:255|unique:csocials,title',
        'css_class' => 'required|string|min:1|max:255',
        'homepage' => 'required|string|min:5|max:255',
      ]);

      try{
        $csocial = new Csocial();
        $csocial->title = $request->title;
        $csocial->css_class = $request->css_class;
        $csocial->homepage = $request->homepage;
        $csocial->save();

        response()->json(['result' => 'success'], 200);
      }
      catch(\Exception $e){
        // TODO: Log Error
        // TODO: Generate more proper response
        response()->json(['result' => 'error'], 500);
      }
    }

    public function update(Request $request, Csocial $csocial){
      // TODO: Input validation
      $validateData = $request->validate([
        'title' => 'required|min:3|max:255|unique:csocials,title',
        'css_class' => 'required|string|min:1|max:255',
        'homepage' => 'required|string|min:5|max:255',
      ]);

      try{
        $csocial->title = $request->title;
        $csocial->css_class = $request->css_class;
        $csocial->homepage = $request->homepage;
        $csocial->save();
        response()->json(['result' => 'success'], 200);
      }
      catch(\Exception $e){
        // TODO: Log Error
        // TODO: Generate more proper response
        response()->json(['result' => 'error'], 500);
      }

    }

    public function delete(Request $request, Csocial $csocial){
      try{
        $csocial->delete();
        response()->json(['result' => 'success'], 200);
      }
      catch(\Exception $e){
        // TODO: Log Error
        // TODO: Generate more proper response
        response()->json(['result' => 'error'], 500);
      }
    }

}
