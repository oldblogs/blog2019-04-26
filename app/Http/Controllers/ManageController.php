<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Repositories\PostsRepository;
use Carbon\Carbon;
use Illuminate\Session\SessionManager;
use App\Http\Requests\PostForm;

class ManageController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function postslist(PostsRepository $postsrepo){
        $posts = $postsrepo->paginated();
        return view('manage.page.posts.index', compact('posts') );
    }

    public function viewpost(Post $post){
        return view('manage.page.posts.show', compact('post') );
    }
}
