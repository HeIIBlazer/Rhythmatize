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
Route::get('/album_list', [AlbumController::class, 'index']);
Route::get('/album_chart', [AlbumController::class, 'charts']);
Route::get('/last_added_albums', [AlbumController::class, 'last_added']);
Route::get('/album/{album}', [AlbumController::class, 'show_album']);
Route::post('/save_comment_album', [CommentAlbumController::class, 'save_comment'])->name('save_comment');
Route::get('/all_albums/{artist}', [AlbumController::class, 'all_albums']);


// ARTISTS
Route::get('/artist_list', [ArtistController::class, 'index']);
Route::get('/artist_chart', [ArtistController::class, 'charts']);
Route::get('/last_added_artists', [ArtistController::class, 'last_added']);
Route::get('/artist/{artist}', [ArtistController::class, 'show_artist']);
Route::post('/save_comment_artist', [CommentArtistController::class, 'save_comment'])->name('save_comment');

// TRACKS
Route::get('/track_chart', [TrackController::class, 'charts']);
Route::get('/track/{track}', [TrackController::class, 'show_track']);
Route::post('/save_comment_track', [CommentTrackController::class, 'save_comment'])->name('save_comment');
Route::get('/all_tracks/{artist}', [TrackController::class, 'all_tracks']);

// USER
Route::get('/user/{user}', [UserController::class, 'show_user']);
Route::post('/update/{user}', [UserController::class, 'update']); 
Route::get('/liked-albums/{user}', [UserController::class, 'show_liked_albums']);
Route::get('/liked-artists/{user}', [UserController::class, 'show_liked_artists']);
Route::get('/liked-tracks/{user}', [UserController::class,'show_liked_tracks']);
Route::get('/admin-panel', [UserController::class,'dashboard']);

//LOGIN & REGISTER
Route::get('/login', [AuthController::class, 'login']);
Route::post('/login_auth', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/register', [UserController::class, 'store_register']);

//LIKE SYSTEM
Route::get('/like_artist/{artist}', [LikeArtistController::class, 'like']);
Route::get('/unlike_artist/{artist}', [LikeArtistController::class, 'unlike']);
Route::get('/like_album/{album}', [LikeAlbumController::class, 'like']);
Route::get('/unlike_album/{album}', [LikeAlbumController::class, 'unlike']);
Route::get('/like_track/{track}', [LikeTrackController::class, 'like']);
Route::get('/unlike_track/{track}', [LikeTrackController::class, 'unlike']);

// SEARCH
Route::get('/search', [AlbumController::class, 'search']);

// ADMIN PANEL
Route::get('/delete_artist/{artist}', [ArtistController::class, 'delete_artist']);