<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{

    public function index()
    {
        $logged_user = session()->has('user') ? session()->get('user') : false;

        return view('home.index', ['logged_user' => $logged_user]);
    }

    public function login()
    {
        return view('home.login');
    }
    public function verificate(Request $request)
    {
        $request->validate([
            'email' => 'required|max:255|email:rfc,dns',
            'password' => 'required|min:8'
        ]);


        if ($user = DB::table('users')->where('email', '=', $request->email)->first()) {

            if (Hash::check($request->password, $user->password)) {

                // Login passed
                Config::get('session_start');
                $request->session()->put('user', $user);

                return Redirect::action([HomeController::class, 'index']);
            }

            return redirect()->action([HomeController::class, 'login'])->with('password_incorrect', 'Password incorrect');
            // return redirect('/');
        } else {
            return redirect()->action([HomeController::class, 'login'])->with('email_unfound', "There's not any account with this email");
        }

        // Login failed
        return redirect()->action([HomeController::class, 'login']);
    }

    public function logout(Request $request)
    {
        if ($request->session()->has('user')) $request->session()->forget('user');

        return redirect()->action([HomeController::class, 'login']);
    }
}
