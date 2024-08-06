<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Source;

class SourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
      $source->save();    }
}