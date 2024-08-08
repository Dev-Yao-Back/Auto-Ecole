<?php

namespace App\Policies;

use App\Models\User;

class CommissionPolicy
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
        return $user->hasRole(['admin', 'superadmin']);
    }

    /**
     * Determine whether the user can view the commission.
     */
    public function view(User $user, Commission $commission)
    {
        // Autoriser si l'utilisateur est admin ou le propriétaire de la commission
        return $user->hasRole('admin') || $user->id === $commission->user_id;
    }

    /**
     * Determine whether the user can create commissions.
     */
    public function create(User $user)
    {
        // Seuls les admins peuvent créer des commissions
        return $user->hasRole('admin', 'superadmin');
    }

    /**
     * Determine whether the user can update the commission.
     */
    public function update(User $user)
    {
        // Autoriser si l'utilisateur est admin ou le propriétaire de la commission
        return $user->hasRole('superadmin');
    }

    /**
     * Determine whether the user can delete the commission.
     */
    public function delete(User $user, Commission $commission)
    {
        // Seuls les admins peuvent supprimer des commissions
        return $user->hasRole('admin', 'superadmin');
    }

    /**
     * Determine whether the user can restore the commission.
     */
    public function restore(User $user, Commission $commission)
    {
        // Optionnel: implémenter selon besoin
        return $user->hasRole('admin', 'superadmin');
    }

    /**
     * Determine whether the user can permanently delete the commission.
     */
    public function forceDelete(User $user, Commission $commission)
    {
        // Optionnel: implémenter selon besoin
        return $user->hasRole('admin', 'superadmin');
    }
}