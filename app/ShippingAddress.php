<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    protected $table = 'shippingaddress';

    protected $fillable = ['user_id', 'receiver_name', 'phone_no', 'address', 'province_id', 'city_id', 'zipcode'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
