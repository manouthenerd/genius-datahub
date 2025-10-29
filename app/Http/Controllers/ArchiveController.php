<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ArchiveController extends Controller
{
    /**
     * Stocke un ou plusieurs fichiers dans la table archives.
     */


    public function store(Request $request)
    {
        $userId = $request->user()->id;

        $folderId = (int) $request->folder_id;

        $path = $request->file('file')->store('uploads', 'public');

        $data = [
            'name' => $request->file('file')->getClientOriginalName(),
            'size' => round($request->file('file')->getSize() / 1048576, 2), // Mo
            'path' => $path,
            'user_id' => $userId,
            'folder_id' => $folderId,
            'created_at' => now(),
            'updated_at' => now(),
        ];


        Archive::create($data);

        return redirect()->back()->with('success', 'Fichiers téléversés avec succès.');
    }

    /**
     * Met à jour le nom ou le dossier d’un fichier existant.
     */
    public function update(Request $request, Archive $archive)
    {
        Gate::authorize('update', $archive);

        $request->validate([
            'name' => 'required|string|max:255',
            'folder_id' => 'nullable|exists:folders,id',
        ]);

        $archive->name = $request->name;

        if ($request->filled('folder_id')) {
            $archive->folder_id = $request->folder_id;
        }

        $archive->save();

    }

    /**
     * Supprime un fichier à la fois de la base et du storage.
     */
    public function destroy(Archive $archive)
    {

        Gate::authorize('destroy', $archive);

        // Supprimer le fichier du storage
        if (Storage::disk('public')->exists($archive->path)) {
            Storage::disk('public')->delete($archive->path);
        }

        // Supprimer l’enregistrement de la base
        $archive->delete();

        return back()->with('success', 'Fichier supprimé avec succès.');
    }
}
