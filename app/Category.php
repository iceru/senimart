<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Artworks;

class Category extends Model
{
    protected $table = 'category';
    protected $guarded = [];

    public function artworks()
    {
        return $this->hasMany(Artworks::class);
    }
}
