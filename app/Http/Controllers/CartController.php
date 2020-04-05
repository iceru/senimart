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

        $itemwish = Cart::instance('wishlist')->search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->id === $request->id;
        });

        $rows  = Cart::instance('wishlist')->content();
        // $rowId = $rows->where('id', $request->id)->first()->rowId;

        // if ($itemwish->isNotEmpty()) {
        //     Cart::instance('wishlist')->remove($rowId);
        // }

        return redirect()->route('cart.index')->with('success_message', 'Item was added to your cart');
    }

    public function destroy($id)
    {
        Cart::remove($id);

        return back()->with('success_message', 'Item has been removed');
    }

    public function wishindex()
    {
        return view('wishlist');
    }

    public function wishlist($id)
    {
        // $item = Cart::get($id);

        // Cart::remove($id);
        $duplicates = Cart::instance('wishlist')->search(function ($cartItem, $rowId) use ($id) {
            return $cartItem->id === $id;
        });

        if ($duplicates->isNotEmpty()) {
            return redirect()->route('cart.wishindex')->with('success_message', 'Item is already in your Wishlist!');
        }

        $artwork = Artworks::where('id', $id)->firstOrFail();

        Cart::instance('wishlist')->add($artwork->id, $artwork->title, 1, $artwork->price)
        ->associate('App\Artworks');

        return redirect()->route('cart.wishindex')->with('success_message', 'Item has added to your Wishlist');

    }

    public function rmwish($id)
    {
        Cart::instance('wishlist')->remove($id);

        return back()->with('success_message', 'Item has been removed');
    }
}