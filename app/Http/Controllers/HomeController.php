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
        // Get three posts
        $posts = Image::limit(3)
            ->orderBy('id', 'desc')
            ->skip(($page - 1) * 3)
            ->get();

        // Redirect if there is not any posts
        if (!$posts || empty($posts) || !isset($posts) || count($posts) < 1) {
            return redirect()->action([HomeController::class, 'index']);
        }

        // Redirect if there is not any posts in the next page
        $this_is_the_last_page = false;
        if (count($posts) < 3) {
            $this_is_the_last_page = true;
        }

        if (!$this_is_the_last_page) {

            $posts_before_last = Image::limit(1)
                ->where('id', '<', $posts[2]->id)
                ->get();

            if (!$posts_before_last || empty($posts_before_last) || !isset($posts_before_last) || count($posts_before_last) < 1) {
                $this_is_the_last_page = true;
            }
        }

        // Return view
        return view('home.index', [
            'posts' => $posts,
            'page' => $page,
            'this_is_the_last_page' => $this_is_the_last_page
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
