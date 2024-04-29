<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Add new genre to database
     */
    public function add_genre(Request $request)
    {
        $request->validate([
            'name_genre' => 'required'
        ]);

        $genre_exist = Genre::where('name', $request->name_genre)->first();

        if ($genre_exist != null) {
            return redirect()->back()->with('error_genre', 'Genre already exists');
        }

        Genre::create(
            [
                'name' => $request->name_genre
            ]
        );
        return redirect()->back();
    }
}
