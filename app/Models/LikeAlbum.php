<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeAlbum extends Model
{
    use HasFactory;

    protected $table = 'like_albums';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'album_id',
    ];
}
