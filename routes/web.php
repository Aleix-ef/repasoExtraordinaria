<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipController;
use App\Http\Controllers\EstadiController;
use App\Http\Controllers\JugadoresController;
use App\Http\Controllers\PartitsController;
use App\Http\Middleware\RoleMiddleware;

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

require __DIR__.'/auth.php';

Route::middleware(['auth', RoleMiddleware::class.':administrador' ])->group(function (){
    Route::resource('/equips', EquipController::class)->except(['index', 'show']);
    Route::resource('/estadis', EstadiController::class)->except(['index', 'show']);
});
Route::resource('/equips', EquipController::class)->only(['index', 'show']);
Route::resource('/estadis', EstadiController::class)->only(['index', 'show']);

Route::resource('/equips', EquipController::class);

Route::resource('/estadis', EstadiController::class);

Route::resource('/jugadors', JugadoresController::class);

Route::resource('/partits', PartitsController::class);

Route::get('/historic', [PartitsController::class, 'historic'])->name('partits.historic');
