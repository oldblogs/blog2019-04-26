<?php

namespace App\Policies;

use App\User;
use App\Dashboard;
use Illuminate\Auth\Access\HandlesAuthorization;

class DashboardPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the dashboard.
     *
     * @param  \App\User $user
     * @param  \App\Dashboard $dashboard
     * @return mixed
     */
    public function view(User $user)
    {
        if($user->hasPermissionTo('view dashboard')){
            return true;
        }
        else{
            return false;
        }
    }

    // /**
    //  * Determine whether the user can create dashboards.
    //  *
    //  * @param  \App\User  $user
    //  * @return mixed
    //  */
    // public function create(User $user)
    // {
    //     // TODO: Proper authorization 
    //     return true;
    // }

    // /**
    //  * Determine whether the user can update the dashboard.
    //  *
    //  * @param  \App\User  $user
    //  * @param  \App\Dashboard  $dashboard
    //  * @return mixed
    //  */
    // public function update(User $user, Dashboard $dashboard)
    // {
    //     // TODO: Proper authorization 
    //     return true;
    // }

    // /**
    //  * Determine whether the user can delete the dashboard.
    //  *
    //  * @param  \App\User  $user
    //  * @param  \App\Dashboard  $dashboard
    //  * @return mixed
    //  */
    // public function delete(User $user, Dashboard $dashboard)
    // {
    //     // TODO: Proper authorization 
    //     return true;
    // }
}
