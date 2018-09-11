<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Repositories\PostsRepository;
use Carbon\Carbon;
use Illuminate\Session\SessionManager;
use App\Http\Requests\PostForm;
use App\Http\Requests\DeleteForm;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    public function create()
    {
        return view('manage.page.posts.create');
    }

    public function store(PostForm $form)
    {
        $form->persist();

        return redirect()->route('manage_posts_list');
    }

    public function index(PostsRepository $postsrepo)
    {
        $posts = $postsrepo->paginated();

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

        return redirect()->route('manage_posts_list');
    }

    public function delete(DeleteForm $form, Post $post)
    {
        // Form request object implemetation problem
        // TODO: Validation ( Proper implementation of a
        // Form Request object for delete method with validation )
        // Cause of the problem may be multiple forms in one page

        // TODO: Check for proper execution path
        $form->delete($post);

        // Auth::user()->deletePost( $post );

        return redirect()->route('manage_posts_list');
    }
}
