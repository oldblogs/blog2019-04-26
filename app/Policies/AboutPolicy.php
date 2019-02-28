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
        return ( $user->hasRole('apiadmin') ) ? true : false;
    }

    /**
     * Determine whether the user can create abouts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return ( $user->hasRole('apiadmin') ) ? true : false;
    }
    
    /**
     * Determine whether the user can create abouts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function store(User $user)
    {
        return ( $user->hasRole('apiadmin') ) ? true : false;
    }
    
    /**
     * Determine whether the user can view the about record.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        return ( $user->hasRole('apiadmin') ) ? true : false;
    }

    /**
     * Determine whether the user can update the about.
     *
     * @param  \App\User  $user
      * @return mixed
     */
    public function edit(User $user)
    {
        return ( $user->hasRole('apiadmin') ) ? true : false;
    }
    
    /**
     * Determine whether the user can update the about.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        return ( $user->hasRole('apiadmin') ) ? true : false;
    }

    /**
     * Determine whether the user can delete the about.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return ( $user->hasRole('apiadmin') ) ? true : false;
    }
}
