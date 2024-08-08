<?php

namespace App\Policies;

use App\Models\User;
use App\Models\CandidatOnline;
use Illuminate\Auth\Access\HandlesAuthorization;

class CandidatOnlinePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function viewAny(User $user)
    {
        return $user->hasAnyRole(['superadmin', 'admin', 'superviseur']);
    }

    public function view(User $user, CandidatOnline $candidat)
    {
        return $user->hasAnyRole(['superadmin', 'admin', 'superviseur']);
    }

    public function create(User $user)
    {
        return $user->hasAnyRole(['superadmin', 'admin']);
    }

    public function update(User $user, CandidatOnline $candidat)
    {
        return $user->hasAnyRole(['superadmin', 'admin']);
    }

    public function delete(User $user, CandidatOnline $candidat)
    {
        return $user->hasRole('superadmin');
    }

    public function restore(User $user, CandidatOnline $candidat)
    {
        return $user->hasRole('superadmin');
    }
}