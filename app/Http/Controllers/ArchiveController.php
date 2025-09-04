<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateArchiveRequest;
use App\Models\Archive;
use Illuminate\Support\Facades\Gate;

class ArchiveController extends Controller
{
    public function update(UpdateArchiveRequest $request, Archive $archive) 
    {

        Gate::authorize('update', $archive);

        $archive->name = $request->validated('name');

        $archive->save();

        return redirect()->back();
    }

    public function destroy(Archive $archive) {
        Gate::authorize('delete', $archive);

        $deleted = $archive->delete();
    }
}
