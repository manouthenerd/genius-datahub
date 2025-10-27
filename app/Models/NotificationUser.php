<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationUser extends Model
{
    protected $table = "notification_user";

    protected $casts = ['is_read' => 'boolean', 'is_deleted' => 'boolean'];
}