<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserFormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{


    public function store(UserFormRequest $request)
    {
        // Récupérer le service associé à la requête
        $service = Service::find((int) $request->service, ['id', 'name']);

        // Récupérer le modérateur du service s'il existe
        $moderator_exists = DB::table('users')
            ->where('service_id', '=', $service->id)
            ->where('role', '=', 'moderator')
            ->first(['id', 'name', 'email']);

        // Vérifier si le role de la requête match avec l'existence du modérateur
        if ($moderator_exists && $request->role == "moderator") {
            return redirect()->back()->withErrors([
                'role' => "Le {$service->name} contient déjà un modérateur"
            ]);
        }

        User::create([
            'service_id' => (int) $request->service,
            'name'       => $request->name,
            'email'      => $request->email,
            'role'       => $request->role,
            'password'   => Hash::make("password")
        ]);
    }
    
    public function addUser(AddUserRequest $request)
    {

        // Récupérer le service associé à la requête
        $service = Service::find((int) $request->service)->first(['id', 'name']);

        dd($service);

        // Récupérer le modérateur du service s'il existe
        $moderator_exists = DB::table('users')
            ->where('service_id', '=', $service->id)
            ->where('role', '=', 'moderator')
            ->first(['id', 'name', 'email']);

        // Vérifier si le role de la requête match avec l'existence du modérateur
        if ($moderator_exists && $request->role == "moderator") {
            return redirect()->back()->withErrors([
                'role' => "Le {$service->name} contient déjà un modérateur"
            ]);
        }

        User::create([
            'service_id' => (int) $request->service,
            'name'       => $request->name,
            'email'      => $request->email,
            'role'       => $request->role,
            'password'   => Hash::make("password")
        ]);
    }

    public function show(int $id)
    {

        $user = User::findOrFail($id, ['id', 'name', 'email', 'role', 'service_id']);

        return Inertia::render('EditUser', [
            'user' => $user,
            'services' => Service::withName()->get()
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name'      => ['string', 'required', 'min:3'],
            'email'     => ['string', 'email', 'required'],
            'role'      => ['string', 'required', Rule::in(['moderator', 'member'])],
            'service'   => ['required', 'exists:services,id'],
        ]);

        //    TODO Change service current moderator if role == 'moderator'

        $user = User::find($request->user_id);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];
        $user->service_id = $validated['service'];

        $user->save();
    }

    public function destroy(int $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->back();
    }
}
