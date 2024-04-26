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

    public function delete_artist_comment($comment)
    {
        $comment_delete = CommentArtist::find($comment)->delete();
        return redirect()->back();
    }
}
