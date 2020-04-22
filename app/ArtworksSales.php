<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtworksSales extends Model
{
    protected $table = "artworks_sales";

    protected $fillable = ['sales_id', 'artworks_id', 'qty'];

    public function sales()
    {
        return $this->belongsTo('App\Sales');
    }

    public function artworks()
    {
        return $this->belongsTo('App\Artworks');
    }
}
