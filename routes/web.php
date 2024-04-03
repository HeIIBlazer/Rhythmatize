<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ArtistController;

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
// Route::get('/albums', [AlbumController::class, 'index']);
Route::get('/', [AlbumController::class, 'top_3_albums']);
Route::get('/album_list', [AlbumController::class, 'index']);


// ARTISTS

Route::get('/artist_list', [ArtistController::class, 'index']);
// Route::get('/', [ArtistController::class, 'top_3_artists']);
