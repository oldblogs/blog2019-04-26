<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        
        return view('posts.index', compact('posts') );
    }
    
    public function show(Post $post)
    {
        return view('posts.show', compact('post') );
    }
    
    
    public function create()
    {
        return view('posts.create');
    }
    
    public function store()
    {
        // TODO: Sanitize user input
        // TODO: Strengthen the validation

        $this->validate(request(),[
            'title' => 'required|max:200',
            
            'body' => 'required|max:1000'
            
        ]);
        
        Post::create( request(['title', 'body']) );
        
        return redirect('/');
        
    }
}
