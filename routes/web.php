<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\MenuController;
use App\Http\Controllers\Auth\PagoController;
use App\Http\Controllers\Auth\EmpleadoController;
use App\Http\Controllers\Auth\ClienteController;
use Illuminate\Support\Facades\Route;

// Redirect root to login
Route::get('/', fn() => redirect()->route('login'));

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login',[LoginController::class,'login'])->name('login.post');
Route::post('/logout',[LoginController::class,'logout'])->name('logout');

// Authenticated
Route::middleware('auth')->group(function () {
    Route::get('/menu',[MenuController::class,'index'])->name('menu');
    Route::get('/dashboard', fn() => view('inicio'))->name('dashboard');

    // Clientes (resource completo)
    Route::resource('clientes', ClienteController::class);

    // Pagos
    // — index lo defines manualmente para poder personalizar el método y la URL
    Route::get('pago', [PagoController::class,'index'])->name('pago.index');
Route::resource('pago', PagoController::class)->except(['index']);

    // Empleados (igual que pagos, si solo ocutlas index)
    Route::get('empleados', [EmpleadoController::class, 'index'])->name('empleados.index');
    Route::resource('empleados', EmpleadoController::class)
         ->except(['index']);
});
