<?php

namespace App\Http\Controllers;

use App\Models\Artist;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Track;


class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artists = DB::table("artists")->orderBy('name', 'desc')->paginate(12);
        return view('artist_views.artistsList', compact('artists'));
    }

    public function charts() 
    {
        $artists = DB::table("artists")->select('artists.*', DB::raw('count(like_artists.id) as likes_count'))
                        ->leftJoin('like_artists', 'artist_id', '=', 'artists.id')
                        ->groupBy('artists.id', 'artists.name', 'artists.picture_url', 'artists.banner_url', 'artists.description', 'artists.youtube_link', 'artists.spotify_link', 'artists.apple_music_link')
                        ->orderBy('likes_count', 'desc')
                        ->paginate(10);

        return view('artist_views.artistsChart', compact('artists'));
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
    
    public function last_added()
    {
        $artists = DB::table("artists")->orderBy('id', 'desc')->paginate(12);
        return view('artist_views.lastAddedArtists', compact('artists'));
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
        $comments = DB::table('comment_artists')->where('artist_id', $artist->id)->get();
        return view('artists.show', compact('artist', 'comments'));
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

    public function show_artist (Artist $artist)
    {
        $comments = DB::table('comment_artists')->where('artist_id', $artist->id)->get();

        $albums = DB::table('albums')->where('artist_id', $artist->id)
                    ->select('albums.*', DB::raw('count(like_albums.id) as likes_count'))
                    ->leftJoin('like_albums', 'albums.id', '=', 'like_albums.album_id')
                    ->groupBy('albums.id', 'albums.name', 'albums.cover_url', 'albums.release_date', 'albums.artist_id', 'albums.description', 'albums.youtube_link', 'albums.spotify_link', 'albums.apple_music_link', 'albums.type')
                    ->orderBy('likes_count', 'desc')
                    ->limit(3)
                    ->get();

        

        $tracks = DB::table('tracks as t')
                    ->select('t.*', DB::raw('count(lt.id) as likes_count'))
                    ->leftJoin('like_tracks as lt', 't.id', '=', 'lt.track_id')
                    ->whereIn('t.album_id', function ($query) use ($artist) {
                        $query->select('albums.id')
                            ->from('albums')
                            ->where('albums.artist_id', $artist->id);
                    })
                    ->groupBy('t.id', 't.name', 't.time','t.widget_link', 't.youtube_link', 't.spotify_link', 't.apple_music_link', 't.album_id', 't.lyrics', 't.explicit')
                    ->orderBy('likes_count', 'desc')
                    ->limit(4)
                    ->get();



        if(count($comments) == 0 && count($albums) == 0 && count($tracks) == 0){
            $comments= 'NO COMMENTS';
            $albums= 'NO ALBUMS BY THIS ARTIST';
            $tracks= 'NO TRACKS BY THIS ARTIST';
            return view('artist_views.artistInfo', compact('artist', 'comments', 'albums','tracks'));
        }elseif(count($comments) == 0 && count($tracks) == 0)
        {
            $comments= 'NO COMMENTS';
            $tracks= 'NO TRACKS BY THIS ARTIST';
            return view('artist_views.artistInfo', compact('artist', 'comments', 'albums','tracks'));
        }elseif(count($comments) == 0){
            $comments= 'NO COMMENTS';
            return view('artist_views.artistInfo', compact('artist', 'comments', 'albums','tracks'));
        }
        
        


        return view('artist_views.artistInfo', compact('artist','tracks', 'comments', 'albums',));
        // return $tracks;
    }
}
