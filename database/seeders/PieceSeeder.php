<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Piece;

class PieceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

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