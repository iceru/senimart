<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Artworks;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class Artists extends Model
{
    protected $guarded = [];
    protected $table = 'artists';

    public function artworks()
    {
        return $this->hasMany(Artworks::class);
    }

    public function scopeFilter($a) {
        if(request('sortname')) {
            $a->where(\DB::raw('substr(lower(name), 1, 1)'), '=', request('sortname'));
        }

        return $a;
    }

}


