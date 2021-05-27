<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HelperController;
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

    Route::get('/login', [HomeController::class, 'login'])
        ->name('home.login');
    Route::post('/verificate', [HomeController::class, 'verificate'])
        ->name('home.verificate');

    Route::middleware('Login_auth')->group(function () {
        Route::get('/profile', [HomeController::class, 'profile'])
            ->name('home.profile');
        Route::get('/logout', [HomeController::class, 'logout'])
            ->name('home.logout');
        Route::get('/{page?}', [HomeController::class, 'index'])
            ->name('home.index');
    });
});


Route::get('/imagesget//{filename?}/{disk}', [HelperController::class, 'get_image'])
    ->name('image.get')
    ->middleware('Login_auth');

Route::resource('/users', UserController::class);

Route::middleware('Login_auth')->prefix('/image')->group(function () {
    Route::get('/upload', [ImageController::class, 'create'])
        ->name('image.create');
    Route::post('/store', [ImageController::class, 'store'])
        ->name('image.store');
    Route::get('/like_toggle/{post}/{current_page}', [ImageController::class, 'like_toggle'])
        ->name('image.like_toggle');
});

Route::middleware('Login_auth')->prefix('/comment')->group(function () {
    Route::post('/create/{post}/{current_page}', [CommentController::class, 'create'])
        ->name('comment.create');
});
