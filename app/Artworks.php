<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Artists;
use App\Category;

class Artworks extends Model
{
    protected $guarded = [];
    protected $table = 'artworks';

    public function artists()
    {
        return $this->belongsTo(Artists::class);
    }

    public function category() 
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter($a)
    {   
        if(request('category')) {
            $a->whereHas('category', function($q) {
                $q->where('slug', '=', request('category'));
            });
        }
              
        if (request('above_500')) {
            $a->where('price', '>=', request('above_500'));
        }
        
        if (request('under_500')) {
            $a->where('price', '<=', request('under_500'));
        }


        return $a;
    }
}
