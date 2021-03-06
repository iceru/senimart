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
        $artists = Artists::take(4)->get();
        $featured = Artworks::where('featured', 'option1')->take(3)->get();

        $artworks = Artworks::take(8)->get();
        return view('home', [
            'featured'=>$featured,
            'artists'=>$artists,
            'artworks'=>$artworks,
        ]);
    }
}

