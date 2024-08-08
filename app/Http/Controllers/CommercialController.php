<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Referral;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Commission;
use Illuminate\Support\Facades\Auth;


class CommercialController extends Controller
{
    //

    public function showRegister()

    {
      $pageConfigs = ['myLayout' => 'without-menu', 'myStyle' => 'light',
    ];
            return view('commercial.register', compact('pageConfigs'));
    }

    public function register(Request $request)
{
    // Valider les données
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
        'referral_code' => 'nullable|string|exists:users,referral_code',
    ]);

    // Créer l'utilisateur
    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'referral_code' => strtoupper(Str::random(10)),
        'referred_by' => User::where('referral_code', $data['referral_code'])->first()->id ?? null,
    ]);

    $user->assignRole('commerciaux');

    // Créer une entrée de parrainage
    if ($data['referral_code']) {
        Referral::create([
            'user_id' => $user->referred_by,
            'referred_id' => $user->id,
        ]);
        // Calculer et attribuer les commissions à chaque niveau
        $this->assignCommissions($user);
    }

    // Connecter l'utilisateur
    Auth::login($user);

    return redirect()->route('dashboard.commercial');
}

protected function assignCommissions(User $user)
{
    $levels = [
        'commercial' => 0.10, // 10%
        'sous_commercial' => 0.05, // 5%
        'demarcheur' => 0.02, // 2%
    ];

    $amount = 1000; // Montant de référence pour la commission

    // Niveau 1: Commercial
    $commercial = $user->referredBy;
    if ($commercial) {
        Commission::create([
            'user_id' => $commercial->id,
            'amount' => $amount * $levels['commercial'],
            'level' => 'Commercial',
        ]);

        // Niveau 2: Sous Commercial
        $sousCommercial = $commercial->referredBy;
        if ($sousCommercial) {
            Commission::create([
                'user_id' => $sousCommercial->id,
                'amount' => $amount * $levels['sous_commercial'],
                'level' => 'Sous Commercial',
            ]);

            // Niveau 3: Demarcheur
            $demarcheur = $sousCommercial->referredBy;
            if ($demarcheur) {
                Commission::create([
                    'user_id' => $demarcheur->id,
                    'amount' => $amount * $levels['demarcheur'],
                    'level' => 'Demarcheur',
                ]);
            }
        }
    }
}

public function showCommercial()
{

  $configData = [ 'style' => 'light',
];    return view('commercial.dashboard', compact('configData'));

}
}