<?php

namespace App\Http\Controllers;

use App\Models\CommentArtist;
use Illuminate\Http\Request;

class CommentArtistController extends Controller
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

    public function save_comment(Request $request)
{   
    $request->validate([
        'content' => 'required',
        'user_id' => 'required',
        'artist_id' => 'required',
    ]);
    CommentArtist::create($request->all());
    return redirect()->back();
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'artist_id' => 'required',
            'content' => 'required',
        ]);

        CommentArtist::create($request->all());
        return redirect()->route('artists.show', $request->artist_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(CommentArtist $commentArtist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CommentArtist $commentArtist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CommentArtist $commentArtist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommentArtist $commentArtist)
    {
        $commentArtist->delete();
        return redirect()->route('artists.show', $commentArtist->artist_id);
    }
}
