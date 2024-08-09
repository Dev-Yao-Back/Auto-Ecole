<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Candidat;
use Illuminate\Auth\Access\HandlesAuthorization;

class CandidatPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasAnyRole(['superadmin', 'admin', 'superviseur', 'agent']);
    }

    public function view(User $user, Candidat $candidat)
    {
        return $user->hasAnyRole(['superadmin', 'admin', 'agent']);
    }

    public function create(User $user)
    {
      return $user->hasAnyRole(['superadmin', 'admin',  'agent']);
    }

    public function update(User $user, Candidat $candidat)
    {
        return $user->hasAnyRole(['superadmin', 'admin']);
    }

    public function delete(User $user, Candidat $candidat)
    {
        return $user->hasRole('superadmin');
    }

    public function restore(User $user, Candidat $candidat)
    {
        return $user->hasRole('superadmin');
    }

    public function forceDelete(User $user, Candidat $candidat)
    {
        return $user->hasRole('superadmin');
    }
}