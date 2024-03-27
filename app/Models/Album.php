<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;
    
    protected $table = 'albums';
    public $timestamps = true;
    
    protected $fillable = [
        'name',
        'cover_image_ur;',
        'release_date',
        'youtube_link',
        'spotify_link',
        'apple_music_link',
        'type',
        'artist_id',
    ];
}