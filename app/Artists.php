<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Artworks;
use Illuminate\Support\Str;

class Artists extends Model
{
    protected $guarded = [];
    protected $table = 'artists';

    public function artworks()
    {
        return $this->hasMany(Artworks::class);
    }
}


