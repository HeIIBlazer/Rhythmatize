<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumGenre extends Model
{
    use HasFactory;
    
    protected $table = 'album_genres';

    public $timestamps = false;
    
    protected $fillable = [
        'album_id',
        'genre_id',
    ];
}