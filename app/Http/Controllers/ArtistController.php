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
     * Shows List of artists.
     */
    public function index()
    {
        $user = null;
        $artists = DB::table("artists")->orderBy('name', 'asc')->paginate(12);
        return view('artist_views.artistsList', compact('artists', 'user'));
    }

    /**
     * Shows Chart of artists.
     */
    public function charts() 
    {
        $artists = DB::table("artists")->select('artists.*', DB::raw('count(like_artists.id) as likes_count'))
                        ->leftJoin('like_artists', 'artist_id', '=', 'artists.id')
                        ->groupBy('artists.id', 'artists.name', 'artists.picture_url', 'artists.banner_url', 'artists.description', 'artists.youtube_link', 'artists.spotify_link', 'artists.apple_music_link')
                        ->orderBy('likes_count', 'desc')
                        ->paginate(10);

        return view('artist_views.artistsChart', compact('artists'));
    }

    /**
     * Shows last added artists.
     */
    public function last_added()
    {
        $artists = DB::table("artists")->orderBy('id', 'desc')->paginate(12);
        return view('artist_views.lastAddedArtists', compact('artists'));
    }

    /**
     * Shows all info about artist.
     */
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
     * Shows add artist form.
     */
    public function add_artist_page ()
    {
        return view('admin_views.artist.addArtist');
    }

    /**
     * Add new artist to database
     */
    public function add_artist(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'picture_url' => 'image',
            'banner_url' => 'image',
            'description' => 'string',
            'youtube_link' => 'required',
            'spotify_link' => 'required',
            'apple_music_link' => 'required|string',
        ]);
    
        $ExistArtist = Artist::where('name', $request->name)->first();

        if ($ExistArtist) {
            return redirect()->back()->with('error', 'Artist already exists');
        }
    
        if ($request->hasFile('picture_url')) {
            $file = $request->file('picture_url');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/artist_images'), $filename);
            $picture_url = 'images/artist_images/' . $filename;
        } else {
            $picture_url = 'public/avatars/Default_avatar.png';
        }
        
        if ($request->hasFile('banner_url')) {
            $file = $request->file('banner_url');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/artist_banners'), $filename);
            $banner_url = 'images/artist_banners/' . $filename;
        } else {
            $banner_url = 'public/banners/Default_banner.png';
        }
        
        Artist::create([
            'name' => $request->name,
            'description' => $request->description,
            'youtube_link' => $request->youtube_link,
            'spotify_link' => $request->spotify_link,
            'apple_music_link' => $request->apple_music_link,
            'picture_url' => $picture_url,
            'banner_url' => $banner_url,
        ]);
        
        return redirect('/admin-panel');
    }

    /**
     * Shows edit artist form.
     */
    public function edit_artist_page($crypt_artist){
        $artist_id = Crypt::decrypt($crypt_artist);
        $artist = Artist::find($artist_id);
        return view('admin_views.artist.editArtist', compact('artist'));
    }

    /**
     * Updates artist info.
     */

    public function edit_artist(Request $request) {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'picture_url' => 'image',
            'banner_url' => 'image',
            'description' => 'string',
            'youtube_link' => 'required',
            'spotify_link' => 'required',
            'apple_music_link' => 'required|string',
        ]);

        $artist_id = Crypt::decrypt($request->id);
        $artist = Artist::find($artist_id);

        if ($request->hasFile('picture_url')) {
            $file = $request->file('picture_url');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/artist_images'), $filename);
            $picture_url = 'images/artist_images/' . $filename;
        } else {
            $picture_url = $artist->picture_url;
        }
        
        if ($request->hasFile('banner_url')) {
            $file = $request->file('banner_url');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/artist_banners'), $filename);
            $banner_url = 'images/artist_banners/' . $filename;
        } else {
            $banner_url = $artist->banner_url;
        }

        $artist->update([
            'name' => $request->name,
            'description' => $request->description,
            'youtube_link' => $request->youtube_link,
            'spotify_link' => $request->spotify_link,
            'apple_music_link' => $request->apple_music_link,
            'picture_url' => $picture_url,
            'banner_url' => $banner_url,
        ]);

        return redirect('/admin-panel');
    }

    /**
     * Deletes artist, comments, likes, albums and tracks.
     */
    public function delete_artist($crypt_artist)
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


