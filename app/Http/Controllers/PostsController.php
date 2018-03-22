<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Post;
use App\Repositories\PostsRepository;
use Carbon\Carbon;
use Illuminate\Session\SessionManager;
use App\Http\Requests\PostForm;
use App\Http\Requests\PostDeleteForm;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show',]);
    }
    
    public function create()
    {
        return view('manage.page.posts.create');
    }
    
    public function store(PostForm $form)
    {
        $form->persist();
        
        return redirect()->route('managepostlist');
    }

    public function index(PostsRepository $postsrepo)
    {
        $posts = $postsrepo->latest()->get();
        
        return view('frontview.page.posts.index', compact('posts') );
    }
    
    public function show(Post $post)
    {
        return view('frontview.page.posts.show', compact('post') );
    }
    
    public function edit(Post $post)
    {
        return view('manage.page.posts.edit', compact('post'));
    }
    
    public function update(PostForm $form,Post $post)
    {
        $form->update($post);
        
        return redirect()->route('managepostlist');
    }
    
    public function delete(Post $post)
    {
        auth()->user()->deletePost($post);

        return redirect()->route('managepostlist');
    }
}
