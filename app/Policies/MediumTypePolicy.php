<?php 

namespace App\Policies;

use App\MediumType;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MediumTypePolicy{
  use HandlesAuthorization;

  /**
   * Determine whether the user can browse media types.
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
   * Anyone can see media types.
   * 
   * @return mixed
   */
  public function view(){
    try{
      return true;
    }
    catch(\Exception $e){
      // TODO: Log Error
      return false;
    }
  }

  /** 
   * Determine whether the user can create a medium type.
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
   * Determine whether the user can update the medium type.
   * 
   * @param \App\User $user
   * @param \App\MediumType $mediumtype 
   * @return mixed
   */
  public function update(User $user, MediumType $mediumtype){
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