<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artworks;
use App\Category;
use App\Colors;

class ArtworksController extends Controller
{
    public function index(){
        if(request('category')) {
            $categories = Category::all();
            $categoryName = $categories->where('slug', request('category'))->first()->name;
        }

        else {
            $categories = Category::all();
            $categoryName = 'Artworks on All Category';
        }
        
        if(request('color')) {
            $colors = Colors::all();
            $colorName = $colors->where('name', request('color'))->first()->name;
        }

        else {
            $colors = Colors::all();
            $colorName = '';
        }

        if (request('price') == 'above500') {
           $priceName = 'Above 500$';
        }

        elseif (request('price') == 'under500') {
            $priceName = 'Under 500$';
        }

        else {
            $priceName = '';
        }
        

        $artworks = Artworks::filter()->paginate(10);
       
        return view('artworks', compact('artworks', 'categories', 'colors', 'categoryName', 'colorName', 'priceName'));
    }

    public function show($artwork) {
        $artwork = Artworks::where('slug', $artwork)->firstOrFail();
        $related = Artworks::where('artists_id', $artwork->artists->id)->where('id', '!=', $artwork->id)->get();
        
        return view('artworksdetail', compact('artwork', 'related'));
    }  

    public function search(Request $request) {
        $query = $request->input('query');
        $artworks = Artworks::where('title', 'like', "%$query%")->paginate(10);

        return view('searchpage')->with('artworks', $artworks);
    }
}
