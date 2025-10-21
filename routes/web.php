<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['check.maqom:1'])->group(function () {
    Route::get('/rector', [DashboardController::class, 'rector'])->name('maqom.rector');
});

Route::middleware(['check.maqom:2'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'admin'])->name('maqom.admin');
});

Route::middleware(['check.maqom:3'])->group(function () {
    Route::get('/muallim', [DashboardController::class, 'muallim'])->name('maqom.muallim');
});

Route::middleware(['check.maqom:4'])->group(function () {
    Route::get('/donishju', [DashboardController::class, 'donishju'])->name('maqom.donishju');
});

Route::get('/online-users', [DashboardController::class, 'getOnlineUsers'])->name('online.users');

Route::middleware(['check.maqom:1,2'])->group(function () {
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');       // Foydalanuvchilar ro‘yxati
    Route::get('/users/create', [UsersController::class, 'create'])->name('users.create'); // Qo‘shish sahifasi
    Route::post('/users', [UsersController::class, 'store'])->name('users.store');      // Foydalanuvchi qo‘shish
    Route::get('/users/{user}/edit', [UsersController::class, 'edit'])->name('users.edit'); // Tahrirlash sahifasi
    Route::put('/users/{user}', [UsersController::class, 'update'])->name('users.update'); // Foydalanuvchini yangilash
    Route::delete('/users/{user}', [UsersController::class, 'destroy'])->name('users.destroy'); // O‘chirish
});



Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

