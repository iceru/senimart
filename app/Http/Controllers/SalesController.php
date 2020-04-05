<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Sales;
use App\Artworks;
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
            'totalPrice' => Cart::subtotal(0,'','')
        ]);

        foreach(Cart::content() as $item) {
            $data = array(
                'sales_id' => $sid,
                'artworks_id' => $item->id,
                'qty' => $item->qty
            );
            ArtworksSales::insert($data);
        }

        return redirect()->action('SalesController@show', ['id' => $sid]);
    }

    public function show($checkout) {
        $sales = Sales::where('id', $checkout)->firstOrFail();
        $checkoutItem = ArtworksSales::where('sales_id', $checkout)->get();
        return view('checkout', compact('sales', 'checkoutItem'));
    }

    public function destroy($checkout) {
        ArtworksSales::where('sales_id', $checkout)->delete();
        Sales::find($checkout)->delete();
        return redirect()->route('home');
    }
}
