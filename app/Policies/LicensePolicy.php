<?php 

namespace App\Policies;

use App\License;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LicensePolicy{
  use HandlesAuthorization;

  /**
   * Determine whether the user can browse the license.
   * 
   * @param \App\User $user
   * @return mixed
   */
  public function browse(User $user){
    try{
      return ($user->hasRole('admin') ) ? true : false ;
    }
    catch(\Exception $e){
      // TODO: Log Error
      return false;
    }
  }

  /**
   * Determine whether the view is enabled. If enabled anybody can see it.
   * 
   * @param \App\User $user
   * @param \App\License $license
   * @return mixed
   */
  public function view(User $user, License $license){
    try{
      if ($license->enabled) {
        return true;
      }
      else {
        return ($user->hasRole('admin') ) ? true : false ;
      }
    }
    catch(\Exception $e){
      // TODO: Log Error
      return false;
    }
  }

  /** 
   * Determine whether the user can create license.
   * 
   * @param \App\User $user
   * @return mixed
   */
  public function create(User $user){
    try{
      return ( $user->hasRole('admin') ) ? true : false;
    }
    catch(\Exception $e){
      // TODO: Log error
      return false;
    }
  }

  /**
   * Determine whether the user can update the license.
   * 
   * @param \App\User $user
   * @param \App\License $license
   * @return mixed
   */
  public function update(User $user, License $license){
    try{
      return ( $user->hasRole('admin'))? true: false;
    }
    catch(\Exception $e){
      // TODO: Log Error
      return false; 
    }
  }

  /**
   * Determine whether the user can delete the license.
   * 
   * @param \App\User $user
   * @param \App\License $license
   * @return mixed 
   */
  public function delete(User $user, License $license){
    try{
      return ( $user->hasRole('admin'))? true: false;
    }
    catch(\Exception $e){
      // TODO: Log error
      return false;
    }
  }
}