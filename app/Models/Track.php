<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    protected $table = 'tracks';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'time',
        'spotify_link',
        'youtube_link',
        'apple_music_link',
        'lyrics',
        'explicit',
        'album_id',
    ];
}
