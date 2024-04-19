<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tracks.index');   
    }

    public function charts() 
    {
        $user = null;
        $tracks = DB::table("tracks")->select('tracks.*', DB::raw('count(like_tracks.id) as likes_count'))
                        ->leftJoin('like_tracks', 'track_id', '=', 'tracks.id')
                        ->groupBy('tracks.id','tracks.name', 'tracks.time', 'tracks.spotify_link', 'tracks.youtube_link', 'tracks.apple_music_link', 'tracks.album_id', 'tracks.lyrics', 'tracks.explicit')
                        ->orderBy('likes_count', 'desc')
                        ->paginate(10);

        return view('tracks_views.tracksChart', compact('tracks', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tracks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'duration' => 'required',
            'youtube_link' => 'required',
            'spotify_link' => 'required',
            'apple_music_link' => 'required',
            'album_id' => 'required',
        ]);

        Track::create($request->all());
        return redirect()->route('albums.show', $request->album_id);
    }

    /**
     * Display the specified resource.
     */
    public function show_track($crypt_track)
    {
        $track_id = Crypt::decrypt($crypt_track);
        $track = Track::find($track_id);

        $album = DB::table('albums')->where('id', $track->album_id)->first();

        $other_tracks = Track::where('album_id', $track->album_id)->where('id', '!=', $track_id)->take(4)->get();

        $comments = DB::table('comment_tracks')->where('track_id', $track->id)->get();
        return view('tracks_views.trackInfo', compact('track', 'comments', 'album', 'other_tracks'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Track $track)
    {
        return view('tracks.edit', compact('track'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Track $track)
    {
        $request->validate([
            'name' => 'required',
            'duration' => 'required',
            'youtube_link' => 'required',
            'spotify_link' => 'required',
            'apple_music_link' => 'required',
            'album_id' => 'required',
        ]);

        $track->update($request->all());
        return redirect()->route('albums.show', $request->album_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Track $track)
    {
        $track->delete();

        return redirect()->route('albums.show', $track->album_id);
    }
}
