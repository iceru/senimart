<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artworks;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cart');
    }

    public function store(Request $request)
    {
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($request){
            return $cartItem->id === $request->id;
        });

        if ($duplicates->isNotEmpty()) {
            return redirect()->route('cart.index')->with('success_message', 'Item is already in your cart!');
        }

        Cart::add($request->id, $request->title, 1, $request->price)
        ->associate('App\Artworks');

        return redirect()->route('cart.index')->with('success_message', 'Item was added to your cart');
    }

    public function destroy($id)
    {
        Cart::remove($id);

        return back()->with('success_message', 'Item has been removed');
    }

    // public function wishlist($id)
    // {
    //     $item = Cart::get($id);

    //     Cart::remove($id);

    //     Cart::instance('wishlist')->add($item->id, $item->title, 1, $item->price)
    //     ->associate('App\Artworks');

    //     return redirect()->route('cart.index')->with('success_message', 'Item has added to your Wishlist');

    // }
}