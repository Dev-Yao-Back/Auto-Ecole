<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Créer les rôles s'ils n'existent pas déjà
        $roles = [
            'superadmin',
            'admin',
            'superviseur',
            'agent',
            'commerciaux',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Créer les utilisateurs et assigner les rôles
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@example.com',
                'password' => bcrypt('password'),
                'role' => 'superadmin',
            ],
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'Superviseur User',
                'email' => 'superviseur@example.com',
                'password' => bcrypt('password'),
                'role' => 'superviseur',
            ],
            [
                'name' => 'Agent User',
                'email' => 'agent@example.com',
                'password' => bcrypt('password'),
                'role' => 'agent',
            ],
            [
                'name' => 'Commerciaux User',
                'email' => 'commerciaux@example.com',
                'password' => bcrypt('password'),
                'role' => 'commerciaux',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => $userData['password'],
            ]);
            $user->assignRole($userData['role']);
        }
    }
}
