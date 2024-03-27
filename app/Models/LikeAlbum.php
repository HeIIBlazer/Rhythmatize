<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeAlbum extends Model
{
    use HasFactory;

    protected $table = 'like_albums';

    protected $fillable = [
        'user_id',
        'album_id',
    ];
}
