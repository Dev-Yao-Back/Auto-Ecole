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


      $source = new Source();
      $source -> name = "Yao";
      $source -> surname = "Emmanuel";
      $source -> tel_number1 = " 07 20 76 36 09";
      $source -> email = "yao@genius.com";
      $source->save();

      $source = new Source();
      $source -> name = "David";
      $source -> surname = "Emmanuel";
      $source -> tel_number1 = " 07 20 76 36 09";
      $source -> email = "yao@genius.com";
      $source->save();

      $source = new Source();
      $source -> name = "Jean";
      $source -> surname = "Emmanuel";
      $source -> tel_number1 = " 07 20 76 36 09";
      $source -> email = "yao@genius.com";
      $source->save();

      $piece = new Piece();
      $piece->type_piece = "CNI";
      $piece->save();

      $piece = new Piece();
      $piece->type_piece = "CMU";
      $piece->save();

      $piece = new Piece();
      $piece->type_piece = "ATTESTATION IDENTITE";
      $piece->save();

      $piece = new Piece();
      $piece->type_piece = "PERMIS DE CONDUIRE";
      $piece->save();

 }

}
