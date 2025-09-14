<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $fillable = ['name'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Fetch folders associated to the Service
     *
     * @return HasMany
     */
    public function folders(): HasMany
    {
        return $this->hasMany(Folder::class);
    }

    public function moderator()
    {
        return $this->belongsTo(User::class, 'moderator_id');
    }

    public function scopeWithName($query)
    {
        return $query->select('id', 'name', 'created_at');
    }

    public static function withModerator()
    {

        $services = self::withName()->get();

        $services = $services->map(function ($item) {


            $moderator = $item->users()->where('role', 'moderator')->first(['id', 'name', 'role']);
            $item['moderator'] = $moderator ?? 'Non défini';
            $item['counts'] = $item->users()->count();

            return $item;
        });

        return $services;
    }
}
