<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CategorieModel;
use App\Models\Subvention;
use App\Models\Source;
use App\Models\Piece;




class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      $this->call(CommuneSeeder::class);
      $this->call(AutoEcoleSeeder::class);
      $this->call(RolePermissionSeeder::class);
      $this->call(UsersTableSeeder::class);
      $this->call(StatutSeeder::class);
      $this->call(PieceSeeder::class);
      $this->call(CategorieSeeder::class);
      $this->call(SubventionSeeder::class);
      $this->call(SourceSeeder::class);

 }

}