<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Archive extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'size',
        'path',
        'user_id',
        'folder_id',
    ];

    /**
     * Les relations
     */
    
    // L’archive appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // L’archive appartient à un dossier
    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }
}
