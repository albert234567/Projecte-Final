<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// 🔒 Rutes protegides per autenticació
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard (carregat des del controlador)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Menús per a nutricionistes
    Route::middleware('role:nutricionista')->group(function () {
        Route::get('/menus/create', [MenuController::class, 'create'])->name('menus.create');
        Route::post('/menus', [MenuController::class, 'store'])->name('menus.store');
        Route::get('/menus/{menu}/edit', [MenuController::class, 'edit'])->name('menus.edit');
        Route::post('/menus/{menu}/assign', [MenuController::class, 'assignMenu'])->name('menus.assign');
        Route::delete('/menus/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');
    });

    // Menús per a clients (només index)
    Route::middleware('role:client')->group(function () {
        Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');
    });

    // Ruta per enviar menú (pot ser comuna a nutricionistes o restringida si cal)
    Route::post('/menus/{menu}/send', [MenuController::class, 'sendMenu'])->name('menus.send');
});

// 🧾 Rutes per a usuaris no autenticats (guest)
Route::middleware('guest')->group(function () {
    // Registre
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    // Login
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // Recuperació de contrasenya
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
});

// 🔓 Logout
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
