<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artists;
use App\Artworks;
use App\Category;

class HomeController extends Controller
{  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $artists = Artists::take(3)->get();
        $featured = Artworks::take(3)->get();
        $artworks = Artworks::all();
        return view('home', [
            'featured'=>$featured,
            'artists'=>$artists,
            'artworks'=>$artworks,
        ]);
    }
}

