<?php

namespace App\Policies;

use App\Models\Archive;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ArchivePolicy
{

   

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Archive $archive): Response
    {
        return $user->id === $archive->user_id
            ? Response::allow() 
            : abort(403);
        
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Archive $archive): Response
    {
        return $user->id === $archive->user_id
            ? Response::allow() 
            : abort(403);
    }

}
