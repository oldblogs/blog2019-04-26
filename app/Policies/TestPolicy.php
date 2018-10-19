<?php

namespace App\Policies;

use App\User;
use App\Test;
use Illuminate\Auth\Access\HandlesAuthorization;

class TestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can browse tests.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function browse(User $user)
    {
      try{
        return ( $user->hasRole('admin') ) ? true : false;
      } 
      catch(Exception $e){
        return false;
      } 
    }

    /**
     * Determine whether the user can view the email.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
      try{
        return ( $user->hasRole('admin') ) ? true : false;
      }
      catch(Exception $e){
        // TODO: Log the error
        return false;
      }
    }

    /**
     * Determine whether the user can update the email.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
      try{
        return ( $user->hasRole('admin') ) ? true : false;
      }
      catch(Exception $e){
        // TODO: Log the error
        return false;
      }
    }

    /**
     * Determine whether the user can create emails.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
      try{
        return ( $user->hasRole('admin') ) ? true : false;
      }
      catch(Exception $e){
        // TODO: Log the error
        return false;
      }
    }

    /**
     * Determine whether the user can delete the email.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
      try{
        return ( $user->hasRole('admin') ) ? true : false;
      }
      catch(Exception $e){
        // TODO: Log the error
        return false;
      }
    }
}
