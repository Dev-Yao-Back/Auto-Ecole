<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonationModel;
use App\Models\ClickModel;
use App\Models\TouchModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class DonationController extends Controller
{
    public function index()
    {
        $pageConfigs = ['myLayout' => 'blank'];
        try {
            TouchModel::create();
            ClickModel::create();
            $totalDonations = DonationModel::sum('amount');
            $donors = DonationModel::count();
            $totalClicks = ClickModel::count();
            $totaltouchs = TouchModel::count();
        } catch (\Exception $e) {
            Log::error('Erreur lors du chargement des données de l\'index : ' . $e->getMessage());
            return view('dons.mvc', compact('pageConfigs'))->withErrors('Une erreur est survenue lors du chargement des données.');
        }

        return view('dons.mvc', compact('totalDonations', 'donors', 'totalClicks', 'totaltouchs', 'pageConfigs'));
    }

    public function processDonation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'email' => 'nullable|string|email|max:255',
            'amount' => 'nullable|numeric|min:1',
            'montant' => 'nullable|numeric|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            ClickModel::create();

            $montant = $request->input('montant') > $request->input('amount') ? $request->input('montant') : $request->input('amount');

            // Utiliser des valeurs anonymes si les informations ne sont pas fournies
            $donationData = [
                'name' => $request->has('name') && !empty($request->input('name')) ? $request->input('name') : 'Anonyme',
                'phone' => $request->has('phone') && !empty($request->input('phone')) ? $request->input('phone') : '0000000000',
                'email' => $request->has('email') && !empty($request->input('email')) ? $request->input('email') : 'anonymous@example.com',
                'amount' => $montant,
            ];
            $donation = DonationModel::create($donationData);
        } catch (\Exception $e) {
            Log::error('Erreur lors du traitement du don : ' . $e->getMessage());
            return redirect()->back()->withErrors('Une erreur est survenue lors du traitement de votre don. Veuillez réessayer.')->withInput();
        }

        // Redirigez vers la passerelle de paiement Wave
        $paymentUrl = "https://pay.wave.com/m/M_CivAV8HL-7pF/c/ci/?amount={$montant}";

        return redirect($paymentUrl)->with('success', 'Don traité avec succès ! Redirection vers la passerelle de paiement.');
    }
}
