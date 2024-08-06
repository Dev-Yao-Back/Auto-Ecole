<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Commune;

class CommuneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $communes = [
        'Abobo', 'Adjamé', 'Attécoubé', 'Cocody', 'Koumassi', 'Marcory',
        'Plateau', 'Port-Bouët', 'Treichville', 'Yopougon', 'Bingerville',
        'Dabou', 'Grand-Bassam', 'Anyama', 'Songon', 'San-Pédro', 'Bouaké',
        'Yamoussoukro', 'Man', 'Daloa', 'Korhogo', 'Gagnoa'
    ];

    foreach ($communes as $commune) {
        Commune::create(['nom_commune' => $commune]);
    }    }
}