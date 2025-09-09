<?php

use App\Http\Controllers\ProjectController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ResourceController;
use App\Models\Service;
use Illuminate\Http\Request;

Route::put('/test', function(Request $request) {
    return dd($request->all());
});

Route::middleware(["auth"])->group(function () {

    Route::get('/', function () {})->name('home');
    Route::redirect('/', '/dashboard');

    Route::get('tasks',     [TaskController::class, 'index']);
    Route::get('resources', [ResourceController::class, 'index']);

    Route::post('users', [UserController::class, 'store'])->name('users.create');
    Route::post('users/add', [UserController::class, 'addUser'])->name('users.add');
    Route::get('users/{id}', [UserController::class, 'show'])->name('users.edit');
    Route::put('users', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('services',  [ServiceController::class, 'index']);
    Route::get('services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::post('services', [ServiceController::class, 'store'])->name('services.store');
    Route::put('services/{service}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');

    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.create');
    Route::post('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
});

Route::get('dashboard', function () {
    $services = Service::all(['id', 'name', 'updated_at']);

    return Inertia::render('Dashboard', ['services' => $services]);
})->middleware(["auth", "verified"])->name('dashboard');


require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/resources.php';
