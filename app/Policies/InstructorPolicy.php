<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Instructor;
use Illuminate\Auth\Access\HandlesAuthorization;

class InstructorPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasAnyRole(['superadmin', 'admin', 'superviseur', 'agent']);
    }

    public function view(User $user, Instructor $instructor)
    {
        return $user->hasAnyRole(['superadmin', 'admin', 'superviseur', 'agent']);
    }

    public function create(User $user)
    {
        return $user->hasAnyRole(['superadmin', 'admin', 'superviseur']);
    }

    public function update(User $user, Instructor $instructor)
    {
        return $user->hasAnyRole(['superadmin', 'admin']);
    }

    public function delete(User $user, Instructor $instructor)
    {
        return $user->hasRole('superadmin');
    }

    public function restore(User $user, Instructor $instructor)
    {
        return $user->hasRole('superadmin');
    }

    public function forceDelete(User $user, Instructor $instructor)
    {
        return $user->hasRole('superadmin');
    }
}
