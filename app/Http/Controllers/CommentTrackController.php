<?php

namespace App\Http\Controllers;

use App\Models\CommentTrack;
use Illuminate\Http\Request;

class CommentTrackController extends Controller
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
    public function save_comment(Request $request)
    {   
        $request->validate([
            'content' => 'required',
            'user_id' => 'required',
            'track_id' => 'required',
        ]);
        CommentTrack::create($request->all());
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'user_id' => 'required',
            'track_id' => 'required',
        ]);

        CommentTrack::create($request->all());
        return redirect()->route('tracks.show', $request->track_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(CommentTrack $commentTrack)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CommentTrack $commentTrack)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CommentTrack $commentTrack)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommentTrack $commentTrack)
    {
        $commentTrack->delete();
        return redirect()->route('tracks.show', $commentTrack->track_id);
    }
}
