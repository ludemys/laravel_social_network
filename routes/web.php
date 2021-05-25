<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
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
    return redirect()->action([HomeController::class, 'index']);
})
    ->middleware('Login_auth');

// Route::redirect('/', 'home.login');

Route::prefix('/home')->group(function () {

    Route::middleware('Login_auth')->group(function () {
        Route::get('/', [HomeController::class, 'index'])
            ->name('home.index');
        Route::get('/profile', [HomeController::class, 'profile'])
            ->name('home.profile');
        Route::get('/logout', [HomeController::class, 'logout'])
            ->name('home.logout');
    });

    Route::get('/login', [HomeController::class, 'login'])
        ->name('home.login');
    Route::post('/verificate', [HomeController::class, 'verificate'])
        ->name('home.verificate');
});


Route::get('/users/avatar/{filename}', [UserController::class, 'get_avatar'])
    ->name('users.avatar')
    ->middleware('Login_auth');

Route::resource('/users', UserController::class);

Route::prefix('/image')->group(function () {
    Route::get('/upload', [ImageController::class, 'create'])
        ->name('image.create');
    Route::post('/store', [ImageController::class, 'store'])
        ->name('image.store');
});
