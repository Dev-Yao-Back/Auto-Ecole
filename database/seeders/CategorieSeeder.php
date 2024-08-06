<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CategorieModel;
use App\Models\Subvention;


class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

      $category = new CategorieModel();
      $category->type = "A";
      $category->save();

      $category = new CategorieModel();
      $category->type = "B";
      $category->save();

      $category = new CategorieModel();
      $category->type = "AB";
      $category->save();

      $category = new CategorieModel();
      $category->type = "BCDE";
      $category->save();

      $category = new CategorieModel();
      $category->type = "ABCDE";
      $category->save();

    }
}