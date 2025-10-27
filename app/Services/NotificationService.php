<?php

namespace App\Services;

use App\Models\User;
use App\Models\Service;

class NotificationService
{

    /**
     * Récupère les utilisateurs du service qui
     * recevront les notifications du à un event
     *
     * @param integer $serviceId
     * @param User $user
     * @return array
     */
    public static function fetchUsersToNotify(
        int $serviceId, 
        User $user
    )
    {

        $service = Service::find($serviceId, ['id', 'name']);

        $service_name = $service->name;

        // Récuperer les users du Service associé à la Tâche créée
        $service_users = $service->users()->pluck('id');

        // Retirer l'initiateur de la requête de ceux qui recevront la notification
        if ($user->role == "moderator") {
            $service_users = $service->users()->whereNot('id', '=', $user()->id)->pluck('id');

            $service_users[] = User::where('role', '=', 'admin')->first()->id;
        }

        return ['service_name' => $service_name, 'service_users' => $service_users];
    }

    /**
     * Permet de définir le message qui sera associé
     * à la notification en fonction du type de user
     * qui a déclenché l'event (Moderateur | Admin)
     *
     * @param User $user
     * @param string $service_name
     * @param string $admin_message
     * @param string $moderator_message
     * @return string
     */
    public static function setNotificationMessage(
        User $user, 
        string $service_name, 
        string $admin_message,
        string $moderator_message
    )
    {

        $message = $user->role == 'admin' ? "$admin_message <i>$service_name</i>."
            : "Le modérateur du service <i>$service_name</i> $moderator_message.";

        return $message;
    }
}
