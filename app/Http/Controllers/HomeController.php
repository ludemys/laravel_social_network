<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{

    public function index($page = 1)
    {
        $posts = Image::limit(3)
            ->orderBy('id', 'desc')
            ->skip(($page - 1) * 5)
            ->limit(5)
            ->get();

        if (!$posts || empty($posts) || !isset($posts) || count($posts) < 1) {
            return redirect()->action([HomeController::class, 'index']);
        }

        return view('home.index', [
            'posts' => $posts
        ]);
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
