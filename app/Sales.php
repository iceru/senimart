<?php

namespace App;

use App\User;
use App\Artworks;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $table = "sales";

    protected $fillable = ['id', 'user_id', 'totalPrice', 'address', 'status', 'snap_token'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function artworks()
    {
        return $this->belongsToMany(Artworks::class);
    }
}
