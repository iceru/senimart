<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Sales;
use App\Artworks;
use App\ArtworksSales;

class PaymentController extends Controller
{
    public function show($payment) {
        $id = Auth::id();

        $sales = Sales::where('id', $payment)->firstOrFail();
        
        if($id == $sales->user_id) {
            $paymentItem = ArtworksSales::where('sales_id', $payment)->get();
            return view('payment', compact('sales', 'paymentItem'));
        }
        else {
            return redirect()->route('home');
        }
    }
}
