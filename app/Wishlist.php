<?php

namespace App;

use App\User;
use App\Artworks;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    public function users() 
    {
        return $this->belongsTo(User::class);
    }

    public function artworks() 
    {
        return $this->belongsTo(Artworks::class);
    }
}
