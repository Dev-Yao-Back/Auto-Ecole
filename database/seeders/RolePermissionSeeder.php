<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Créer les rôles
        $roles = [
            'superadmin',
            'admin',
            'superviseur',
            'agent',
            'commerciaux',
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        // Créer les permissions
        $permissions = [
            'view users',
            'create users',
            'update users',
            'delete users',
            'view orders',
            'create orders',
            'update orders',
            'delete orders',
            // Ajoutez d'autres permissions nécessaires ici...
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assigner les permissions aux rôles
        $roleSuperadmin = Role::findByName('superadmin');
        $roleSuperadmin->givePermissionTo(Permission::all());

        $roleAdmin = Role::findByName('admin');
        $roleAdmin->givePermissionTo([
            'view users',
            'create users',
            'update users',
            'view orders',
            'create orders',
            'update orders',
        ]);

        $roleSuperviseur = Role::findByName('superviseur');
        $roleSuperviseur->givePermissionTo([
            'view users',
            'view orders',
        ]);

        $roleAgent = Role::findByName('agent');
        $roleAgent->givePermissionTo([
            'view orders',
            'create orders',
        ]);

        $roleCommerciaux = Role::findByName('commerciaux');
        $roleCommerciaux->givePermissionTo([
            'view orders',
        ]);
    }
}
