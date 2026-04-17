<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| WEB ROUTES (UI ONLY)
|--------------------------------------------------------------------------
*/

//////////////////////////////////////////////////
// 🌐 HALAMAN PUBLIK
//////////////////////////////////////////////////

Route::view('/', 'home');
Route::get('/kontrakan', [KontrakanController::class, 'index']);
Route::view('/kontrakan/detail', 'kontrakan.detail');



//////////////////////////////////////////////////
// 🔐 AUTH
//////////////////////////////////////////////////

use App\Http\Controllers\AuthController;

// FORM
Route::view('/login', 'auth.login');
Route::view('/register', 'auth.register');

// PROSES
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// LOGOUT
Route::get('/logout', [AuthController::class, 'logout']);


//////////////////////////////////////////////////
// 👤 USER (PENYEWA)
//////////////////////////////////////////////////

Route::view('/dashboard', 'home'); // sementara
Route::view('/booking', 'booking.index');
Route::view('/riwayat', 'home'); // sementara


//////////////////////////////////////////////////
// 🧑‍💼 ADMIN
//////////////////////////////////////////////////

Route::prefix('admin')->group(function () {

    Route::view('/dashboard', 'admin.dashboard');

    Route::view('/kontrakan', 'admin.kontrakan.index');

    Route::view('/transaksi', 'admin.transaksi.index');

});