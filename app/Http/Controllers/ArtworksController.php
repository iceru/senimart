<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artworks;
use App\Category;

class ArtworksController extends Controller
{
    public function index(){

        $artworks = Artworks::filter()->paginate(10);
        $categories = Category::all();

        return view('artworks', compact('artworks', 'categories'));
    }

    public function show($artwork) {
        $artwork = Artworks::where('slug', $artwork)->firstOrFail();
        $similiars = Artworks::where('category_id', $artwork->category->id)->where('id', '!=', $artwork->id)->get();
        
        return view('artworksdetail', compact('artwork', 'similiars'));
    }  
}
