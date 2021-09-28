<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $username = $request->username;
        $password = $request->password;

        $getUser = DB::table('users')->where('username', $username)->first();
        if (!$getUser) {
            return redirect('/login')->with('status', 'Maaf username anda salah');
        } else if ($password != $getUser->password) {
            return redirect('/login')->with('status', 'Oops password anda salah');
        } else {
            return redirect('/')->with('success', 'Anda berhasil login')->with('datasession', $request->session()->put([
                'is_login' => 1,
                'username' => $getUser->username,
            ]));
        }
    }
}
