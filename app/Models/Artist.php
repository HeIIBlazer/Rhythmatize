<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;
    
    protected $table = 'artists';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'picture_url',
        'banner_url',
        'description',
        'youtube_link',
        'spotify_link',
        'apple_link_link',
    ];
}