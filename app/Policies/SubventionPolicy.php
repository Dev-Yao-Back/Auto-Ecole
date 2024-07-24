<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Subvention;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubventionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasAnyRole(['superadmin', 'admin', 'superviseur']);
    }

    public function view(User $user, Subvention $subvention)
    {
        return $user->hasAnyRole(['superadmin', 'admin', 'superviseur']);
    }

    public function create(User $user)
    {
        return $user->hasAnyRole(['superadmin', 'admin']);
    }

    public function update(User $user, Subvention $subvention)
    {
        return $user->hasAnyRole(['superadmin', 'admin']);
    }

    public function delete(User $user, Subvention $subvention)
    {
        return $user->hasRole('superadmin');
    }

    public function restore(User $user, Subvention $subvention)
    {
        return $user->hasRole('superadmin');
    }

    public function forceDelete(User $user, Subvention $subvention)
    {
        return $user->hasRole('superadmin');
    }
}
