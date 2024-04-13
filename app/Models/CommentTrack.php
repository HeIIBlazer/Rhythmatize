<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentTrack extends Model
{
    use HasFactory;

    protected $table = 'comment_tracks';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'track_id',
        'content',
    ];
}
