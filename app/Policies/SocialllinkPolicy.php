<?php

namespace App\Policies;

use App\User;
use App\Sociallink;
use Illuminate\Auth\Access\HandlesAuthorization;

class SocialllinkPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can browse sociallinks.
     * 
     * @param \App\User $user 
     * @return mixed
     */
    public function browse(User $user){
      try{
        return ( $user->hasRole('admin') ) ? true : false ;
      }
      catch(Exception $e){
        return false;
      }
    }

    /**
     * Determine whether the user can view the sociallink.
     *
     * @param  \App\User  $user
     * @param  \App\Sociallink  $sociallink
     * @return mixed
     */
    public function view(User $user, Sociallink $sociallink)
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
     * Determine whether the user can create sociallinks.
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
     * Determine whether the user can update the sociallink.
     *
     * @param  \App\User  $user
     * @param  \App\Sociallink  $sociallink
     * @return mixed
     */
    public function update(User $user, Sociallink $sociallink)
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
     * Determine whether the user can delete the sociallink.
     *
     * @param  \App\User  $user
     * @param  \App\Sociallink  $sociallink
     * @return mixed
     */
    public function delete(User $user, Sociallink $sociallink)
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
