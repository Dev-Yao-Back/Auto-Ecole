<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Session;
use Illuminate\Auth\Access\HandlesAuthorization;

class SessionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasAnyRole(['superadmin', 'admin', 'superviseur', 'agent']);
    }

    public function view(User $user, Session $session)
    {
        return $user->hasAnyRole(['superadmin', 'admin', 'superviseur', 'agent']);
    }

    public function create(User $user)
    {
      return $user->hasAnyRole(['superadmin', 'admin', 'superviseur', 'agent']);
    }

    public function update(User $user, Session $session)
    {
        return $user->hasAnyRole(['superadmin', 'admin', 'superviseur']);
    }

    public function delete(User $user, Session $session)
    {
        return $user->hasRole('superadmin', 'admin');
    }

    public function restore(User $user, Session $session)
    {
        return $user->hasRole('superadmin');
    }

    public function forceDelete(User $user, Session $session)
    {
        return $user->hasRole('superadmin');
    }
}
