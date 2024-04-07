<?php

namespace App\Http\Controllers;

use App\Models\LikeArtist;
use Illuminate\Http\Request;
use App\Models\Artist;

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
    public function like(Artist $artist)
    {
        $artist_id = $artist->id;
        $user_id = auth()->user()->id;

        LikeArtist::create([
            'artist_id' => $artist_id,
            'user_id' => $user_id
        ]);

        return redirect()->back();
    }

    public function unlike(Artist $artist)
    {
        $artist_id = $artist->id;
        $user_id = auth()->user()->id;

        $like = LikeArtist::where('artist_id', $artist_id)->where('user_id', $user_id)->first();
        $like->delete();

        return redirect()->back();
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
