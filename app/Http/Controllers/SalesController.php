<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Sales;
use App\Artworks;
// use App\ArtworksSales;
use Gloudemans\Shoppingcart\Facades\Cart;

class SalesController extends Controller
{

    public function checkout() {
        
        $userid = Auth::id();
        $sid = $userid.time();

        Sales::create([
            'id' => $sid,
            'user_id' => $userid,
            'totalPrice' => Cart::subtotal(0,'',''),
            'address' => ''
        ]);

        foreach(Cart::content() as $item) {
            // $data = array(
            //     'sales_id' => $sid,
            //     'artworks_id' => $item->id,
            //     'qty' => $item->qty
            // );
            // ArtworksSales::insert($data);

            $sales = new Sales;
            $sales->id = $sid;
            // $sales->qty = $item->qty;

            $artworks = Artworks::find($item->id);
            $artworks->sales()->attach($sales, ['qty' => $item->qty]);
        }

        return redirect()->action('SalesController@show', ['id' => $sid]);
    }

    public function show($checkout) {
        $id = Auth::id();

        $sales = Sales::where('id', $checkout)->firstOrFail();
        
        if($id == $sales->user_id) {
            // $checkoutItem = ArtworksSales::where('sales_id', $checkout)->get();
            $checkoutItem = Sales::with('artworks')->where('id', $checkout)->get();
            return view('checkout', compact('checkoutItem'));
        }
        else {
            return redirect()->route('home');
        }
        
    }

    public function destroy($checkout) {
        Sales::find($checkout)->artworks()->detach();
        Sales::find($checkout)->delete();
        return redirect()->route('home');
    }

    public function address($sid, Request $request) {
        $this->validate($request, [
            'address' => 'required'
        ]);

        $sales = Sales::find($sid);
        $sales->address = $request->address;
        $sales->save();
        return redirect()->action('PaymentController@show', ['id' => $sid]);
    }
}
