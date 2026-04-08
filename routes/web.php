<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\StudentAuthenticate;
use Illuminate\Support\Facades\Route;

// ─── Guest Routes ───────────────────────────────────────────────────────────
Route::middleware('guest:student')->group(function () {
    Route::get('/',        [AuthController::class, 'showLogin'])->name('home');
    Route::get('/login',   [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',  [AuthController::class, 'login'])->name('login.post');
    Route::get('/register',  [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// ─── Authenticated Routes ───────────────────────────────────────────────────
Route::middleware(StudentAuthenticate::class)->group(function () {
    Route::get('/dashboard',                  [ProfileController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile',                    [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile',                    [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/change-password',    [ProfileController::class, 'changePassword'])->name('profile.password');
    Route::post('/logout',                    [AuthController::class, 'logout'])->name('logout');
});