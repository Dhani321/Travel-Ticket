<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    notify()->success('Welcome to Laravel Notify ⚡️');
    return view('auth.login');
});
// Auth routes
// Auth routes
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Armada routes
    Route::get('armadas', [AdminController::class, 'indexArmadas'])->name('armadas.index');
    Route::get('armadas/create', [AdminController::class, 'createArmada'])->name('armadas.create');
    Route::post('armadas', [AdminController::class, 'storeArmada'])->name('armadas.store');
    Route::get('armadas/{armada}/edit', [AdminController::class, 'editArmada'])->name('armadas.edit');
    Route::put('armadas/{armada}', [AdminController::class, 'updateArmada'])->name('armadas.update');
    Route::delete('armadas/{armada}', [AdminController::class, 'destroyArmada'])->name('armadas.destroy');

    // Route routes
    Route::get('routes', [AdminController::class, 'indexRoutes'])->name('routes.index');
    Route::get('routes/create', [AdminController::class, 'createRoute'])->name('routes.create');
    Route::post('routes', [AdminController::class, 'storeRoute'])->name('routes.store');
    Route::get('routes/{route}/edit', [AdminController::class, 'editRoute'])->name('routes.edit');
    Route::put('routes/{route}', [AdminController::class, 'updateRoute'])->name('routes.update');
    Route::delete('routes/{route}', [AdminController::class, 'destroyRoute'])->name('routes.destroy');

    // Schedule routes
    Route::get('schedules', [AdminController::class, 'indexSchedules'])->name('schedules.index');
    Route::get('schedules/create', [AdminController::class, 'createSchedule'])->name('schedules.create');
    Route::post('schedules', [AdminController::class, 'storeSchedule'])->name('schedules.store');
    Route::get('schedules/{schedule}/edit', [AdminController::class, 'editSchedule'])->name('schedules.edit');
    Route::put('schedules/{schedule}', [AdminController::class, 'updateSchedule'])->name('schedules.update');
    Route::delete('schedules/{schedule}', [AdminController::class, 'destroySchedule'])->name('schedules.destroy');

    // Payment routes
    Route::get('payments', [AdminController::class, 'payments'])->name('payments');
    Route::post('payments/{payment}/verify', [AdminController::class, 'verifyPayment'])->name('payments.verify');


    Route::get('schedules/{schedule}/passengers', [AdminController::class, 'viewPassengers'])->name('schedules.passengers');
});

// Customer routes
Route::middleware(['auth', 'customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
    Route::get('schedules', [CustomerController::class, 'schedules'])->name('schedules');
    Route::get('history', [CustomerController::class, 'history'])->name('history');
    Route::post('payments', [CustomerController::class, 'storePayment'])->name('payments.store');
});
