<?php

namespace App\Http\Controllers;

use App\Models\CommentArtist;
use Illuminate\Http\Request;

class CommentArtistController extends Controller
{
    public function save_comment(Request $request){   
    $request->validate([
        'content' => 'required',
        'user_id' => 'required',
        'artist_id' => 'required',
    ]);
    CommentArtist::create($request->all());
    return redirect()->back();
}

    public function delete_artist_comment($comment){
        $comment_delete = CommentArtist::find($comment)->delete();
        return redirect()->back();
    }
}
