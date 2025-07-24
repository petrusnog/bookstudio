<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

//Route::get('/debug', [StudioController::class, 'debug']);

// ROTAS ABERTAS
Route::middleware(['guest'])->group(function () {
    // Login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login',  [AuthController::class, 'login'])->name('login.attempt');
});

// ROTAS PROTEGIDAS
Route::middleware(['auth'])->group(function () {
    // Geral

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Usuários

    // CREATE
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/create', [UserController::class, 'store'])->name('users.create');

    // READ
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    // UPDATE
    Route::get('/users/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

    // DELETE
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');


    // Estúdios

    // CREATE
    Route::get('/studios/create', [StudioController::class, 'create'])->name('studios.create');
    Route::post('/studios/store', [StudioController::class, 'store'])->name('studios.store');

    // // READ
    Route::get('/studios', [StudioController::class, 'index'])->name('studios.index');

    // // UPDATE
    Route::get('/studios/{id}', [StudioController::class, 'edit'])->name('studios.edit');
    Route::put('/studios/{id}', [StudioController::class, 'update'])->name('studios.update');

    // // DELETE
    Route::delete('/studios/{id}', [StudioController::class, 'destroy'])->name('studios.destroy');
});