<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    //

    public function showReceipt(Request $request)
    {
      $data = $request->all(); // Récupère tous les paramètres de requête
      return view('receipt',  $data);
}

}
