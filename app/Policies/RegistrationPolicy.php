<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Registration;
use Illuminate\Auth\Access\HandlesAuthorization;

class RegistrationPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasAnyRole(['superadmin', 'admin', 'superviseur', 'agent']);
    }

    public function view(User $user, Registration $registration)
    {
        return $user->hasAnyRole(['superadmin', 'admin', 'superviseur', 'agent']);
    }

    public function create(User $user)
    {
      return $user->hasAnyRole(['superadmin', 'admin', 'superviseur', 'agent']);
    }

    public function update(User $user, Registration $registration)
    {
      return $user->hasAnyRole(['superadmin', 'admin', 'superviseur', 'agent']);
    }

    public function delete(User $user, Registration $registration)
    {
      return $user->hasAnyRole(['superadmin', 'admin', 'superviseur']);
    }

    public function restore(User $user, Registration $registration)
    {
        return $user->hasRole('superadmin');
    }

    public function forceDelete(User $user, Registration $registration)
    {
        return $user->hasRole('superadmin');
    }
}
