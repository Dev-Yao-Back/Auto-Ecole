<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Str;




class InscriptionController extends Controller
{
    //

    public function index(){
      $pageConfigs = ['myLayout' => 'blank'];
      return view('index', ['pageConfigs' => $pageConfigs]);
    }


    public function store(Request $request){
      $valid_data = $request->validate([
        'username' => 'required',
        'email' => 'required',
        'phone' => 'required',
      ]);



      $user = new UserModel;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->generateUniqueLink();
        $user->save();


      //creation du liens et enregistrement dans partage


    }





}
