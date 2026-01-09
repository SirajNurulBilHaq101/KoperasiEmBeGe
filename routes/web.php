<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MasterData\ItemController;
use App\Http\Controllers\MasterData\CategoryController;

// ROUTE PUBLIK (GUEST)
Route::middleware('guest')->group(function () {

    // Form login
    Route::get('/sign-in', [AuthController::class, 'loginForm'])
        ->name('login');

    // Proses login
    Route::post('/sign-in', [AuthController::class, 'login']);

    // Form register (jika dipakai)
    Route::get('/register', [AuthController::class, 'registerForm']);

    // Proses register
    Route::post('/register', [AuthController::class, 'register']);
});


// ROUTE AUTHENTICATED
Route::middleware('auth')->group(function () {

    // Dashboard tunggal untuk semua role
    Route::get('/', function () {
        return view('dashboard');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    // Master Data (pakai controller)
    // Items
    Route::get('/data-barang', [ItemController::class, 'index'])
        ->name('data-barang.index');
    Route::post('/data-barang', [ItemController::class, 'store'])
        ->name('data-barang.store');
    Route::delete('/data-barang/{item}', [ItemController::class, 'destroy'])
        ->name('data-barang.destroy');



    // Categories
    Route::get('/kategori-barang', [CategoryController::class, 'index'])
        ->name('kategori-barang.index');
    Route::post('/kategori', [CategoryController::class, 'store'])
        ->name('kategori.store');
    Route::delete('/kategori/{category}', [CategoryController::class, 'destroy'])
        ->name('kategori.destroy');


    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);
});


// FALLBACK (OPTIONAL)
Route::fallback(function () {
    abort(404);
});
