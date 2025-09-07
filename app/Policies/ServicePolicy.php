<?php

namespace App\Policies;

use App\Models\Service;
use App\Models\User;

class ServicePolicy
{
    /**
     * Create a new policy instance.
     */
    public function create(User $user)
    {
        return $user->role == 'admin';
    }

    public function action(User $user) {
        return $user->role == 'admin';
    }

    public function view(User $user, Service $service) {
        return $user->service_id == $service->id || $user->role == 'admin';
    }
}
