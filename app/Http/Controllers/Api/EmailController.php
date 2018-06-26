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

    public function delete(Request $request, Email $email){
      try{
        $email->delete();
        response()->json(['success' => 'success'], 200);
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

}
