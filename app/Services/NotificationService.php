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
    public static function fetchUsersToNotify(int $serviceId, User $user)
    {
        $service = Service::find($serviceId, ['id', 'name']);

        if (!$service) {
            return ['service_name' => null, 'service_users' => collect()];
        }

        $service_name = $service->name;

        // Récupérer les utilisateurs du service associé
        $service_users = $service->users()->pluck('id')->toArray();

        // Si l'utilisateur est modérateur, on retire son ID et ajoute l'admin
        if ($user->role === 'moderator') {
            // Retirer le modérateur lui-même
            $service_users = array_diff($service_users, [$user->id]);

            // Ajouter l'admin (si trouvé)
            $admin = User::where('role', 'admin')->first();

            if ($admin) {
                $service_users[] = $admin->id;
            }
        }

        return [
            'service_name' => $service_name,
            'service_users' => array_values($service_users), // réindexation propre
        ];
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
    ) {

        $message = $user->role == 'admin' ? "$admin_message <i>$service_name</i>."
            : "Le modérateur du service <i>$service_name</i> $moderator_message.";

        return $message;
    }
}
