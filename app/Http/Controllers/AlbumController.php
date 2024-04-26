<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Track;
use App\Models\Genre;
use App\Models\CommentTrack;
use App\Models\CommentAlbum;
use App\Models\LikeTrack;
use App\Models\LikeAlbum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class AlbumController extends Controller
{
    /**
     * Show 12 albums per page for album list page.
     */
    public function index()
    {
        $user = null;
        $albums = DB::table("albums")->orderBy('name', 'asc')->paginate(12);
        return view('album_views.albumsList', compact('albums', 'user'));
    }

    /**
     *  Show the albums in a chart.
     */
    public function charts() 
    {
        
        $albums = DB::table("albums")->select('albums.*', DB::raw('count(like_albums.id) as likes_count'))
                        ->leftJoin('like_albums',"album_id",'=' ,'albums.id')
                        ->groupBy('albums.id', 'albums.name', 'albums.cover_url', 'albums.release_date', 'albums.description', 'albums.youtube_link', 'albums.spotify_link', 'albums.apple_music_link', 'albums.type', 'albums.artist_id', 'albums.genre_id')
                        ->orderBy('likes_count', 'desc',)
                        ->paginate(10);

        return view('album_views.albumsChart', compact('albums'));
    }

    /**
     * Shows the top 3 albums, artists and tracks.
     */
    public function top_3_albums()
    {
        $albums = DB::table("albums")->select('albums.*', DB::raw('count(like_albums.id) as likes_count'))
                        ->leftJoin('like_albums',"album_id",'=' ,'albums.id')
                        ->groupBy('albums.id', 'albums.name' , 'albums.cover_url', 'albums.release_date', 'albums.description', 'albums.youtube_link', 'albums.spotify_link', 'albums.apple_music_link', 'albums.type', 'albums.artist_id', 'albums.genre_id')
                        ->orderBy('likes_count', 'asc',)
                        ->limit(3)
                        ->get();

        $lastAdded = Album::orderBy('id', 'desc')->take(3)->get();

        $artists = DB::table("artists")->select('artists.*', DB::raw('count(like_artists.id) as likes_count'))
                        ->leftJoin('like_artists', 'artist_id', '=', 'artists.id')
                        ->groupBy('artists.id', 'artists.name', 'artists.picture_url', 'artists.banner_url', 'artists.description', 'artists.youtube_link', 'artists.spotify_link', 'artists.apple_music_link')
                        ->orderBy('likes_count', 'desc')
                        ->limit(3)
                        ->get();
        
        $tracks = Track::select('tracks.*', DB::raw('count(like_tracks.id) as likes_count'))
                        ->leftJoin('like_tracks', 'tracks.id', '=', 'like_tracks.track_id')
                        ->groupBy('tracks.id', 'tracks.name','tracks.time', 'tracks.spotify_link','tracks.youtube_link',"tracks.apple_music_link", 'tracks.album_id', 'tracks.lyrics', 'tracks.explicit')
                        ->orderBy('likes_count', 'desc')
                        ->limit(3)
                        ->get();

        return view('main', compact('albums', 'lastAdded', 'artists', 'tracks'));
    }

    /**
     * Search for albums, artists and tracks.
     */
    public function search(Request $request)
    {
        $search = $request->input('search');
        $albums = Album::select('albums.*')->where('name', 'like', '%'.$search.'%')->limit(6)->get();
        $artists = Artist::select('artists.*')->where('name', 'like', '%'.$search.'%')->limit(6)->get();
        $tracks = Track::select('tracks.*')->where('name', 'like', '%'.$search.'%')->limit(4)->get();
        
        
        if($albums->count() == 0 && $artists->count() == 1){
            $artist_id = $artists->first()->id;
            $albums = Album::select('albums.*')->where('artist_id', 'like', $artist_id)->limit(6)->get();
            if ($albums->count() == 0){
                return view('searchResult', compact('albums', 'artists', 'tracks', 'search'));
            }
            $album_id = $albums->first()->id;
            if($tracks->count() == 0 && $artists->count() == 1){
                $tracks = Track::select('tracks.*')->where('album_id', 'like', $album_id)->limit(4)->get();
            }
            // return $album;
            return view('searchResult', compact('albums', 'artists', 'tracks', 'search'));
        } else {
            return view('searchResult', compact('albums', 'artists', 'tracks', 'search'));
        }
    }

    /**
     * Shows info about album with the tracks from it.
     */
    public function album_show(Album $album) {
        $tracks = DB::table('tracks')->where('album_id', $album->id)->get();
        return view('album_views.albumShow', compact('album', 'tracks'));
    }

    public function show_album($crypt_album)
    {
        $cryptId = Crypt::decrypt($crypt_album);
        $album = Album::find($cryptId);

        $genre = DB::table('genres')->where('id', $album->genre_id)->first();

        $artistId = $album->artist_id;
        $albums = Album::where('artist_id', $artistId)
                ->where('id', '!=', $album->id)
                ->take(2)
                ->get();

        $tracks = DB::table('tracks')->where('album_id', $album->id)->get();
        $comments = DB::table('comment_albums')->where('album_id', $album->id)->get();
        return view('album_views.albumInfo', compact('album', 'comments', 'tracks', 'genre', 'albums'));
    }

    /**
     * Show last added albums in album list page.
     */
    public function last_added()
    {
        $albums = DB::table("albums")->orderBy('id', 'desc')->paginate(12);
        return view('album_views.lastAddedAlbums', compact('albums'));
    }

    /**
     * Show all albums for one artist.
     */
    public function all_albums($crypt_artist){

        $artist_id = Crypt::decrypt($crypt_artist);
        $artist = Artist::find($artist_id);

        $albums = DB::table('albums')->where('artist_id', $artist_id)
                ->leftJoin('like_albums as la', 'albums.id', '=', 'la.album_id')
                ->select('albums.*', DB::raw('count(la.id) as likes_count'))
                ->groupBy('albums.id', 'albums.name', 'albums.cover_url', 'albums.release_date', 'albums.description', 'albums.youtube_link', 'albums.spotify_link', 'albums.apple_music_link', 'albums.type', 'albums.artist_id', 'albums.genre_id')
                ->orderBy('likes_count', 'desc')
                ->limit(3)
                ->get();

        $albumsIds = [];
        $albumsIds = $albums->pluck('id')->toArray();

        $all_albums = DB::table('albums')->where('artist_id', $artist_id)
                    ->leftJoin('like_albums as la', 'albums.id', '=', 'la.album_id')
                    ->select('albums.*', DB::raw('count(la.id) as likes_count'))
                    ->groupBy('albums.id', 'albums.name', 'albums.cover_url', 'albums.release_date', 'albums.description', 'albums.youtube_link', 'albums.spotify_link', 'albums.apple_music_link', 'albums.type', 'albums.artist_id', 'albums.genre_id')
                    ->whereNotIn('albums.id', $albumsIds)
                    ->orderBy('likes_count', 'desc')
                    ->get();

        return view('album_views.allAlbums', compact('albums', 'artist', 'all_albums'));
    }

    /**
     * Show add album page
     */

    public function add_album_page(){
        $artists = Artist::all();
        $genres = Genre::all();
        return view('admin_views.album.addAlbum', compact('artists','genres'));
    }

    /**
     * Add album to database
     */

    public function add_album(Request $request){
        
        $request->validate([
            'name' => 'required',
            'cover_url' => 'image',
            'release_date' => 'required',
            'description' => '',
            'youtube_link' => 'required',
            'spotify_link' => 'required',
            'apple_music_link' => 'required',
            'type' => 'required',
            'artist_name' => 'required',
            'genre_name' => 'required',
        ]);

        $artist = Artist::where('name', $request->artist_name)->first();
        $genre = Genre::where('name', $request->genre_name)->first();


        
        
        if ($artist == null) {
            return redirect()->back()->with('error', 'Artist does not exist');
        }
        
        $artist_albums = Album::where('artist_id', $artist->id)->get();
        foreach($artist_albums as $artist_album){
            if($artist_album->name == $request->name){
                return redirect()->back()->with('error', 'Album already exists');
            }
        }

        if ($genre == null) {
            return redirect()->back()->with('error', 'Genre does not exist');
        }

        if ($request->hasFile('cover_url')) {
            $file = $request->file('cover_url');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/album_covers'), $filename);
            $album_cover = 'images/album_covers/' . $filename;
        } else {
            $album_cover = '../images/avatars/Default_avatar.png';
        }

        if($request -> description == null){
            $description = "NO INFO";
        }else{
            $description = $request -> description;
        }


        Album::create([
            'name' => $request->name,
            'cover_url' => $album_cover,
            'release_date' => $request->release_date,
            'description' => $description,
            'youtube_link' => $request->youtube_link,
            'spotify_link' => $request->spotify_link,
            'apple_music_link' => $request->apple_music_link,
            'type' => $request->type,
            'artist_id' => $artist->id,
            'genre_id' => $genre->id,
        ]);

        return redirect('/admin-panel');
    }

    /**
     * Show edit album page
     */
    public function edit_album_page($crypt_album)
    {
        $album_id = Crypt::decrypt($crypt_album);
        $album = Album::find($album_id);
        $artists = Artist::all();
        $genres = Genre::all();
        return view('admin_views.album.editAlbum', compact('album', 'artists', 'genres'));
    }

    /**
     * Updates albums info
     */

    public function edit_album(Request $request){

        
        $request->validate([
            'crypt_album' => 'required',
            'name' => 'required',
            'cover_url' => 'image',
            'release_date' => 'required',
            'description' => '',
            'youtube_link' => 'required',
            'spotify_link' => 'required',
            'apple_music_link' => 'required',
            'type' => 'required',
            'artist_name' => 'required',
            'genre_name' => 'required',
        ]);

        $album_id = Crypt::decrypt($request->crypt_album);
        $album = Album::find($album_id);

        $artist = Artist::where('name', $request->artist_name)->first();
        $genre = Genre::where('name', $request->genre_name)->first();


        
        
        if ($artist == null) {
            return redirect()->back()->with('error', 'Artist does not exist');
        }
        
        $artist_albums = Album::where('artist_id', $artist->id)->get();
        
        if($album->name != $request->name){
            foreach($artist_albums as $artist_album){
                if($artist_album->name == $request->name){
                    return redirect()->back()->with('error', 'Album already exists');
                }
            }
        }
    

        if ($genre == null) {
            return redirect()->back()->with('error', 'Genre does not exist');
        }

        if ($request->hasFile('cover_url')) {
            $file = $request->file('cover_url');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/album_covers'), $filename);
            $album_cover = 'images/album_covers/' . $filename;
        } else {
            $album_cover = '../images/avatars/Default_avatar.png';
        }

        if($request -> description == null){
            $description = "NO INFO";
        }else{
            $description = $request -> description;
        }

        $album->update([
            'name' => $request->name,
            'cover_url' => $album_cover,
            'release_date' => $request->release_date,
            'description' => $description,
            'youtube_link' => $request->youtube_link,
            'spotify_link' => $request->spotify_link,
            'apple_music_link' => $request->apple_music_link,
            'type' => $request->type,
            'artist_id' => $artist->id,
            'genre_id' => $genre->id,
        ]);

        return redirect('/admin-panel');
    }

    /**
     * Deletes Album and all it's comments, likes and tracks.
     */
    public function delete_album($crypt_album){

        $album_id = Crypt::decrypt($crypt_album);

        $album = Album::find($album_id);

        $tracks = DB::table('tracks')->where('album_id', $album->id)->get();
        if ($tracks->count() != 0) {
            foreach ($tracks as $track) {
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
            }
        }
        
        $comments = DB::table('comment_albums')->where('album_id', $album->id)->get();
        if ($comments->count() != 0) {
            foreach ($comments as $comment) {
                $comment_delete = CommentAlbum::find($comment->id)->delete();
            }
        }

        $likes = DB::table('like_albums')->where('album_id', $album->id)->get();
        if ($likes->count() != 0) {
            foreach ($likes as $like) {
                $like_delete = LikeAlbum::find($like->id)->delete();
            }
        }

        $album_delete = Album::find($album->id)->delete();

        return redirect()->back();
    }
}
