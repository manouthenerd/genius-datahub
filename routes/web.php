<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ResourceController;


Route::middleware(["auth"])->group(function () {

    Route::get('/', function () {})->name('home');
    Route::redirect('/', '/dashboard');

    Route::get('services',  [ServiceController::class, 'index']);
    Route::get('tasks',     [TaskController::class, 'index']);
    Route::get('resources', [ResourceController::class, 'index']);

    Route::post('users', [UserController::class, 'store'])->name('users.create');
    Route::get('users/{id}', [UserController::class, 'show'])->name('users.edit');
    Route::put('users', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::post('services', [ServiceController::class, 'store'])->name('services.create');
    Route::put('services', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');
});

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(["auth", "verified"])->name('dashboard');


require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/resources.php';
