<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Collection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function service() {
        return $this->belongsTo(Service::class);
    }

     /**
     * Scope : retourne uniquement les infos de base d'un utilisateur
     */
    public function scopeWithBasicInfo($query)
    {
        return $query->select('id', 'name', 'email', 'role', 'service_id');
    }

    /**
     * Scope : charge le service avec uniquement son nom
     */
    public function scopeWithServiceName($query)
    {
        return $query->with('service:id,name');
    }

}
