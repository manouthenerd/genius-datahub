<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateServiceRequest;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServiceController extends Controller
{
    public function index()
    {

        return Inertia::render('Service', [
            'users' => User::withBasicInfo()->withServiceName()->get(),
            'services' => Service::withModerator(),
        ]);
    }

    public function store(CreateServiceRequest $request)
    {
        Service::create([
            'name' => $request->validated('service_name')
        ]);   
        
        return redirect()->back(201);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            
        ]);

       
    }

    public function destroy(int $id)
    {
        $user = Service::findOrFail($id);

        $user->delete();

        return redirect()->back();
    }
}
