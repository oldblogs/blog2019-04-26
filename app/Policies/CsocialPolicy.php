<?php

namespace App\Policies;

use App\User;
use App\Csocial;
use Illuminate\Auth\Access\HandlesAuthorization;

class CsocialPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can browse the csocials.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function browse(User $user)
    {
        try{
            return ( $user->hasRole('admin') ) ? true : false;
        }
        catch(\Exception $e){
            // TODO: Log , change error message
            session()->flash( 'message', 'An error occured.' );
        }
    }

    /**
     * Determine whether the user can create csocials.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        try{
            return ( $user->hasRole('admin') ) ? true : false;
        }
        catch(\Exception $e){
            // TODO: Log , change error message
            session()->flash( 'message', 'An error occured.' );
        }
    }
    
    /**
     * Determine whether the user can create csocials.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function store(User $user)
    {
        try{
            return ( $user->hasRole('admin') ) ? true : false;
        }
        catch(\Exception $e){
            // TODO: Log , change error message
            session()->flash( 'message', 'An error occured.' );
        }
    }
    
    /**
     * Determine whether the user can view the csocial.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function show(User $user)
    {
        try{
            return ( $user->hasRole('admin') ) ? true : false;
        }
        catch(\Exception $e){
            // TODO: Log , change error message
            session()->flash( 'message', 'An error occured.' );
        }
    }

    /**
     * Determine whether the user can update the csocial.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function edit(User $user)
    {
        try{
            return ( $user->hasRole('admin') ) ? true : false;
        }
        catch(\Exception $e){
            // TODO: Log , change error message
            session()->flash( 'message', 'An error occured.' );
        }
    }

    /**
     * Determine whether the user can update the csocial.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        try{
            return ( $user->hasRole('admin') ) ? true : false;
        }
        catch(\Exception $e){
            // TODO: Log , change error message
            session()->flash( 'message', 'An error occured.' );
        }
    }

    /**
     * Determine whether the user can delete the csocial.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        try{
            return ( $user->hasRole('admin') ) ? true : false;
        }
        catch(\Exception $e){
            // TODO: Log , change error message
            session()->flash( 'message', 'An error occured.' );
        }
    }
    
}
