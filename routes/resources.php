<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminResourcesController;

Route::get('/dashboard/ressources/{service}', [AdminResourcesController::class, 'index']);