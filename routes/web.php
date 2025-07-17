<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

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
    Route::get('/admin/users', [UserController::class, 'index'])->name('users.list');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/admin/users/create', [UserController::class, 'store'])->name('users.create');
    Route::get('/admin/users/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('users.update');
});