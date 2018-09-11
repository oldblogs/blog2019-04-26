<?php

namespace App\Policies;

use App\User;
use App\Email;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmailPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can browse emails.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function browse(User $user)
    {
      return true;
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
        // TODO : Complete
    }

    /**
     * Determine whether the user can delete the email.
     *
     * @param  \App\User  $user
     * @param  \App\Email  $email
     * @return mixed
     */
    public function delete(User $user)
    {
      // TODO : Complete
      return false;
    }
}
