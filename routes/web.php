<?php

use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'pelanggan'], function() {
    Route::get('/', [PelangganController::class, 'index']);
    Route::post('/data', [PelangganController::class, 'data']);
    Route::get('/create', [PelangganController::class, 'create']);
    Route::post('/create', [PelangganController::class, 'store']);
    Route::get('/{id}', [PelangganController::class, 'show']);
    Route::get('/{id}/edit', [PelangganController::class, 'edit']);
    Route::put('/{id}/update', [PelangganController::class, 'update']);
    Route::get('/{id}/delete', [PelangganController::class, 'confirm']);
    Route::delete('/{id}/delete', [PelangganController::class, 'delete']);
});

Route::group(['prefix' => 'produk'], function() {
    Route::get('/', [ProdukController::class, 'index']);
    Route::post('/data', [ProdukController::class, 'data']);
    Route::get('/create', [ProdukController::class, 'create']);
    Route::post('/create', [ProdukController::class, 'store']);
    Route::get('/{id}', [ProdukController::class, 'show']);
    Route::get('/{id}/edit', [ProdukController::class, 'edit']);
    Route::put('/{id}/update', [ProdukController::class, 'update']);
    Route::get('/{id}/delete', [ProdukController::class, 'confirm']);
    Route::delete('/{id}/delete', [ProdukController::class, 'delete']);
});

Route::group(['prefix' => 'transaksi'], function() {
    Route::get('/', [TransaksiController::class, 'index']);
    Route::post('/data', [TransaksiController::class, 'data']);
    Route::get('/create', [TransaksiController::class, 'create']);
    Route::post('/create', [TransaksiController::class, 'store']);
    Route::get('/{id}', [TransaksiController::class, 'show']);
    Route::get('/{id}/edit', [TransaksiController::class, 'edit']);
    Route::put('/{id}/update', [TransaksiController::class, 'update']);
    Route::get('/{id}/delete', [TransaksiController::class, 'confirm']);
    Route::delete('/{id}/delete', [TransaksiController::class, 'delete']);
});
