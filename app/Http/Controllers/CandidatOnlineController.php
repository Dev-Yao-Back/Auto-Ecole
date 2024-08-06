<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CandidatOnline;
use App\Models\Piece;
use App\Models\Subvention;
use App\Models\Source;
use App\Models\CategorieModel;
use App\Models\Commune;

class CandidatOnlineController extends Controller
{


    public function index()
    {
      $pageConfigs = ['myLayout' => 'blank', 'myStyle' => 'dark',
    ];


        return view('candidat.online', compact('pageConfigs'));
    }

    public function congrat(){

      $pageConfigs = ['myLayout' => 'blank', 'myStyle' => 'dark',

      ];

        return view('candidat.congrat', compact('pageConfigs'));
    }

    public function payement(){

      $motant = session()->get('reste');
      $paymentUrl = "https://pay.wave.com/m/M_CivAV8HL-7pF/c/ci/?amount={$motant}";
      return redirect($paymentUrl)->with('success', 'Paiement traité avec succès ! Redirection vers la passerelle de paiement.');
    }

}
