<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\Service;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminResourcesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function folders(int $service)
    {

        // Récupérer le service
        $service = Service::where('id', $service)->firstOr(function() {
            return [];
        });

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



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
