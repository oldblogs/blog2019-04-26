<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Repositories\PostsRepository;
use Carbon\Carbon;
use Illuminate\Session\SessionManager;
use App\Http\Requests\PostForm;

class ManageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('manage.page.index');
    }
    
    public function postslist(PostsRepository $postsrepo)
    {
        
        $posts = $postsrepo->paginated();
        
        return view('manage.page.posts.index', compact('posts') );
    }
    
}
