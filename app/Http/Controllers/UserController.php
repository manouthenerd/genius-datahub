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
        // Validation des données
        $validated = $request->validate([
            'name'      => ['string', 'required', 'min:3'],
            'email'     => ['string', 'email', 'required'],
            'role'      => ['string', 'required', Rule::in(['moderator', 'member'])],
            'service'   => ['required', 'exists:services,id'],
        ]);

        // Démarre la transaction pour s'assurer que tout se passe de manière atomique
        DB::transaction(function () use ($validated, $request) {
            // Récupère l'utilisateur à mettre à jour
            $user = User::find($request->user_id);

            // Si l'utilisateur souhaite devenir modérateur
            if ($validated['role'] === 'moderator') {
                // Cherche l'actuel modérateur dans le service choisi
                $currentModerator = User::where('service_id', $validated['service'])
                    ->where('role', 'moderator')
                    ->first();

                // Si un autre modérateur existe déjà dans ce service, on échange les rôles
                if ($currentModerator) {
                    // Change le rôle de l'actuel modérateur en 'member'
                    $currentModerator->role = 'member';
                    $currentModerator->save();
                }
            }

            // Si l'utilisateur est déjà modérateur et souhaite devenir membre
            if ($user->role === 'moderator' && $validated['role'] === 'member') {
                // Cherche un autre utilisateur dans le même service pour lui attribuer le rôle de modérateur
                $newModerator = User::where('service_id', $validated['service'])
                    ->where('role', 'member')
                    ->first();

                if ($newModerator) {
                    // Attribue le rôle de modérateur à un autre utilisateur dans ce service
                    $newModerator->role = 'moderator';
                    $newModerator->save();
                }
            }

            // Mise à jour de l'utilisateur actuel
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->role = $validated['role'];
            $user->service_id = $validated['service'];

            // Sauvegarde des changements
            $user->save();
        });

        // Optionnel : rediriger ou retourner une réponse
        return redirect()->route('services.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function destroy(int $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->back();
    }
}
