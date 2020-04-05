<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function artworks()
    {
        return $this->belongsToMany('App\Artworks');
    }
}
