<?php

namespace App\Http\Controllers\Api;

use App\Email;
use App\Http\Resources\EmailResource;
use App\Http\Resources\EmailCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EmailController extends Controller
{
    // TODO better return values
    
    public function index(){
      try{
        $result = new EmailCollection(Email::all());
        return $result;
      }
      catch(\Exception $e){
        return false;
      }
    }

    public function view(Email $email){
      // TODO: User input validation of $email
      $result =  new EmailCollection( Email::where('id', $email)->get()  );
      return $result;
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

        return response()->json([
          'result' => 'OK',
        ]);
      }
      catch(\Exception $e){
        // TODO: Log Error
        // TODO: Generate more proper response
        return response()->json([
          'result' => 'Error',
        ]);
      }
    }
    
    public function delete(Request $request, Email $email){
      try{
        $email->delete();
        response()->json(['success' => 'success'], 200);
      }
      catch(\Exception $e){
        response()->json(['error' => 'invalid'], 500);
      }
    }
    


}
