<?php

namespace App\Policies;

use App\Models\User;
use App\Models\CategorieModel;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoriePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasAnyRole(['superadmin', 'admin', 'superviseur', 'agent']);
    }

    public function view(User $user, CategorieModel $categorie)
    {
        return $user->hasAnyRole(['superadmin', 'admin', 'superviseur', 'agent']);
    }

    public function create(User $user)
    {
        return $user->hasAnyRole(['superadmin', 'admin']);
    }

    public function update(User $user, CategorieModel $categorie)
    {
        return $user->hasAnyRole(['superadmin', 'admin']);
    }

    public function delete(User $user, CategorieModel $categorie)
    {
        return $user->hasRole('superadmin');
    }

    public function restore(User $user, CategorieModel $categorie)
    {
        return $user->hasRole('superadmin');
    }

    public function forceDelete(User $user, CategorieModel $categorie)
    {
        return $user->hasRole('superadmin');
    }
}
