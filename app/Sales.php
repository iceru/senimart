<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $table = "sales";

    protected $fillable = ['id', 'user_id', 'paid', 'totalPrice', 'address'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function artworksSales()
    {
        return $this->hasMany('App\ArtworksSales');
    }
}
