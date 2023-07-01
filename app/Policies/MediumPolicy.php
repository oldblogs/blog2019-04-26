<?php 

namespace App\Policies;

use App\Medium;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MediumPolicy{
  use HandlesAuthorization;

  /**
   * Determine whether the user can browse the media.
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
   * @param \App\Medium $medium
   * @return mixed
   */
  public function view(User $user, Medium $medium){
    try{
      if ($medium->enabled) {
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
   * Determine whether the user can create media.
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
   * Determine whether the user can update the medium.
   * 
   * @param \App\User $user
   * @param \App\Medium $medium
   * @return mixed
   */
  public function update(User $user, Medium $medium){
    try{
      return ( $user->hasRole('admin'))? true: false;
    }
    catch(\Exception $e){
      // TODO: Log Error
      return false; 
    }
  }

  /**
   * Determine whether the user can delete the medium.
   * 
   * @param \App\User $user
   * @param \App\Medium $medium
   * @return mixed 
   */
  public function delete(User $user, Media $medium){
    try{
      return ( $user->hasRole('admin'))? true: false;
    }
    catch(\Exception $e){
      // TODO: Log error
      return false;
    }
  }
}