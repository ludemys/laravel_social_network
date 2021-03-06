<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('Login_auth')->except(['create', 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = new User();
        $users = $user->all();

        return view('users.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'nickname' => 'required|unique:App\Models\User,nickname|max:50',
            'email' => 'required|unique:App\Models\User,email|max:255',
            'image_path' => 'required|file|image|max:5120',
            'password' => 'required|min:8'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->nickname = $request->nickname;
        $user->email = $request->email;
        $user->image = HelperController::store_image($request->file('image_path'), 'users');
        $user->password = Hash::make($request->password);
        $user->isAdmin = false;

        $user->save();

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = DB::table('users')->where('id', '=', $id)
            ->first();

        if (session()->has('user') && session()->get('user')->id == $id) {
            return view('users.profile', [
                'user' => $user,
                'logged_in' => true
            ]);
        }


        return view('users.profile', [
            'user' => $user,
            'logged_in' => false
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('users.edit', [
            'logged_user' => session()->get('user')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'nickname' => 'nullable|max:50|regex:*[a-zA-Z0-9+]*',
            'name' => 'nullable|max:255|regex:*[a-zA-Z+]*',
            'email' => 'nullable|email:rfc,dns,filter',
            'new_password' => 'nullable|min:8',
            'new_password_confirm' => 'required_with:new_password|same:new_password',
            'image_path' => 'nullable|file|image|max:5120',
            'password' => 'required|min:8|',
            'password_confirm' => 'required|same:password|min:8'
        ]);


        $old_user = DB::table('users')
            ->where('id', '=', $id)
            ->first();

        if (!Hash::check($request->input('password'), $old_user->password)) {
            return redirect()->action([UserController::class, 'edit'], ['user' => $id])->with('password_incorrect', 'Password incorrect');
        }

        // Get & set register in database
        $user = User::find($id);

        $user->nickname = $request->filled('nickname') ? $request->input('nickname') : $old_user->nickname;
        $user->name = $request->filled('name') ? $request->input('name') : $old_user->name;
        $user->email = $request->filled('email') ? $request->input('email') : $old_user->email;
        $user->password = $request->filled('new_password') ? Hash::make($request->input('new_password')) : $old_user->password;
        $user->image = $request->file('image_path') !== null ? HelperController::store_image('users', $request->file('image_path')) : $old_user->image;
        $user->isAdmin = $old_user->isAdmin;

        $user->save();

        // Update session
        $user_row = DB::table('users')
            ->where('id', '=', $id)
            ->first();
        $request->session()->put('user', $user_row);

        return redirect()
            ->action([UserController::class, 'show'], ['user' => $id])
            ->with('success', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
