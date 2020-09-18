<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes([
    'login'    => true,
    'logout'   => true,
    'register' => false,
    'reset'    => true,   // for resetting passwords
    'confirm'  => false,  // for additional password confirmations
    'verify'   => false,  // for email verification
]);


//Auth::routes(['register' => false]);

Route::get('/', [Controllers\HomeController::class, 'index'])->name('home');
Route::match(['get', 'post'], '/vacancy', [Controllers\RoomController::class, 'show'])->name('vacancy');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::post('/reservation/create', [Controllers\ReservationController::class, 'create']);
Route::redirect('/home', '/');
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
