<?php

namespace App\Policies;

use App\Models\User;

class SuperviseurDashBoardPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can view the Superviseur Dashboard.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        // Assume 'superviseur' is the role for users who should access this dashboard
        return $user->hasAnyRole(['superadmin', 'admin', 'superviseur']);
    }

    /**
     * Determine whether the user can view details on the Superviseur Dashboard.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user)
    {
        return $user->hasAnyRole(['superadmin', 'admin', 'superviseur']);
    }

    /**
     * Determine whether the user can create new entries or actions in the Superviseur Dashboard.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasRole();
    }

    /**
     * Determine whether the user can update entries or settings in the Superviseur Dashboard.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)
    {
        return $user->hasRole('superadmin');
    }

    /**
     * Determine whether the user can delete entries in the Superviseur Dashboard.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        return $user->hasRole('superadmin');
    }

    /**
     * Determine whether the user can restore deleted entries in the Superviseur Dashboard.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user)
    {
        return $user->hasRole('superadmin');
    }


    /**
     * Determine whether the user can permanently delete entries in the Superviseur Dashboard.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user)
    {
        return $user->hasRole('superadmin');
    }
}