<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentArtistController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LikeArtistController;
use App\Models\CommentArtist;

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


// ARTISTS
Route::get('/artist_list', [ArtistController::class, 'index']);
Route::get('/artist_chart', [ArtistController::class, 'charts']);
Route::get('/last_added_artists', [ArtistController::class, 'last_added']);
Route::get('/artist/{artist}', [ArtistController::class, 'show_artist']);
Route::post('/save_comment', [CommentArtistController::class, 'save_comment'])->name('save_comment');

// TRACKS
Route::get('/track_chart', [TrackController::class, 'charts']);

//LOGIN
Route::get('/login', [AuthController::class, 'login']);
Route::post('/login_auth', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/registration', [UserController::class, 'form_register']);
Route::post('/register', [UserController::class, 'store_register']);

//LIKE SYSTEM
Route::get('/like_artist/{artist}', [LikeArtistController::class, 'like']);
Route::get('/unlike_artist/{artist}', [LikeArtistController::class, 'unlike']);

// SEARCH
Route::get('/search', [AlbumController::class, 'search']);