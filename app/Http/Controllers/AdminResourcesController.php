<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Folder;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Policies\ServicePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;


class AdminResourcesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
     #[UsePolicy(ServicePolicy::class)]
    public function folders(Service $service)
    {
        Gate::authorize('view', $service);

        $folders = $service->folders()->get(['id', 'name', 'updated_at']);

        return Inertia::render('admin/ServiceFolders', ['folders' => $folders, 'service' => $service]);
    }

    public function files(int $service, int $folder)
    {

        $service = Service::where('id', $service)->firstOr(function(){
            return abort(404);
        });

        // Récupérer le service
        $folders = Folder::where('id', $folder)->firstOr(function() {
            return abort(404);
        });

        $files = $folders->archives()->get(['id', 'name', 'size', 'updated_at']);

        return Inertia::render('admin/ServiceFiles', ['files' => $files, 'service' => $service]);
    }


}
