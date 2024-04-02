<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tracks.index');   
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
    public function show(Track $track)
    {
        return view('tracks.show', compact('track'));
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
