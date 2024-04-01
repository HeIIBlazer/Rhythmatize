<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use app\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artists = Artist::orderBy('created_at', 'desc')->get();
        return view('artists.index', compact('artists'));
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
        return view('artists.show', compact('artist'));
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artist $artist)
    {
        $artist->delete();
        return redirect()->route('artists.index');
    }
}
