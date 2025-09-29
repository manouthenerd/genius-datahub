<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateFolderRequest;
use App\Models\Folder;
use Illuminate\Http\Request;

// #[UsePolicy(FolderPolicy::class)]
class FolderController extends Controller
{

    public function store(Request $request)
    {

        $service_id = (int) $request->query('service');
        
        $validated = $request->validate(['name' => 'required|string|max:100']);

        $user = request()->user();

        Folder::create([
            'user_id' => $user->id,
            'service_id' => $user->hasRole('admin') ? $service_id : $user->service_id,
            'name' => $validated['name']
        ]);

        return redirect()->back();

    }

    public function update(UpdateFolderRequest $request, Folder $folder)
    {

        $request->user()->can('update', $folder);

        $folder->name = $request->input('name');

        $folder->save();

        return redirect()->back();

    }

    public function destroy(Folder $folder, Request $request) {
        if(! $folder->user_id == $request->user()->id) {
            return abort('403');
        }

        $folder->delete();

        return redirect()->back();
    }
}
