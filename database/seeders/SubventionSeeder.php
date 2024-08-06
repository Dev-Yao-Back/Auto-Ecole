<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subvention;

class SubventionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //


      $subvention = new Subvention();
      $subvention->lib_subvention = "25 000 FCFA";
      $subvention->type_subvention = 25000;
      $subvention->save();

      $subvention = new Subvention();
      $subvention->lib_subvention = "30 000 FCFA";
      $subvention->type_subvention = 30000;
      $subvention->save();

      $subvention = new Subvention();
      $subvention->lib_subvention = "100 % PEC";
      $subvention->type_subvention = 180000;
      $subvention->save();

      $subvention = new Subvention();
      $subvention->lib_subvention = "Prix Normal";
      $subvention->type_subvention = 0;
      $subvention->save();

      $subvention = new Subvention();
      $subvention->lib_subvention = "Remplacement";
      $subvention->type_subvention = 180000;
      $subvention->save();


    }
}
