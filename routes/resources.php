<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminResourcesController;

Route::get('services/{service}', [AdminResourcesController::class, 'folders'])->name('resources.folders');
Route::get('services/{service}/folders/{folder}', [AdminResourcesController::class, 'files'])->name('resources.files');