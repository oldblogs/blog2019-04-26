<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Email;
use Carbon\Carbon;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\EmailResource;
use App\Http\Resources\EmailCollection;
use App\Http\Controllers\Controller;


class EmailController extends Controller
{
    // TODO: better return values

    public function index(){
      try{
        $result = new EmailCollection(Email::all());
        return $result;
      }
      catch(\Exception $e){
        // TODO: Log Error
        // TODO: Generate more proper response
        response()->json(['result' => 'error'], 500);
      }
    }

    public function show(Email $email){
      try{
        // TODO: User input validation of $email
        $result =  new EmailCollection( Email::where('id', $email)->get()  );
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
        'title' => 'required|min:3|max:255',
        'email' => 'required|email|min:3|max:255',
      ]);

      try{
        $email = new Email( request(['title', 'email']) );

        $email->save();

        response()->json(['result' => 'success'], 200);
      }
      catch(\Exception $e){
        // TODO: Log Error
        // TODO: Generate more proper response
        response()->json(['result' => 'error'], 500);
      }
    }

    public function update(Request $request, Email $email){
      // TODO: Input validation
      // TODO: Check unique email
      $validateData = $request->validate([
        'title' => 'required|min:3|max:255',
        'email' => 'required|email|min:3|max:255',
      ]);

      try{
        $email->title = request('title');
        $email->email = request('email');
        $email->save();
        response()->json(['result' => 'success'], 200);
      }
      catch(\Exception $e){
        // TODO: Log Error
        // TODO: Generate more proper response
        response()->json(['result' => 'error'], 500);
      }

    }

    public function delete(Request $request, Email $email){
      try{
        $email->delete();
        response()->json(['result' => 'success'], 200);
      }
      catch(\Exception $e){
        // TODO: Log Error
        // TODO: Generate more proper response
        response()->json(['result' => 'error'], 500);
      }
    }

}
