<?php

namespace App\Http\Controllers;

use App\Models\LikeArtist;
use Illuminate\Http\Request;

class LikeArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'artist_id' => 'required',
        ]);

        LikeArtist::create($request->all());
        return redirect()->route('artists.show', $request->artist_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(LikeArtist $likeArtist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LikeArtist $likeArtist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LikeArtist $likeArtist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LikeArtist $likeArtist)
    {
        $likeArtist->delete();

        return redirect()->route('artists.show', $likeArtist->artist_id);
    }
}
