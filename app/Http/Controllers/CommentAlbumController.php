<?php

namespace App\Http\Controllers;

use App\Models\CommentAlbum;
use Illuminate\Http\Request;

class CommentAlbumController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function save_comment(Request $request)
    {   
        $request->validate([
            'content' => 'required',
            'user_id' => 'required',
            'album_id' => 'required',
        ]);
        CommentAlbum::create($request->all());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_album_comment($comment)
    {
        $comment_delete = CommentAlbum::find($comment)->delete();
        return redirect()->back();
    }
}
