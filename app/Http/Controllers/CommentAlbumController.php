<?php

namespace App\Http\Controllers;

use App\Models\CommentAlbum;
use Illuminate\Http\Request;

class CommentAlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'user_id' => 'required',
            'album_id' => 'required',
        ]);

        CommentAlbum::create($request->all());
        return redirect()->route('albums.show', $request->album_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(CommentAlbum $commentAlbum)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CommentAlbum $commentAlbum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CommentAlbum $commentAlbum)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($comment)
    {
        $comment_delete = CommentAlbum::find($comment)->delete();
        return redirect()->back();
    }
}
