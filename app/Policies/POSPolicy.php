<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class POSPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any POS.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->hasAnyRole(['superadmin', 'admin', 'superviseur', 'agent']);
    }

    /**
     * Determine whether the user can view the POS.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user)
    {
        return $user->hasAnyRole(['superadmin', 'admin', 'superviseur', 'agent']);
    }

    /**
     * Determine whether the user can create POS.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasRole('superadmin');
    }

    /**
     * Determine whether the user can update the POS.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)
    {
        return $user->hasRole('superadmin');
    }

    /**
     * Determine whether the user can delete the POS.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        return $user->hasRole('superadmin');
    }

    /**
     * Determine whether the user can restore the POS.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user)
    {
        return $user->hasRole('superadmin');
    }

    /**
     * Determine whether the user can permanently delete the POS.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user)
    {
        return $user->hasRole('superadmin');
    }
}