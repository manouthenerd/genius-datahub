<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ResourceController;

Route::middleware(["auth"])->group(function () {

    Route::get('dashboard', DashboardController::class)
        ->middleware(["auth", "verified"])->name('dashboard');


    Route::get('/', function () {})->name('home');
    Route::redirect('/', '/dashboard');

    Route::get('tasks',     [TaskController::class, 'index']);
    Route::get('resources', [ResourceController::class, 'index']);

    Route::post('users', [UserController::class, 'store'])->name('users.create');
    Route::post('users/add', [UserController::class, 'addUser'])->name('users.add');
    Route::get('users/{id}', [UserController::class, 'show'])->name('users.edit');
    Route::put('users', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('services',  [ServiceController::class, 'index'])->name('services.index');
    Route::get('services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::post('services', [ServiceController::class, 'store'])->name('services.store');
    Route::put('services/{service}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');

    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.create');
    Route::post('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

    Route::get('/task-users/{service}', [TaskController::class, 'getUsers'])->name('task-users');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks');
    Route::get('/tasks/{task}', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
});



require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/resources.php';
