<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentArtistController;
use App\Http\Controllers\CommentAlbumController;
use App\Http\Controllers\CommentTrackController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LikeArtistController;
use App\Http\Controllers\LikeAlbumController;
use App\Http\Controllers\LikeTrackController;
use App\Http\Controllers\GenreController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('main');
});

// ALBUMS
Route::get('/', [AlbumController::class, 'top_3_albums']);
Route::get('/album-list', [AlbumController::class, 'index']);
Route::get('/album-chart', [AlbumController::class, 'charts']);
Route::get('/last-added-albums', [AlbumController::class, 'last_added']);
Route::get('/album/{album}', [AlbumController::class, 'show_album']);
Route::post('/save-comment-album', [CommentAlbumController::class, 'save_comment'])->name('save_comment');
Route::get('/all-albums/{artist}', [AlbumController::class, 'all_albums']);
Route::get('/delete-album-comment/{comment}', [CommentAlbumController::class, 'delete_album_comment']);


// ARTISTS
Route::get('/artist-list', [ArtistController::class, 'index']);
Route::get('/artist-chart', [ArtistController::class, 'charts']);
Route::get('/last-added-artists', [ArtistController::class, 'last_added']);
Route::get('/artist/{artist}', [ArtistController::class, 'show_artist']);
Route::post('/save-comment-artist', [CommentArtistController::class, 'save_comment'])->name('save_comment');
Route::get('/delete-artist-comment/{comment}', [CommentArtistController::class, 'delete_artist_comment']);

// TRACKS
Route::get('/track-chart', [TrackController::class, 'charts']);
Route::get('/track/{track}', [TrackController::class, 'show_track']);
Route::post('/save-comment-track', [CommentTrackController::class, 'save_comment'])->name('save_comment');
Route::get('/all-tracks/{artist}', [TrackController::class, 'all_tracks']);
Route::get('/delete-track-comment/{comment}', [CommentTrackController::class, 'delete_track_comment']);

// USER
Route::get('/user/{user}', [UserController::class, 'show_user']);
Route::post('/update/{user}', [UserController::class, 'update']); 
Route::get('/liked-albums/{user}', [UserController::class, 'show_liked_albums']);
Route::get('/liked-artists/{user}', [UserController::class, 'show_liked_artists']);
Route::get('/liked-tracks/{user}', [UserController::class,'show_liked_tracks']);


//LOGIN & REGISTER
Route::get('/login', [AuthController::class, 'login']);
Route::post('/login-auth', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/register', [UserController::class, 'store_register']);

//LIKE SYSTEM
Route::get('/like-artist/{artist}', [LikeArtistController::class, 'like']);
Route::get('/unlike-artist/{artist}', [LikeArtistController::class, 'unlike']);
Route::get('/like-album/{album}', [LikeAlbumController::class, 'like']);
Route::get('/unlike-album/{album}', [LikeAlbumController::class, 'unlike']);
Route::get('/like-track/{track}', [LikeTrackController::class, 'like']);
Route::get('/unlike-track/{track}', [LikeTrackController::class, 'unlike']);

// SEARCH
Route::get('/search', [AlbumController::class, 'search']);

// ADMIN PANEL
Route::middleware('admin')->group(function () {

    Route::get('/admin-panel', [UserController::class,'dashboard']);

    Route::post('/add-genre', [GenreController::class, 'add_genre']);

    Route::get('/add-artist', [ArtistController::class, 'add_artist_page']);
    Route::post('/add-artist-to-database', [ArtistController::class, 'add_artist']);
    Route::get('/edit-artist/{artist}', [ArtistController::class, 'edit_artist_page']);
    Route::post('/save-edited-artist', [ArtistController::class, 'edit_artist']);
    Route::get('/delete-artist/{artist}', [ArtistController::class, 'delete_artist']);

    Route::get('/add-album', [AlbumController::class, 'add_album_page']);
    Route::post('/add-album-to-database', [AlbumController::class, 'add_album']);
    Route::get('/edit-album/{album}', [AlbumController::class, 'edit_album_page']);
    Route::post('/save-edited-album', [AlbumController::class, 'edit_album']);
    Route::get('/delete-album/{album}', [AlbumController::class, 'delete_album']);

    Route::get('/add-track', [TrackController::class, 'add_track_page']);
    Route::post('/add-track-to-database', [TrackController::class, 'add_track']);
    Route::get('/edit-track/{track}', [TrackController::class, 'edit_track_page']);
    Route::post('/save-edited-track', [TrackController::class, 'edit_track']);
    Route::get('/delete-track/{track}', [TrackController::class, 'delete_track']);
});
