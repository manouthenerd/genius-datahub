<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('/services', [ServiceController::class, 'index']);
Route::get('/tasks', [TaskController::class, 'index']);
Route::get('/resources', [ResourceController::class, 'index']);

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
