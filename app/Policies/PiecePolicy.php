<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Piece;
use Illuminate\Auth\Access\HandlesAuthorization;

class PiecePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasAnyRole(['superadmin', 'admin']);
    }

    public function view(User $user, Piece $piece)
    {
        return $user->hasAnyRole(['superadmin', 'admin']);
    }

    public function create(User $user)
    {
        return $user->hasAnyRole(['superadmin', 'admin']);
    }

    public function update(User $user, Piece $piece)
    {
        return $user->hasAnyRole(['superadmin', 'admin']);
    }

    public function delete(User $user, Piece $piece)
    {
        return $user->hasRole('superadmin', 'admin');
    }

    public function restore(User $user, Piece $piece)
    {
        return $user->hasRole('superadmin');
    }

    public function forceDelete(User $user, Piece $piece)
    {
        return $user->hasRole('superadmin');
    }
}
