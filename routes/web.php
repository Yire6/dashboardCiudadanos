<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CitizenController;
use App\Http\Controllers\EstadisticasController;


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


Route::get('/estadisticas', [EstadisticasController::class,'index'])
         ->name('estadisticas');

// Route::get('/cities', [CityController::class, 'index'])->name('cities.index');
// Route::get('/cities/create', [CityController::class, 'create'])->name('cities.create');
// Route::post('/cities', [CityController::class, 'store'])->name('cities.store');
// Route::get('/cities/{id}', [CityController::class, 'show'])->name('cities.show');
// Route::get('/cities/{id}/edit', [CityController::class, 'edit'])->name('cities.edit');
// Route::put('/cities/{id}', [CityController::class, 'update'])->name('cities.update');
// Route::delete('/cities/{id}', [CityController::class, 'destroy'])->name('cities.destroy');

route::middleware(['auth'])->group(function () {
    Route::resource('cities', CityController::class);
    Route::resource(('citizens'), CitizenController::class);
});

Route::post('/toggle-darkmode', function () {
    $darkMode = session('dark_mode', false);
    session(['dark_mode' => !$darkMode]);
    return back();
})->name('toggle.darkmode');



require __DIR__.'/auth.php';
