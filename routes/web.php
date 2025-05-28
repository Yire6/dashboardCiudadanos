<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CitizenController;
use App\Http\Controllers\EstadisticasController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/estadisticas/report/pdf',
    [EstadisticasController::class,'downloadCitiesPdf'])
    ->middleware(['auth','verified'])
    ->name('estadisticas.report.pdf');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile',   [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',[ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','verified'])->group(function () {
    // Estadísticas
    Route::get('/estadisticas', [EstadisticasController::class, 'index'])
         ->name('estadisticas');
    Route::post('/estadisticas/report', [EstadisticasController::class, 'sendReport'])
         ->name('estadisticas.report');

    // Recursos de Ciudades y Ciudadanos
    Route::resource('cities',   CityController::class);
    Route::resource('citizens', CitizenController::class);
});

Route::post('/toggle-darkmode', function () {
    $darkMode = session('dark_mode', false);
    session(['dark_mode' => ! $darkMode]);
    return back();
})->name('toggle.darkmode');

require __DIR__.'/auth.php';
