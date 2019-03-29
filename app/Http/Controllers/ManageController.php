<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PostsRepository;
use Carbon\Carbon;
use Illuminate\Session\SessionManager;
use App\Http\Requests\PostForm;

class ManageController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    // TODO: Delete after conversion
    public function postslist(PostsRepository $postsrepo){
        $posts = $postsrepo->paginated();
        return view('manage.page.posts.index', compact('posts') );
    }
    
    // TODO: Delete after conversion
    public function viewpost(Post $post){
        return view('manage.page.posts.show', compact('post') );
    }
    
    // TODO: Delete before production
    public function test(User $user){
        return view('manage.page.test', compact('user') );
    }
}
