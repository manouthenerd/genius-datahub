<?php

namespace App\Policies;

use App\Models\Archive;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ArchivePolicy
{

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Archive $archive): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Archive $archive): Response
    {
        return $user->id === $archive->user_id 
            ? Response::allow() 
            : Response::deny("Vous n'êtes pas authorisé à effectuer cette action.");
        
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Archive $archive): Response
    {
        return $user->id === $archive->user_id 
            ? Response::allow() 
            : Response::deny("Vous n'êtes pas authorisé à effectuer cette action.");
    }

}
