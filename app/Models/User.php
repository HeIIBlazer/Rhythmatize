<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

        public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'avatar_url',
        'banner_url',
        'username',
        'email',
        'password',
        'role',
        'description'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function likedArtists()
    {
        return $this->belongsToMany(Artist::class, 'like_artists', 'user_id', 'artist_id');
    }

    public function likedAlbums()
    {
    return $this->belongsToMany(Album::class, 'like_albums', 'user_id', 'album_id');
    }

    public function likedTracks()
    {
    return $this->belongsToMany(Track::class, 'like_tracks', 'user_id', 'track_id');
    } 
}
