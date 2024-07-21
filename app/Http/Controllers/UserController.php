<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function useLink($unique_link)
    {

        $user = UserModels::where('unique_link', $unique_link)->firstOrFail();

        $user->increment('referral_count');

        //return view('users.unique_link_page', ['user' => $user]);

    }
}
