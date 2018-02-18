<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class PostsController extends Controller
{
    public function index()
    {
        return view('posts.index');
    }
    
    public function show()
    {
        return view('posts.show');
    }
    
    
    public function create()
    {
        return view('posts.create');
    }
    
    public function store()
    {
        // TODO: USER INPUT NOT SANITIZED. SANITIZE USER INPUT
        Post::create([
            'title' => request('title'),
            'body' => request('body')
        ]);
        
        // And then redirect to home page
        return redirect('/');
        
    }
}
