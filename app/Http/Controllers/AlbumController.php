<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = null;
        $albums = DB::table("albums")->orderBy('name', 'desc')->paginate(12);
        return view('album_views.albumsList', compact('albums', 'user'));
    }

    public function charts() 
    {
        
        $albums = DB::table("albums")->select('albums.*', DB::raw('count(like_albums.id) as likes_count'))
                        ->leftJoin('like_albums', 'albums.id', '=', 'like_albums.album_id')
                        ->groupBy('albums.id', 'albums.name' , 'albums.cover_url', 'albums.release_date', 'albums.description', 'albums.youtube_link', 'albums.spotify_link', 'albums.apple_music_link', 'albums.type', 'albums.artist_id')
                        ->orderBy('likes_count', 'desc',)
                        ->paginate(10);

        return view('album_views.albumsChart', compact('albums'));
    }

    public function top_3_albums()
    {
        $albums = DB::table("albums")->select('albums.*', DB::raw('count(like_albums.id) as likes_count'))
                        ->leftJoin('like_albums', 'albums.id', '=', 'like_albums.album_id')
                        ->groupBy('albums.id', 'albums.name' , 'albums.cover_url', 'albums.release_date', 'albums.description', 'albums.youtube_link', 'albums.spotify_link', 'albums.apple_music_link', 'albums.type', 'albums.artist_id')
                        ->orderBy('likes_count', 'desc',)
                        ->limit(3)
                        ->get();

        $lastAdded = Album::orderBy('id', 'desc')->take(3)->get();

        $artists = Artist::select('artists.*', DB::raw('count(like_artists.id) as likes_count'))
                        ->leftJoin('like_artists', 'artists.id', '=', 'like_artists.artist_id')
                        ->groupBy('artists.id', 'artists.name', 'artists.picture_url', 'artists.banner_url', 'artists.description', 'artists.youtube_link', 'artists.spotify_link', 'artists.apple_music_link')
                        ->orderBy('likes_count', 'desc')
                        ->limit(3)
                        ->get();
        
        $tracks = Track::select('tracks.*', DB::raw('count(like_tracks.id) as likes_count'))
                        ->leftJoin('like_tracks', 'tracks.id', '=', 'like_tracks.track_id')
                        ->groupBy('tracks.id', 'tracks.name','tracks.time', 'tracks.spotify_link','tracks.youtube_link',"tracks.apple_music_link", 'tracks.album_id', 'tracks.lyrics', 'tracks.explicit')
                        ->orderBy('likes_count', 'desc')
                        ->limit(3)
                        ->get();

        return view('main', compact('albums', 'lastAdded', 'artists', 'tracks'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $albums = Album::select('albums.*')->where('name', 'like', '%'.$search.'%')->limit(6)->get();
        $artists = Artist::select('artists.*')->where('name', 'like', '%'.$search.'%')->limit(6)->get();
        $tracks = Track::select('tracks.*')->where('name', 'like', '%'.$search.'%')->limit(4)->get();
        
        
        if($albums->count() == 0 && $artists->count() == 1){
            $artist_id = $artists->first()->id;
            $albums = Album::select('albums.*')->where('artist_id', 'like', $artist_id)->limit(6)->get();
            $album_id = $albums->first()->id;
            if($tracks->count() == 0 && $artists->count() == 1){
                $tracks = Track::select('tracks.*')->where('album_id', 'like', $album_id)->limit(4)->get();
            }
            // return $album;
            return view('searchResult', compact('albums', 'artists', 'tracks'));
        } else {
            return view('searchResult', compact('albums', 'artists', 'tracks'));
        }
    }

    public function album_show(Album $album) {
        $tracks = DB::table('tracks')->where('album_id', $album->id)->get();
        return view('album_views.albumShow', compact('album', 'tracks'));
    }

    public function show_album(Album $album)
    {
        $genre_album = DB::table('album_genres')->where('album_id', $album->id)->first();
        $genre = DB::table('genres')->where('id', $genre_album->genre_id)->first();

        $artistId = $album->artist_id;
        $albums = Album::where('artist_id', $artistId)
                ->where('id', '!=', $album->id)
                ->take(2)
                ->get();

        $tracks = DB::table('tracks')->where('album_id', $album->id)->get();
        $comments = DB::table('comment_albums')->where('album_id', $album->id)->get();
        return view('album_views.albumInfo', compact('album', 'comments', 'tracks', 'genre', 'albums'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function last_added()
    {
        $albums = DB::table("albums")->orderBy('id', 'desc')->paginate(12);
        return view('album_views.lastAddedAlbums', compact('albums'));
    }

    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'cover_url' => 'required',
            'release_date' => 'required',
            'description' => 'required',
            'youtube_link' => 'required',
            'spotify_link' => 'required',
            'apple_music_link' => 'required',
            'type' => 'required',
            'artist_id' => 'required',
        ]);

        Album::create($request->all());
        return redirect()->route('albums.index');
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        return view('albums.edit', compact('album'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {
        $request->validate([
            'name' => 'required',
            'cover_url' => 'required',
            'release_date' => 'required',
            'description' => 'required',
            'youtube_link' => 'required',
            'spotify_link' => 'required',
            'apple_music_link' => 'required',
            'type' => 'required',
            'artist_id' => 'required',
        ]);

        $album->update($request->all());
        return redirect()->route('albums.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        $album->delete();
        return redirect()->route('albums.index');
    }
}
