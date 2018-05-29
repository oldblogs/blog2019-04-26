<?php

namespace App\Policies;

use App\User;
use App\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the post.
     *
     * @param  \App\User $user
     * @param  \App\Post $post
     * @return mixed
     */
    public function view(User $user, Post $post)
    {
        // Everyone can view a published Post
        if ($post->published){
            return true;
        }
        elseif ($user->id === $post->user_id){
            // Writer of an unpublished post would read the post.
            return  true;
        }
        else{
            // Must be an admin in this case
            return ( $user->hasPermissionTo('view post') ) ? true : false;
        }
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return ( $user->hasRole('admin') ) ? true : false;
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        if($user->id === $post->user_id){
            return true;
        }
        elseif($user->hasPermissionTo('update post')){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function delete(User $user, Post $post)
    {
        if($user->id === $post->user_id){
            return true;
        }
        elseif($user->hasPermissionTo('delete post')){
            return true;
        }
        else{
            return false;
        }
    }
    
    /**
     * Determine whether the user can browse the posts.
     * 
     * @param  \App\User  $user
     * @return mixed
     */
    public function browse(User $user)
    {
        if( $user->hasPermissionTo('browse post') ){
            return true;
        }
        else{
            return false;
        }
    }
}