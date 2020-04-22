<?php

namespace App;

use App\Sales;
use App\Colors;
use App\Artists;
use App\Category;
use Illuminate\Database\Eloquent\Model;

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

    public function color() 
    {
        return $this->belongsTo(Colors::class);
    }

    public function sales()
    {
        return $this->belongsToMany(Sales::class);
    }

    public function scopeFilter($a)
    {   
        if(request('category')) {
            $a->whereHas('category', function($q) {
                $q->where('slug', '=', request('category'));
            });
        }

        if(request('color')) {
            $a->whereHas('color', function($q) {
                $q->where('name', '=', request('color'));
            });
        }
              
        if (request('price') == 'above500') {
            $a->where('price', '>=', 500000);
        }

        if (request('price') == 'under500') {
            $a->where('price', '<=', 500000);
        }

        return $a;
    }
}
