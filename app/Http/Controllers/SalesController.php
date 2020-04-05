<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Sales;
use App\ArtworksSales;
use Gloudemans\Shoppingcart\Facades\Cart;

class SalesController extends Controller
{
    public function checkout() {
        
        $userid = Auth::id();
        $sid = $userid.time();

        Sales::create([
            'id' => $sid,
            'user_id' => $userid,
            'paid' => '0',
            'totalPrice' => 0
        ]);

        foreach(Cart::content() as $item) {
            $data = array(
                'sales_id' => $sid,
                'artworks_id' => $item->id,
                'qty' => $item->qty
            );
            ArtworksSales::insert($data);
        }
    }
}
