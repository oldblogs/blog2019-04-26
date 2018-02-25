<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Post;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show',]);
    }
    
    public function index()
    {
        $posts = Post::latest()
            ->filter(request(['month', 'year']))
            ->get();
        
        // Temporary
        
        $archives = Post::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
            ->groupBy('year', 'month')
            ->orderByRaw('min(created_at) desc')
            ->get()
            ->toArray();
        
        return view('posts.index', compact('posts', 'archives') );
    }
    
    public function show(Post $post)
    {
        // TODO: Sanitize user input
        // TODO: Strengthen the validation
        
        $archives = Post::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
        ->groupBy('year', 'month')
        ->orderByRaw('min(created_at) desc')
        ->get()
        ->toArray();
        
        return view('posts.show', compact('post', 'archives') );
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
        
        //TODO: Sanitation, Validation
        auth()->user()->publish(
            new Post( request(['title', 'body']) )
        );
        
        return redirect('/');
        
    }
}
