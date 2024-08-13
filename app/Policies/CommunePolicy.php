<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Commune;

class CommunePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function viewAny(User $user)
    {
        // Autoriser les admins et les gestionnaires à voir toutes les commissions
        return $user->hasAnyRole(['superadmin', 'admin']);
    }

    /**
     * Determine whether the user can view the commission.
     */
    public function view(User $user, Commune $commune)
    {
        // Autoriser si l'utilisateur est admin ou le propriétaire de la commission
        return $user->hasAnyRole(['superadmin', 'admin']);
    }

    /**
     * Determine whether the user can create commissions.
     */
    public function create(User $user)
    {
        // Seuls les admins peuvent créer des commissions
        return $user->hasAnyRole(['superadmin', 'admin']);
    }

    /**
     * Determine whether the user can update the commission.
     */
    public function update(User $user, Commune $commune)
    {
        // Autoriser si l'utilisateur est admin ou le propriétaire de la commission
        return $user->hasAnyRole(['superadmin', 'admin']);
    }

    /**
     * Determine whether the user can delete the commission.
     */
    public function delete(User $user, Commune $commune)
    {
        // Seuls les admins peuvent supprimer des commissions
        return $user->hasAnyRole(['superadmin', 'admin']);
    }

    /**
     * Determine whether the user can restore the commission.
     */
    public function restore(User $user, Commune $commune)
    {
        // Optionnel: implémenter selon besoin
        return $user->hasAnyRole(['superadmin', 'admin']);
    }

    /**
     * Determine whether the user can permanently delete the commission.
     */
    public function forceDelete(User $user, Commune $commune)
    {
        // Optionnel: implémenter selon besoin
        return $user->hasAnyRole(['superadmin', 'admin']);
    }
}