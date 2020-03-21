<?php

namespace App\Http\Controllers;

use App\Artists;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class AdminArtistsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artists = Artists::all();
        return view('admin.artists.index', compact('artists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.artists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $artist = Artists::create($this->validateRequest());

        $this->storePhoto($artist);

        return redirect('admin/artists');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Artists  $artists
     * @return \Illuminate\Http\Response
     */
   // public function show(Artists $artists)
 //   {
        //
  //  }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Artists  $artists
     * @return \Illuminate\Http\Response
     */
    public function edit(Artists $artist)
    {
        return view('admin.artists.edit', compact('artist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Artists  $artists
     * @return \Illuminate\Http\Response
     */
    public function update(Artists $artist)
    {
        $artist->update($this->validateRequest());

        $this->storePhoto($artist);

        return redirect('admin/artists');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Artists  $artists
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artists $artist)
    {
        $artist->delete();

        return redirect('admin/artists');
    }

    private function validateRequest() 
    {
        return request()->validate([
            'name' => 'required',
            'biography' => 'required',
            'yearbirth' => 'required',
            'hometown' => 'required',
            'photo' => 'required|file|image|max:10000',
        ]);
    }

    private function storePhoto($artist)
    {
        if (request()->has('photo')) {
            $artist->update([
                'photo' => request()->photo->store('uploads', 'public'),
            ]);

            $image = Image::make(public_path('storage' . $customer->image))->resize(500, null, 
            function ($constraint) 
            {
                $constraint->aspectRatio();
            });
            $image->save();
        }
    }
}
