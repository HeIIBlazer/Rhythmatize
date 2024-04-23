<?php

namespace App\Http\Controllers;

use App\Models\Artist;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Track;
use App\Models\Album;
use App\Models\CommentAlbum;
use App\Models\CommentTrack;
use App\Models\CommentArtist;
use App\Models\LikeAlbum;
use App\Models\LikeArtist;
use App\Models\LikeTrack;
use Illuminate\Support\Facades\Crypt;



class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = null;
        $artists = DB::table("artists")->orderBy('name', 'asc')->paginate(12);
        return view('artist_views.artistsList', compact('artists', 'user'));
    }

    public function charts() 
    {
        $artists = DB::table("artists")->select('artists.*', DB::raw('count(like_artists.id) as likes_count'))
                        ->leftJoin('like_artists', 'artist_id', '=', 'artists.id')
                        ->groupBy('artists.id', 'artists.name', 'artists.picture_url', 'artists.banner_url', 'artists.description', 'artists.youtube_link', 'artists.spotify_link', 'artists.apple_music_link')
                        ->orderBy('likes_count', 'desc')
                        ->paginate(10);

        return view('artist_views.artistsChart', compact('artists'));
    }

    public function top_3_artists()
    {
    $artists = Artist::select('artists.*', DB::raw('count(like_artists.id) as likes_count'))
                    ->leftJoin('like_artists', 'artists.id', '=', 'like_artists.artist_id')
                    ->groupBy('artists.id', 'artists.name', 'artists.picture_url', 'artists.banner_url', 'artists.description', 'artists.youtube_link', 'artists.spotify_link', 'artists.apple_music_link')
                    ->orderBy('likes_count', 'desc')
                    ->limit(3)
                    ->get();
    return view('main', compact('artists'));
    }
    
    public function last_added()
    {
        $artists = DB::table("artists")->orderBy('id', 'desc')->paginate(12);
        return view('artist_views.lastAddedArtists', compact('artists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('artists.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'picture_url' => 'required',
            'banner_url' => 'required',
            'description' => 'required',
            'youtube_link' => 'required',
            'spotify_link' => 'required',
            'apple_music_link' => 'required',
        ]);

        Artist::create($request->all());
        return redirect()->route('artists.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Artist $artist)
    {
        $comments = DB::table('comment_artists')->where('artist_id', $artist->id)->get();
        return view('artists.show', compact('artist', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artist $artist)
    {
        return view('artists.edit', compact('artist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artist $artist)
    {
        $request->validate([
            'name' => 'required',
            'picture_url' => 'required',
            'banner_url' => 'required',
            'description' => 'required',
            'youtube_link' => 'required',
            'spotify_link' => 'required',
            'apple_music_link' => 'required',
        ]);

        $artist->update($request->all());

        return redirect()->route('artists.index');
    }



    public function show_artist ($crypt_artist)
    {
        $cryptId = Crypt::decrypt($crypt_artist);

        $artist = Artist::find($cryptId);

        $comments = DB::table('comment_artists')->where('artist_id', $artist->id)->get();

        $albums = DB::table('albums')->where('artist_id', $artist->id)
                    ->select('albums.*', DB::raw('count(like_albums.id) as likes_count'))
                    ->leftJoin('like_albums', 'albums.id', '=', 'like_albums.album_id')
                    ->groupBy('albums.id', 'albums.name', 'albums.cover_url', 'albums.release_date', 'albums.artist_id', 'albums.description', 'albums.youtube_link', 'albums.spotify_link', 'albums.apple_music_link', 'albums.type', 'albums.genre_id')
                    ->orderBy('likes_count', 'desc')
                    ->limit(3)
                    ->get();
                    
        $tracks = DB::table('tracks as t')
                    ->select('t.*', DB::raw('count(lt.id) as likes_count'))
                    ->leftJoin('like_tracks as lt', 't.id', '=', 'lt.track_id')
                    ->whereIn('t.album_id', function ($query) use ($artist) {
                        $query->select('albums.id')
                            ->from('albums')
                            ->where('albums.artist_id', $artist->id);
                    })
                    ->groupBy('t.id', 't.name', 't.time', 't.youtube_link', 't.spotify_link', 't.apple_music_link', 't.album_id', 't.lyrics', 't.explicit')
                    ->orderBy('likes_count', 'desc')
                    ->limit(4)
                    ->get(); 

        return view('artist_views.artistInfo', compact('artist','tracks', 'comments', 'albums',));
    }

    /**
     * Deletes artist, comments and likes
     */
    public function delete_artist($crypt_artist, $user)
    {
            $artist_id = Crypt::decrypt($crypt_artist);

            $albums = DB::table('albums')->where('artist_id', $artist_id)->get();

            if ($albums->count() != 0) {
                foreach ($albums as $album) {

                    $tracks = DB::table('tracks')->where('album_id', $album->id)->get();
                    if ($tracks->count() != 0) {
                        foreach ($tracks as $track) {
                            $comments = DB::table('comment_tracks')->where('track_id', $track->id)->get();
                            if ($comments->count() != 0) {
                                foreach ($comments as $comment) {
                                    $comment_delete = CommentTrack::find($comment->id)->delete;
                                }
                            }

                            $likes = DB::table('like_tracks')->where('track_id', $track->id)->get();
                            if ($likes->count() != 0) {
                                foreach ($likes as $like) {
                                    $like_delete = LikeTrack::find($like->id)->delete();
                                }
                            }

                            $track_delete = Track::find($track->id)->delete();
                        }
                    }

                    $comments = DB::table('comment_albums')->where('album_id', $album->id)->get();
                    foreach ($comments as $comment) {
                        $comment_delete = CommentAlbum::find($comment->id)->delete();
                    }

                    $likes = DB::table('like_albums')->where('album_id', $album->id)->get();
                    foreach ($likes as $like) {
                        $like_delete = LikeAlbum::find($like->id)->delete();
                    }

                    $album_delete = Album::find($album->id)->delete();
                }
            }

            $comments = DB::table('comment_artists')->where('artist_id', $artist_id)->get();
            foreach ($comments as $comment) {
                $comment_delete = CommentArtist::find($comment->id)->delete();
            }

            $likes = DB::table('like_artists')->where('artist_id', $artist_id)->get();
            foreach ($likes as $like) {
                $like_delete = LikeArtist::find($like->id)->delete();
            }

            $artist = Artist::find($artist_id);

            $artist->delete();

            return redirect()->back();
    }
}


