<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Test;
use Carbon\Carbon;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\TestResource;
use App\Http\Resources\TestCollection;
use App\Http\Controllers\Controller;


class TestController extends Controller
{
    // TODO: better return values

    public function index(){
      try{
        $result = new TestCollection(Test::all());
        return $result;
      }
      catch(\Exception $e){
        // TODO: Log Error
        // TODO: Generate more proper response
        response()->json(['result' => 'error'], 500);
      }
    }

    public function show(Test $test){
      try{
        // TODO: User input validation of $test
        $result =  new TestCollection( Test::where('id', $test)->get()  );
        return $result;
      }
      catch(\Exception $e){
        // TODO: Log Error
        // TODO: Generate more proper response
        response()->json(['result' => 'error'], 500);
      }

    }

    public function create(Request $request){
      $validatedData = $request->validate([
        'title' => 'required|min:3',
      ]);

      try{
        $test = new Test( request(['title', ]) );

        $test->save();

        response()->json(['result' => 'success'], 200);
      }
      catch(\Exception $e){
        // TODO: Log Error
        // TODO: Generate more proper response
        response()->json(['result' => 'error'], 500);
      }
    }

    public function update(Request $request, Test $test){
      // TODO: Input validation
      // TODO: Check unique email
      $validateData = $request->validate([
        'title' => 'required|min:3',
      ]);

      try{
        // TODO: Check is it the same record
        $test->title = request('title');
        $test->save();
        response()->json(['result' => 'success'], 200);
      }
      catch(\Exception $e){
        // TODO: Log Error
        // TODO: Generate more proper response
        response()->json(['result' => 'error'], 500);
      }

    }

    public function delete(Request $request, Test $test){
      try{
        $test->delete();
        response()->json(['result' => 'success'], 200);
      }
      catch(\Exception $e){
        // TODO: Log Error
        // TODO: Generate more proper response
        response()->json(['result' => 'error'], 500);
      }
    }

}
