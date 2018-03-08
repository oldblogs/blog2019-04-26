<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Post;
use App\Repositories\Posts;
use Carbon\Carbon;
use Illuminate\Session\SessionManager;
use App\Http\Requests\PostForm;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show',]);
    }
    
    public function index(Posts $posts)
    {
        $posts = Post::latest()
            ->filter(request(['month', 'year']))
            ->get();
        
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
    
    public function store(PostForm $form)
    {
        $form->persist();
        
        return redirect('/');
    }
}
