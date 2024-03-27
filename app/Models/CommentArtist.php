<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentArtist extends Model
{
    use HasFactory;

    protected $table = 'comment_artists';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'artist_id',
        'content',
    ];
}
