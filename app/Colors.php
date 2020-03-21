<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Artworks;

class Colors extends Model
{
    protected $guarded = [];

    public function artworks()
    {
        return $this->hasMany(Artworks::class);
    }

}
