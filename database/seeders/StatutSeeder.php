<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Statut;

class StatutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $statut = new Statut();
        $statut->lib_statut = "En attente";
        $statut->type_statut = "En attente";
        $statut->save();

        $statut = new Statut();
        $statut->lib_statut = "En cours";
        $statut->type_statut = "En cours";
        $statut->save();

        $statut = new Statut();
        $statut->lib_statut = "Validé";
        $statut->type_statut = "Validé";
        $statut->save();

        $statut = new Statut();
        $statut->lib_statut = "Refusé";
        $statut->type_statut = "Refusé";
        $statut->save();
    }
}