<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeTrack extends Model
{
    use HasFactory;

    protected $table = 'like_tracks';

    protected $fillable = [
        'user_id',
        'track_id',
    ];
}
