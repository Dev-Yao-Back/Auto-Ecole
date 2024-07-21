<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use App\Models\Piece;
use App\Models\Source;
use App\Models\Subvention;
use App\Models\CategorieModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CandidatController extends Controller
{
    //
    public function feetch()
    {
      $pageConfigs = ['myLayout' => 'blank', 'myStyle' => 'dark',
    ];

        $sources = Source::all();
        $pieces = Piece::all();

        $subventions = Subvention::all();

        //nombre de candidat total
        $count = Candidat::count();

        $categories = CategorieModel::all();



        return view('dons.validate', compact('categories', 'sources',  'subventions', 'count', 'pageConfigs','pieces'));

    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'piece_id' => 'required|piece:exists,id',
            'source_id' => 'required|source:exists,id',
            'subvention_id' => 'required|subvention:exists,id',
            'matricule' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'tel_number1' => 'required',
            'tel_number2' => 'required',
            'tel_number3' => 'required',
            'date_birth' => 'required',
            'name_dad' => 'required',
            'name_moon' => 'required',
            'amount' => 'required',
            'status' => 'required',
            'piece_rec' => 'required|file|mimes:jpeg,png,pdf,doc,docx|max:2048',
            'piece_vec' => 'required|file|mimes:jpeg,png,pdf,doc,docx|max:2048',
            '_number_piece' => 'required',
            'categorie_permis' => 'required',
            'moyen_payement' => 'required',
            'montant' => 'required'
        ]);

        //creation du matricule
        $timestamp = now()->format('YmdHis'); // Format YYYYMMDDHHMMSS

        $randomString = strtoupper(Str::random(5)); // Chaîne aléatoire de 5 caractères

        $matricule = $timestamp . $randomString;

        $data['matricule'] = $matricule;

        //pour le stockage des fichier
        $data['piece_rec'] = $request->file('piece_rec')->store('pieces', 'public');

        $data['piece_vec'] = $request->file('piece_vec')->store('pieces', 'public');

        //insertion dans la table
        Candidat::create($data);

        return redirect()->route('inscription');
    }
}
