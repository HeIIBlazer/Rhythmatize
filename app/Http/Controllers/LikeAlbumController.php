<?php

namespace App\Http\Controllers;

use App\Models\LikeAlbum;
use Illuminate\Http\Request;

class LikeAlbumController extends Controller
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
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'user_id' => 'required',
            'album_id' => 'required',
        ]);

        LikeAlbum::create($request->all());
        return redirect()->route('albums.show', $request->album_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(LikeAlbum $likeAlbum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LikeAlbum $likeAlbum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LikeAlbum $likeAlbum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LikeAlbum $likeAlbum)
    {
        $likeAlbum->delete();

        return redirect()->route('albums.show', $likeAlbum->album_id);
    }
}
