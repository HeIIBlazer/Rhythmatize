<?php

namespace App\Http\Controllers;

use App\Models\Track;
use App\Models\CommentTrack;
use App\Models\LikeTrack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Models\Album;

class TrackController extends Controller
{
    /**
     * Charts of tracks.
     */
    public function charts()
    {
        $user = null;
        $tracks = DB::table("tracks")->select('tracks.*', DB::raw('count(like_tracks.id) as likes_count'))
            ->leftJoin('like_tracks', 'track_id', '=', 'tracks.id')
            ->groupBy('tracks.id', 'tracks.name', 'tracks.time', 'tracks.spotify_link', 'tracks.youtube_link', 'tracks.apple_music_link', 'tracks.album_id', 'tracks.lyrics', 'tracks.explicit')
            ->orderBy('likes_count', 'desc')
            ->paginate(10);

        return view('tracks_views.tracksChart', compact('tracks', 'user'));
    }

    /**
     * Shows info about track.
     */
    public function show_track($crypt_track)
    {
        $track_id = Crypt::decrypt($crypt_track);
        $track = Track::find($track_id);

        $album = DB::table('albums')->where('id', $track->album_id)->first();

        $other_tracks = Track::where('album_id', $track->album_id)->where('id', '!=', $track_id)->take(4)->get();

        $comments = DB::table('comment_tracks')->where('track_id', $track->id)->get();
        return view('tracks_views.trackInfo', compact('track', 'comments', 'album', 'other_tracks'));
    }

    /**
     * Shows all tracks by one artist.
     */
    public function all_tracks($crypt_artist)
    {
        $artistId = Crypt::decrypt($crypt_artist);
        $artist = DB::table('artists')->where('id', $artistId)->first();
        

        // Get all albums by the artist
        $albums = Album::where('artist_id', $artist -> id)->get();

        $tracks = DB::table('tracks as t')
            ->select('t.*', DB::raw('count(lt.id) as likes_count'))
            ->leftJoin('like_tracks as lt', 't.id', '=', 'lt.track_id')
            ->whereIn('t.album_id', function ($query) use ($artist) {
                $query->select('albums.id')
                    ->from('albums')
                    ->where('albums.artist_id', $artist->id);
            })
            ->groupBy('t.id', 't.name', 't.time', 't.youtube_link', 't.spotify_link', 't.apple_music_link', 't.album_id', 't.lyrics', 't.explicit')
            ->orderBy('likes_count', 'desc')
            ->limit(3)
            ->get();

        $trackIds = [];
        $trackIds = $tracks->pluck('id')->toArray();

        $all_tracks = DB::table('tracks as t')
            ->select('t.*', DB::raw('count(lt.id) as likes_count'))
            ->leftJoin('like_tracks as lt', 't.id', '=', 'lt.track_id')
            ->whereIn('t.album_id', function ($query) use ($artist) {
                $query->select('albums.id')
                    ->from('albums')
                    ->where('albums.artist_id', $artist->id);
            })
            ->whereNotIn('t.id', $trackIds)
            ->groupBy('t.id', 't.name', 't.time', 't.youtube_link', 't.spotify_link', 't.apple_music_link', 't.album_id', 't.lyrics', 't.explicit')
            ->orderBy('likes_count', 'desc')
            ->get();


        return view('tracks_views.allTracks', compact('tracks', 'all_tracks', 'artist'));
    }

    /**
     * Show track add page
     */
    public function add_track_page(){
        $albums = Album::all();
        return view('admin_views.track.addTrack', compact('albums'));
    }

    /**
     * Add track.
     */
    public function add_track(Request $request){
        $request->validate([
            'name' => 'required',
            'time' => 'required',
            'spotify_link' => 'required',
            'youtube_link' => 'required',
            'apple_music_link' => 'required',
            'album_name' => 'required',
            'lyrics' => 'required',
        ]);

        $album = Album::where('name', $request->album_name)->first();

        if($album == null){
            return redirect()->back()->with('error', 'Album not found');
        }

        $album_track = Track::where('album_id', $album->id)->get();
        foreach($album_track as $track){
            if($track->name == $request->name){
                return redirect()->back()->with('error', 'Track already exists in this album');
            }
        }

        if($request -> lyrics == null){
            $lyrics = 'NO LYRICS';
        }else{
            $lyrics = $request->lyrics;
        }

        $explicit = $request->input('explicit');
        if($explicit == null){
            $explicit = 'NO';
        }else{
            $explicit = 'YES';
        }

        Track::create(
            [
                'name' => $request->name,
                'time' => $request->time,
                'spotify_link' => $request->spotify_link,
                'youtube_link' => $request->youtube_link,
                'apple_music_link' => $request->apple_music_link,
                'album_id' => $album->id,
                'lyrics' => $lyrics,
                'explicit' => $explicit,
            ]
        );

        return redirect('admin-panel');
    }

    /**
     * Show track edit page.
     */
    public function edit_track_page($crypt_track){
        $track_id = Crypt::decrypt($crypt_track);
        $track = Track::find($track_id);
        $albums = Album::all();
        $track_album = Album::where('id', $track->album_id)->first();
        return view('admin_views.track.editTrack', compact('track', 'albums', 'track_album'));
    }

    /**
     * Save edited track.
     */

     public function edit_track(Request $request){
        $request->validate([
            'crypt_track' => 'required',
            'name' => 'required',
            'time' => 'required',
            'spotify_link' => 'required',
            'youtube_link' => 'required',
            'apple_music_link' => 'required',
            'album_name' => 'required',
            'lyrics' => '',
        ]);

        $track_id = Crypt::decrypt($request->crypt_track);
        $track = Track::find($track_id);

        $album = Album::where('name', $request->album_name)->first();

        if($album == null){
            return redirect()->back()->with('error', 'Album not found');
        }

        $album_track = Track::where('album_id', $album->id)->get();
        if($track->name != $request->name){
            foreach($album_track as $track){
                if($track->name == $request->name){
                    return redirect()->back()->with('error', 'Track already exists in this album');
                }
            }
        }

        if($request -> lyrics == null){
            $lyrics = 'NO LYRICS';
        }else{
            $lyrics = $request->lyrics;
        }

        $explicit = $request->input('explicit');
        if($explicit == null){
            $explicit = 'NO';
        }else{
            $explicit = 'YES';
        }

        $track->update([
            'name' => $request->name,
            'time' => $request->time,
            'spotify_link' => $request->spotify_link,
            'youtube_link' => $request->youtube_link,
            'apple_music_link' => $request->apple_music_link,
            'album_id' => $album->id,
            'lyrics' => $lyrics,
            'explicit' => $explicit,
        
        ]);

        return redirect('admin-panel');
    }
    
    /**
     * Delete track.
     */
    public function delete_track($crypt_track){
        $track_id = Crypt::decrypt($crypt_track);

        $track = Track::find($track_id);
        
        $comments = DB::table('comment_tracks')->where('track_id', $track->id)->get();
        if ($comments->count() != 0) {
            foreach ($comments as $comment) {
                $comment_delete = CommentTrack::find($comment->id)->delete;
            }
        }

        $likes = DB::table('like_tracks')->where('track_id', $track->id)->get();
        if ($likes->count() != 0) {
            foreach ($likes as $like) {
                $like_delete = LikeTrack::find($like->id)->delete();
            }
        }

        $track_delete = Track::find($track->id)->delete();
        
        return redirect()->back();
    }

}