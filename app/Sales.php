<?php

namespace App;

use App\User;
use App\Artworks;
use App\ShippingAddress;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $table = "sales";

    protected $fillable = ['id', 'user_id', 'totalPrice', 'totalweight', 'shipcost', 'status', 'snap_token', 'address_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shippingaddress()
    {
        return $this->belongsTo(ShippingAddress::class);
    }

    public function artworks()
    {
        return $this->belongsToMany(Artworks::class)->withPivot('sales_id', 'artworks_id', 'qty');
    }

    /**
     * Set status to Pending
     *
     * @return void
     */
    public function setPending()
    {
        $this->attributes['status'] = 'pending';
        self::save();
    }
 
    /**
     * Set status to Success
     *
     * @return void
     */
    public function setSuccess()
    {
        $this->attributes['status'] = 'success';
        self::save();
    }
 
    /**
     * Set status to Failed
     *
     * @return void
     */
    public function setFailed()
    {
        $this->attributes['status'] = 'failed';
        self::save();
    }
 
    /**
     * Set status to Expired
     *
     * @return void
     */
    public function setExpired()
    {
        $this->attributes['status'] = 'expired';
        self::save();
    }
}
