<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = Album::orderBy('created_at', 'desc')->get();
        return view('albums.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     */
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
