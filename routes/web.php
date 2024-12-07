<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api')->group(function () {
    Route::get('/pegawai', [PegawaiController::class, 'listPegawai'])->name('pegawai.list');
    Route::post('/pegawai/add', [PegawaiController::class, 'addPegawai'])->name('pegawai.add');
});
