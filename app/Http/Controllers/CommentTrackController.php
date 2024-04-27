<?php

namespace App\Http\Controllers;

use App\Models\CommentTrack;
use Illuminate\Http\Request;

class CommentTrackController extends Controller
{
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
     * Remove the specified resource from storage.
     */
    public function delete_track_comment($comment)
    {
        $comment_delete = CommentTrack::find($comment)->delete();
        return redirect()->back();
    }
}
