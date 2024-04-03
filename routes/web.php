<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\TrackController;

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

// TRACKS
Route::get('/track_chart', [TrackController::class, 'charts']);
