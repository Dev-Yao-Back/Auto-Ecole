<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      // Créer les rôles et permissions
        $roleSuperAdmin = Role::create(['name' => 'superadmin']);

        /*
        $permissions = [
            'manage users',
            'manage roles',
            'manage permissions',
            // Ajoutez d'autres permissions nécessaires ici
        ];

       foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
*/
        $roleSuperAdmin->givePermissionTo(Permission::all());

        // Créer l'utilisateur Superadmin
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => bcrypt('password'), // Changez le mot de passe ici
        ]);

        // Assigner le rôle Superadmin à l'utilisateur
        $user->assignRole($roleSuperAdmin);
    }
}
