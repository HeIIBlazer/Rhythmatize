<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeArtist extends Model
{
    use HasFactory;
    
    protected $table = 'like_artists';

    protected $fillable = [
        'user_id',
        'artist_id',
    ];
}
