<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\AdminResourcesController;

Route::get('services/{service}', [AdminResourcesController::class, 'folders'])->name('resources.folders');
Route::get('services/{service}/folders/{folder}', [AdminResourcesController::class, 'files'])->name('resources.files');

Route::post('archives', [ArchiveController::class, 'store'])->name('files.store');
Route::put('archives/{archive}', [ArchiveController::class, 'update'])->name('files.update');
Route::delete('archives/{archive}', [ArchiveController::class, 'destroy'])->name('files.destroy');

Route::post('folders', [FolderController::class, 'store'])->name('folders.store');
Route::put('folders/{folder}', [FolderController::class, 'update'])->name('folders.update');
Route::delete('folders/{folder}', [FolderController::class, 'destroy'])->name('folders.destroy');