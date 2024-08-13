<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AutoEcole;

class AutoEcoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

      $autoEcole = new AutoEcole();
      $autoEcole->name = 'Centre de Auto-École';
      $autoEcole->address = '123 rue de la mairie';
      $autoEcole->phone = '0612345678';
      $autoEcole->email = 'centre@example.com';
      $autoEcole->logo = '';
      $autoEcole->description = 'Centre de formation';
      $autoEcole->commune = 1;
      $autoEcole->save();

    }
}