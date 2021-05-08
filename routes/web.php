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

Route::prefix('/home')->group(function () {
    Route::get('/', [HomeController::class, 'index'])
        ->name('home.index');
    Route::get('/login', [HomeController::class, 'login'])
        ->name('home.login');
    Route::post('/verificate', [HomeController::class, 'verificate'])
        ->name('home.verificate');
});

Route::get('/', function () {
    // $image = new Image();

    // $images = $image->all();

    // echo '<ol>';
    // foreach ($images as $i) {
    //     // echo "<li>" . $i->user->name . ' | ' . $i->user->email . ' | ' . $i->user->created_at . "</li>";
    //     echo "<li>$i->path | " . count($i->likes) . " likes.<ul>";

    //     foreach ($i->comments as $j) {
    //         echo "<li>" . $j->user->name . ": $j->content.</li>";
    //     }

    //     echo '</ul> </li><hr/>';
    // }
    // echo '</ol>';

    return redirect()->route('home.index');
});


Route::resource('/users', UserController::class);
