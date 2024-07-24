<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasRole('superadmin');
    }

    public function view(User $user, Permission $permission)
    {
        return $user->hasRole('superadmin');
    }

    public function create(User $user)
    {
        return $user->hasRole('superadmin');
    }

    public function update(User $user, Permission $permission)
    {
        return $user->hasRole('superadmin');
    }

    public function delete(User $user, Permission $permission)
    {
        return $user->hasRole('superadmin');
    }

    public function restore(User $user, Permission $permission)
    {
        return $user->hasRole('superadmin');
    }

    public function forceDelete(User $user, Permission $permission)
    {
        return $user->hasRole('superadmin');
    }
}
