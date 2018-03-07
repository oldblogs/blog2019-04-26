<?php

namespace App\Http\Controllers;

use App\Comment;

use Illuminate\Session\SessionManager;


class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store($post_id)
    {
        // TODO: User input validation.
        $this->validate(request(),[
            'body' => 'required|min:2|max:1000'
        ]);
        
        $body = request('body');
        
        // TODO: User input validation
        auth()->user()->publishComment(
            new Comment( compact('post_id', 'body') )
        );
        
        session()->flash(
            'message', 'Your comment has now been published'
        );
        
        return back();
    }
}
