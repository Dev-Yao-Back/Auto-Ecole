<?php

namespace App\Policies;

use App\Models\User;
use App\Models\GateWay;
use Illuminate\Auth\Access\HandlesAuthorization;

class GateWayPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasAnyRole(['superadmin', 'admin']);
    }

    public function view(User $user, GateWay $gateway)
    {
        return $user->hasAnyRole(['superadmin', 'admin']);
    }

    public function create(User $user)
    {
        return $user->hasAnyRole(['superadmin', 'admin']);
    }

    public function update(User $user, GateWay $gateway)
    {
        return $user->hasAnyRole(['superadmin', 'admin']);
    }

    public function delete(User $user, GateWay $gateway)
    {
        return $user->hasRole('superadmin');
    }

    public function restore(User $user, GateWay $gateway)
    {
        return $user->hasRole('superadmin');
    }

    public function forceDelete(User $user, GateWay $gateway)
    {
        return $user->hasRole('superadmin');
    }
}
