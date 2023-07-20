<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Repositories\PostsRepository;
use Carbon\Carbon;
use Illuminate\Session\SessionManager;
use App\Http\Requests\DeleteForm;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{

    public function index(PostsRepository $postsrepo)
    {
        $posts = $postsrepo->paginated();

        return view('frontview.page.posts.index', compact('posts') );
    }

    public function mainpage(PostsRepository $postsrepo)
    {
        $posts = $postsrepo->mainpage();

        return view('frontview.page.mainpage', compact('posts') );
    }

    public function show(Post $post)
    {
        return view('frontview.page.posts.show', compact('post') );
    }

}
