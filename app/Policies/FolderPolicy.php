<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Folder;
use Illuminate\Auth\Access\Response;

class FolderPolicy
{
    public function update(User $user, Folder $folder) {
        return $user->id === $folder->user_id
            ? Response::allow() 
            : Response::deny("Vous n'êtes pas authorisé à effectuer cette action.");
    }

}
