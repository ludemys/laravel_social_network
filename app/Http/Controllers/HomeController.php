<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $logged_user = isset($_SESSION['user']) ? $_SESSION['user'] : false;
        // return json_encode($_SESSION['user']);

        // return json_encode($user);
        return view('home.index', ['logged_user' => $logged_user]);
    }

    public function login()
    {
        return view('home.login');
    }
    public function verificate(Request $request)
    {
        $request->validate([
            'email' => 'required|max:255',
            'password' => 'required|min:8'
        ]);

        $users = new User();


        if ($user = DB::table('users')->where('email', '=', $request->email)->first()) {
            // return json_encode($user);
            if (Hash::check($request->password, $user->password)) {
                // Login passed
                Config::get('session_start');
                $_SESSION['user'] = $user;

                return Redirect::action([HomeController::class, 'index']);
            }
        }

        // Login failed

        return redirect()->route('home.login');
    }
}
