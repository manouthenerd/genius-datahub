<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;
use Inertia\Inertia;

class ServiceController extends Controller
{
    public function index() {
        return Inertia::render('Service', [
            'users' => User::withBasicInfo()->withServiceName()->get(),
            'services' => Service::withName()->get()
        ]);
    }

   
}
