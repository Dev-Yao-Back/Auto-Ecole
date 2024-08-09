<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperviseurController extends Controller
{
    //

    public function showSuperviseur()
    {

        $pageConfigs = ['myLayout' => 'without-menu', 'myStyle' => 'light',
      ];
        return view('superviseur.dashboard', compact('pageConfigs'));
    }
}