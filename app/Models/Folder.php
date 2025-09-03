<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Folder extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Return archives associated to the Folder
     *
     * @return HasMany
     */
    public function archives(): HasMany {
        return $this->hasMany(Archive::class);
    }
}
