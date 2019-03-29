<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Post;
use Carbon\Carbon;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostCollection;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    // TODO: better return values

    public function index(Request $request){
      // TODO: User input validation 
      $validatedData = $request->validate([
        'page' => 'integer',
      ]);

      try{
        if( isset($request->page) ){
          $page = $request->page;  
        }
        else{
          $page = 1;
        }
        
        // TODO: Return related pagination page
        $ppp = (int)config('app.posts_per_page', 10);
        // $result = new PostCollection(Post::latest()->paginate($ppp)->withPath("posts") );
        $result = new PostCollection(Post::latest()->paginate( 
          $ppp,  $columns = ['*'], $pageName = null , $page)->withPath("posts") );
        return $result;
      }
      catch(\Exception $e){
        // TODO: Log Error
        // TODO: Generate more proper response
        response()->json(['result' => 'error'], 500);
      }
    }

    public function show(Post $post){
      try{
        // TODO: User input validation 
        $result =  Post::where('id', $post)->get();
      
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
      // TODO: User input validation 
      $validatedData = $request->validate([
        'title' => 'required|min:3',
        'body' => 'required|min:3',

      ]);

      try{
        $post = new Post();
        $post->user_id = auth()->user()->id;
        $post->title = $request->title;
        $post->body = $request->body;
        // validate boolean
        $post->published = $request->published;
        $post->save();

        $result = Post::where('id', $post->id)->first();
        return $result;
      }
      catch(\Exception $e){
        // TODO: Log Error
        // TODO: Generate more proper response
        response()->json(['result' => 'error'], 500);
      }
    }

    public function update(Request $request, Post $post){
      // TODO: Input validation
      $validateData = $request->validate([
        'title' => 'required|min:3',
        'body' => 'required|min:3',
      ]);

      try{
        $post->title = request('title');
        $post->body = $request->body;
        $post->published = $request->published;
        $post->save();

        $result =  Post::where('id', $post->id )->first();
        return $result;
      }
      catch(\Exception $e){
        // TODO: Log Error
        // TODO: Generate more proper response
        response()->json(['result' => 'error'], 500);
      }

    }

    public function delete(Request $request, Post $post){
      // TODO: check user input validation
      try{
        $post->delete();
        response()->json(['result' => 'success'], 200);
      }
      catch(\Exception $e){
        // TODO: Log Error
        // TODO: Generate more proper response
        response()->json(['result' => 'error'], 500);
      }
    }

}
