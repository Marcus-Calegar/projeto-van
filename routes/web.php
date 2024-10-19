<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MotoristaController;
use App\Http\Controllers\ResponsavelController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/register/motorista', [MotoristaController::class, 'create'])->name('register.motorista');
Route::post('/register/motorista', [MotoristaController::class, 'store']);

Route::get('/register/responsavel', [ResponsavelController::class, 'create'])->name('register.responsavel');
Route::post('/register/responsavel', [ResponsavelController::class, 'store']);

Route::get('/mapa', function () {
    return view('mapa.index');
})->name('mapa');

require __DIR__ . '/auth.php';
