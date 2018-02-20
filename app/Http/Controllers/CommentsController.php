<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Post;
use App\Comment;

class CommentsController extends Controller
{
    public function store(Post $post)
    {
        // TODO: Sanitation, Validation
        $this->validate(request(),[
            'body' => 'required|min:2|max:1000'
        ]);
        
        $post->addComment(request('body'));
        
        return back();
    }
}
