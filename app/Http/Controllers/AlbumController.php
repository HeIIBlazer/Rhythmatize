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
        $albums = Album::all();
        return view('album_views.albumsList', compact('albums'));
    }

    public function show_top_3_albums() {
        $albums = Album::orderBy('id', 'desc')->take(3)->get();
        return view('main', compact('albums'));
    }

    public function top_3_albums()
    {
        $albums = Album::select('albums.*', DB::raw('count(like_albums.id) as likes_count'))
                        ->leftJoin('like_albums', 'albums.id', '=', 'like_albums.album_id')
                        ->groupBy('albums.id', 'albums.name' , 'albums.cover_url', 'albums.release_date', 'albums.description', 'albums.youtube_link', 'albums.spotify_link', 'albums.apple_music_link', 'albums.type', 'albums.artist_id')
                        ->orderBy('likes_count', 'desc')
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


    /**
     * Show the form for creating a new resource.
     */

    // public function last_added_3(){
    //     $albums = Album::orderBy('id', 'desc')->take(3)->get();
    //     return view('main', compact('albums'));
    // }

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
    public function show(Album $album)
    {
        return view('albums.show', compact('album'));
    }

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
