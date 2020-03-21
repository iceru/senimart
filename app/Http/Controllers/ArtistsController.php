<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artists;
use App\Artworks;

class ArtistsController extends Controller
{
    public function index() {
        $artists = Artists::orderBy('name')->get();

        return view('artists', compact('artists'));
    }

    public function show($artist) {
        $artist = Artists::where('slug', $artist)->firstOrFail();
        $artworks = Artworks::where('artists_id', $artist->id)->get();
        return view('artistdetail', compact('artist', 'artworks'));
    }
}
