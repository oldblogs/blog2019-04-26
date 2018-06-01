<?php

namespace App\Policies;

use App\User;
use App\About;
use Illuminate\Auth\Access\HandlesAuthorization;

class AboutPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can browse the about records.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function browse(User $user)
    {
        return ( $user->can('browse about') ) ? true : false;
    }

    /**
     * Determine whether the user can create abouts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return ( $user->can('create about') ) ? true : false;
    }
    
    /**
     * Determine whether the user can create abouts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function store(User $user)
    {
        return ( $user->can('store about') ) ? true : false;
    }
    
    /**
     * Determine whether the user can view the about record.
     *
     * @param  \App\User  $user
     * @param  \App\About  $about
     * @return mixed
     */
    public function show(User $user, About $about)
    {
        return ( $user->hasPermissionTo('show about') ) ? true : false;
    }

    /**
     * Determine whether the user can update the about.
     *
     * @param  \App\User  $user
     * @param  \App\About  $about
     * @return mixed
     */
    public function edit(User $user, About $about)
    {
        return ( $user->hasPermissionTo('edit about') ) ? true : false;
    }
    
    /**
     * Determine whether the user can update the about.
     *
     * @param  \App\User  $user
     * @param  \App\About  $about
     * @return mixed
     */
    public function update(User $user, About $about)
    {
        return ( $user->hasPermissionTo('update about') ) ? true : false;
    }

    /**
     * Determine whether the user can delete the about.
     *
     * @param  \App\User  $user
     * @param  \App\About  $about
     * @return mixed
     */
    public function delete(User $user, About $about)
    {
        return ( $user->can('delete about') ) ? true : false;
    }
}
