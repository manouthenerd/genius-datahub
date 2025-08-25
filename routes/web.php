<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TaskController;
use App\Http\Middleware\EnsureIsAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::middleware([EnsureIsAuth::class])->group(function () {

    Route::get('/', function () {})->name('home');
    Route::redirect('/', '/dashboard');

    Route::get('services', [ServiceController::class, 'index']);
    Route::get('tasks', [TaskController::class, 'index']);
    Route::get('resources', [ResourceController::class, 'index']);
});

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware([EnsureIsAuth::class])->name('dashboard');


require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
