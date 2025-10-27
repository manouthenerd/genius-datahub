<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {

        $user = $request->user();

        $services = Service::all(['id', 'name', 'updated_at']);
            
        return Inertia::render('Dashboard', [
            'services' => $services,
            'service' => $user->service
        ]);
    }
}
