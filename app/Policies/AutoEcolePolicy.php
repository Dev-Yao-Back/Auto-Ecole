<?php

namespace App\Policies;

use App\Models\User;
use App\Models\AutoEcole;
use Illuminate\Auth\Access\HandlesAuthorization;


class AutoEcolePolicy
{
    use HandlesAuthorization;
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function viewAny(User $user)
    {
        // Autorise l'utilisateur à voir la liste des auto-écoles
        return $user->hasAnyRole(['superadmin', 'admin']);
    }

    /**
     * Determine whether the user can view the auto école.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AutoEcole  $autoEcole
     * @return mixed
     */
    public function view(User $user, AutoEcole $autoEcole)
    {
        // Autorise l'utilisateur à voir une auto-école spécifique
        return $user->hasAnyRole(['superadmin', 'admin']);
    }

    /**
     * Determine whether the user can create auto écoles.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        // Autorise la création d'auto-écoles uniquement pour les administrateurs
        return $user->hasAnyRole(['superadmin', 'admin']);
    }

    /**
     * Determine whether the user can update the auto école.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AutoEcole  $autoEcole
     * @return mixed
     */
    public function update(User $user, AutoEcole $autoEcole)
    {
        // Autorise la mise à jour d'une auto-école si l'utilisateur est l'administrateur de cette auto-école
        return $user->hasAnyRole(['superadmin', 'admin']);
    }

    /**
     * Determine whether the user can delete the auto école.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AutoEcole  $autoEcole
     * @return mixed
     */
    public function delete(User $user, AutoEcole $autoEcole)
    {
        // Autorise la suppression d'une auto-école uniquement pour les administrateurs
        return $user->hasAnyRole(['superadmin', 'admin']);
    }

    /**
     * Determine whether the user can restore the auto école.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AutoEcole  $autoEcole
     * @return mixed
     */
    public function restore(User $user, AutoEcole $autoEcole)
    {
        // Autorise la restauration d'une auto-école uniquement pour les administrateurs
        return $user->hasAnyRole(['superadmin', 'admin']);
    }

    /**
     * Determine whether the user can permanently delete the auto école.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AutoEcole  $autoEcole
     * @return mixed
     */
    public function forceDelete(User $user, AutoEcole $autoEcole)
    {
        // Autorise la suppression permanente d'une auto-école uniquement pour les administrateurs
        return $user->hasAnyRole(['superadmin', 'admin']);
    }

}