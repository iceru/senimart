<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artworks;
use App\Category;
use App\Colors;

class ArtworksController extends Controller
{
    public function index(){

        $artworks = Artworks::filter()->paginate(10);
        $categories = Category::all();
        $colors = Colors::all();

        return view('artworks', compact('artworks', 'categories', 'colors'));
    }

    public function show($artwork) {
        $artwork = Artworks::where('slug', $artwork)->firstOrFail();
        $similiars = Artworks::where('category_id', $artwork->category->id)->where('id', '!=', $artwork->id)->get();
        
        return view('artworksdetail', compact('artwork', 'similiars'));
    }  

    public function search(Request $request) {
        return view('searchpage');
    }
}
