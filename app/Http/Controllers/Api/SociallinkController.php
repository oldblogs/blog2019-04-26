<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Sociallink;
use Carbon\Carbon;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\SociallinkResource;
use App\Http\Resources\SociallinkCollection;
use App\Http\Controllers\Controller;


class SociallinkController extends Controller
{
    public function index(){
        try{
          $result = new SociallinkCollection(Sociallink::all());
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
      // TODO: Check unique sociallink
      $validatedData = $request->validate([
        'order' => 'required|integer|min:1|max:255',
        'title' => 'required|min:3|max:255',
        'csocial_id' => 'required|integer',
        'link' => 'required|min:13|max:255',
      ]);

      try{
        $csociallink = new Sociallink( request(['order', 'title', 'csocial_id', 'link']) );
        // TODO: Add user_id value

        $csociallink->save();

        response()->json(['result' => 'success'], 200);
      }
      catch(\Exception $e){
        // TODO: Log Error
        // TODO: Generate more proper response
        response()->json(['result' => 'error'], 500);
      }

    }
}
