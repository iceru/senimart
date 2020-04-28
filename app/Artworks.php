<?php

namespace App;

use App\Sales;
use App\Colors;
use App\Artists;
use App\Category;
use App\Wishlist;
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
        return $this->belongsToMany(Sales::class)->withPivot('sales_id', 'artworks_id', 'qty');
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
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

        if(request('sort') == 'low_high') {
            $a = $a->orderBy('price');
        }

        if(request('sort') == 'high_low') {
            $a = $a->orderBy('price', 'DESC');
        }

        if(request('sort') == 'newest_oldest') {
            $a = $a->orderBy('year', 'DESC');
        }

        return $a;
    }
}
