<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Notification extends Model
{
    /** @use HasFactory<\Database\Factories\NotificationFactory> */
    use HasFactory;

    protected $fillable = ['service_id','title', 'content'];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function users(): BelongsToMany {
        return $this->belongsToMany(User::class);
    }
}
