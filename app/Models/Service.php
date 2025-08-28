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

    public function users(): HasMany {
        return $this->hasMany(User::class);
    }

    public function scopeWithName($query) {
        return $query->select('id', 'name', 'created_at');
    }

    public static function withModerator() {

        $services = self::withName()->get();
        
        $services = $services->map(function($item) {

            $moderator = $item->users()->where('role', 'moderator')->first(['id', 'name', 'role']);

            $item['moderator'] = $moderator->name ?? 'Non défini';
            $item['counts'] = $item->users()->count();

            return $item;
        });

        return $services;
    }

}
