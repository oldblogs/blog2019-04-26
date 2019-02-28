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
        $result = [];
        $result['tests'] = new TestCollection(Test::all());
        return $result;
      }
      catch(\Exception $e){
        // TODO: Log Error
        // TODO: Generate more proper response
        response()->json(['result' => 'error'], 500);
      }
    }

    public function show(Test $test){
      // TODO: User input validation
      try{
        // TODO: User input validation of $test
        $result =  Test::where('id', $test)->get();
      
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
      $validatedData = $request->validate([
        'title' => 'required|min:3',
      ]);

      try{
        $test = new Test();
        $test->title = $request->title;
        $test->save();

        $result = Test::where('id', $test->id)->first();
        return $result;
      }
      catch(\Exception $e){
        // TODO: Log Error
        // TODO: Generate more proper response
        response()->json(['result' => 'error'], 500);
      }
    }

    public function update(Request $request, Test $test){
      // TODO: Input validation
      $validateData = $request->validate([
        'title' => 'required|min:3',
      ]);

      try{
        $test->title = request('title');
        $test->save();

        $result =  Test::where('id', $test->id )->first();
        return $result;
      }
      catch(\Exception $e){
        // TODO: Log Error
        // TODO: Generate more proper response
        response()->json(['result' => 'error'], 500);
      }

    }

    public function delete(Request $request, Test $test){
      // TODO: check user input validation
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
