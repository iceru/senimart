<?php

namespace App;

use App\User;
use App\ShipingAddress;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    protected $table = 'shippingaddress';

    protected $fillable = ['receiver_name', 'phone_no', 'address', 'province_id', 'city_id', 'zipcode', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
