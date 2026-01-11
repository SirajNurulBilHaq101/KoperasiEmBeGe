<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Main\StokController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\KatalogController;
use App\Http\Controllers\MasterData\ItemController;
use App\Http\Controllers\Transaksi\PesananController;
use App\Http\Controllers\MasterData\CategoryController;
use App\Http\Controllers\MasterData\KaryawanController;
use App\Http\Controllers\Main\GrafikTransaksiController;

/*
|--------------------------------------------------------------------------
| GUEST ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/sign-in', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/sign-in', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'registerForm']);
    Route::post('/register', [AuthController::class, 'register']);
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | ADMIN ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->group(function () {

        // Main
        Route::get('/stok-barang', [StokController::class, 'index'])
            ->name('stok-barang.index');

        Route::get('/grafik-transaksi', [GrafikTransaksiController::class, 'index'])
            ->name('grafik-transaksi.index');

        // Master Data
        Route::get('/data-barang', [ItemController::class, 'index'])
            ->name('data-barang.index');
        Route::post('/data-barang', [ItemController::class, 'store'])
            ->name('data-barang.store');
        Route::delete('/data-barang/{item}', [ItemController::class, 'destroy'])
            ->name('data-barang.destroy');

        Route::get('/kategori-barang', [CategoryController::class, 'index'])
            ->name('kategori-barang.index');
        Route::post('/kategori', [CategoryController::class, 'store'])
            ->name('kategori.store');
        Route::delete('/kategori/{category}', [CategoryController::class, 'destroy'])
            ->name('kategori.destroy');

        Route::get('/data-karyawan', [KaryawanController::class, 'index'])
            ->name('data-karyawan.index');
        Route::post('/data-karyawan', [KaryawanController::class, 'store'])
            ->name('data-karyawan.store');
        Route::delete('/data-karyawan/{user}', [KaryawanController::class, 'destroy'])
            ->name('data-karyawan.destroy');

        Route::get('/transaksi/pesanan', [PesananController::class, 'index'])
            ->name('transaksi.pesanan.index');

        Route::get('/transaksi/pesanan/{order}', [PesananController::class, 'show'])
            ->name('transaksi.pesanan.show');

        Route::patch('/transaksi/pesanan/{order}/status', [PesananController::class, 'updateStatus'])
            ->name('transaksi.pesanan.update-status');
    });

    /*
    |--------------------------------------------------------------------------
    | USER ROUTES
    |--------------------------------------------------------------------------
    */
    Route::prefix('user')->name('user.')->middleware('role:user')->group(function () {

        Route::get('/katalog', [KatalogController::class, 'index'])
            ->name('katalog.index');

        Route::get('/keranjang', [CartController::class, 'index'])
            ->name('keranjang.index');
        Route::post('/keranjang', [CartController::class, 'store'])
            ->name('keranjang.store');
        Route::delete('/keranjang/{id}', [CartController::class, 'destroy'])
            ->name('keranjang.destroy');

        Route::get('/pesanan', [OrderController::class, 'index'])
            ->name('pesanan.index');
        Route::post('/pesanan/checkout', [OrderController::class, 'checkout'])
            ->name('pesanan.checkout');
    });

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
