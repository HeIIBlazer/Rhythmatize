<?php

namespace App\Http\Controllers;

use App\Models\AlbumGenre;
use Illuminate\Http\Request;

class AlbumGenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
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
            'album_id' => 'required',
            'genre_id' => 'required',
        ]);

        AlbumGenre::create($request->all());

        return redirect()->route('albums.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(AlbumGenre $albumGenre)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AlbumGenre $albumGenre)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AlbumGenre $albumGenre)
    {
        $request->validate([
            'album_id' => 'required',
            'genre_id' => 'required',
        ]);

        $albumGenre->update($request->all());

        return redirect()->route('albums.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AlbumGenre $albumGenre)
    {
        //
    }
}
