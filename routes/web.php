<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\MenuController;
use App\Http\Controllers\Auth\ClienteController;
use App\Http\Controllers\Auth\PagoController;
use App\Http\Controllers\Auth\EmpleadoController;
use Illuminate\Support\Facades\Route;


// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/menu', [MenuController::class, 'index'])->name('menu'); // Usando el controlador
    Route::get('/dashboard', function () {

        return view('inicio'); // Esta ruta se queda igual
    })->name('dashboard');
    
     Route::resource('clientes', ClienteController::class)
         ->only(['index','create','store','show','edit','update','destroy']);
    Route::resource('pago',     PagoController::class)
         ->only(['index','create','store','show','edit','update','destroy']);
    Route::resource('empleados',EmpleadoController::class)
         ->only(['index','create','store','show','edit','update','destroy']);
});

