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
        return ( $user->hasRole('admin') ) ? true : false;
    }


}
