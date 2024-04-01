<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AlbumController;

class DashboardController extends Controller
{
    

    public function main()
    {
        $albumController = new AlbumController();
        
        $lastAddedAlbums = $albumController->last_added_3();
        $topAlbums = $albumController->top_3_albums();

        return view('main', compact('lastAddedAlbums','topAlbums'));
    }
}
