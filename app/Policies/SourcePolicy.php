<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Source;
use Illuminate\Auth\Access\HandlesAuthorization;

class SourcePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasAnyRole(['superadmin', 'admin',  ]);
    }

    public function view(User $user, Source $source)
    {
        return $user->hasAnyRole(['superadmin', 'admin', ]);
    }

    public function create(User $user)
    {
        return $user->hasAnyRole(['superadmin', 'admin']);
    }

    public function update(User $user, Source $source)
    {
        return $user->hasAnyRole(['superadmin', 'admin']);
    }

    public function delete(User $user, Source $source)
    {
        return $user->hasRole('superadmin');
    }

    public function restore(User $user, Source $source)
    {
        return $user->hasRole('superadmin');
    }

    public function forceDelete(User $user, Source $source)
    {
        return $user->hasRole('superadmin');
    }
}