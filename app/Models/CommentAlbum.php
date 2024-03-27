<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentAlbum extends Model
{
    use HasFactory;
    protected $table = 'comment_albums';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'album_id',
        'content',
    ];

}
