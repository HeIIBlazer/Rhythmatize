<?php

namespace App\Http\Controllers;

use App\Models\LikeTrack;
use Illuminate\Http\Request;

class LikeTrackController extends Controller
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
        request()->validate([
            'user_id' => 'required',
            'track_id' => 'required',
        ]);

        LikeTrack::create($request->all());
        return redirect()->route('tracks.show', $request->track_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(LikeTrack $likeTrack)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LikeTrack $likeTrack)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LikeTrack $likeTrack)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LikeTrack $likeTrack)
    {
        $likeTrack->delete();

        return redirect()->route('tracks.show', $likeTrack->track_id);
    }
}
