<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home.index');
});

Route::prefix('/home')->group(function () {
    Route::get('/', [HomeController::class, 'index'])
        ->name('home.index');
    Route::get('/login', [HomeController::class, 'login'])
        ->name('home.login');
    Route::get('/profile', [HomeController::class, 'profile'])
        ->name('home.profile')
        ->middleware('Login_auth');

    Route::post('/verificate', [HomeController::class, 'verificate'])
        ->name('home.verificate');
    Route::get('/logout', [HomeController::class, 'logout'])
        ->name('home.logout');
});

// Route::get('/users/change-password', [UserController::class, 'change_password'])
//     ->name('users.change_password');
Route::resource('/users', UserController::class);
