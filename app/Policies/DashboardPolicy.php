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
        try{
            return ( $user->hasRole('admin') ) ? true : false;
        }
        catch(\Exception $e){
            // TODO: Log , change error message
            session()->flash( 'message', 'An error occured.' );
        }
    }
}
