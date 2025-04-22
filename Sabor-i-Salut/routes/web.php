<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
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

// Rutes per a nutricionistes (protegides pel rol "nutricionista")
Route::middleware(['auth', 'role:nutricionista'])->group(function () {
    Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');
    Route::post('/menus', [MenuController::class, 'store'])->name('menus.store');
    Route::post('/menus/{menu}/assign', [MenuController::class, 'assignMenu'])->name('menus.assign');
});

// Ruta per als clients (només es pot veure el menú)
Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::middleware('guest')->group(function () {
    // Registre
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    // Login
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // Recordatori de contrasenya
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
});

Route::middleware('auth')->group(function () {
    // Pàgines accessibles només per usuaris autenticats
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});


Route::middleware('guest')->group(function () {
    // Ruta per mostrar el formulari de restabliment de contrasenya
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    
    // Ruta per enviar el correu de restabliment
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
});
Route::post('register', [RegisteredUserController::class, 'store']);

Route::middleware(['auth', 'role:nutricionista'])->group(function () {
    Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');
    Route::get('/menus/create', [MenuController::class, 'create'])->name('menus.create');
    Route::post('/menus', [MenuController::class, 'store'])->name('menus.store');
    Route::get('/menus/{menu}/edit', [MenuController::class, 'edit'])->name('menus.edit');
    Route::post('/menus/{menu}/assign', [MenuController::class, 'assignMenu'])->name('menus.assign');
    Route::delete('/menus/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');
});



Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// Ruta per al Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

// Rutes per al control de menús
Route::resource('menus', MenuController::class);

// routes/web.php


Route::post('/menus/{menu}/send', [MenuController::class, 'sendMenu'])->name('menus.send');



Route::middleware('auth')->group(function () {
    Route::resource('menus', MenuController::class);
    // o afegir una ruta per l'index manualment:
    Route::get('menus', [MenuController::class, 'index'])->name('menus.index');
});



