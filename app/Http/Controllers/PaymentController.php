<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Midtrans\Snap;
use App\Sales;
use App\Artworks;
use App\ArtworksSales;

class PaymentController extends Controller
{
    public function show($payment) {
        $id = Auth::id();

        $sales = Sales::where('id', $payment)->firstOrFail();
        
        if($id == $sales->user_id) {
            $params = array(
                'transaction_details' => array(
                    'order_id' => $payment,
                    'gross_amount' => $sales->totalPrice,
                )
            );
            
            $snapToken = Snap::getSnapToken($params);
            $sales = Sales::find($payment);
            $sales->snap_token = $snapToken;
            $sales->save();

            $paymentItem = ArtworksSales::where('sales_id', $payment)->get();
            return view('payment', compact('sales', 'paymentItem'));
        }
        else {
            return redirect()->route('home');
        }
    }

    // public function store() {
    //     // Buat transaksi ke midtrans kemudian save snap tokennya.
    //     $payload = [
    //         'transaction_details' => [
    //             'order_id'      => $this->request->orderId,
    //             'gross_amount'  => $this->request->amount,
    //         ]
    //     ];
    //     $snapToken = Veritrans_Snap::getSnapToken($payload);
        
    //     $sales = Sales::find($sid);
    //     $sales->snap_token = $snapToken;
    //     $sales->save();

    //     // Beri response snap token
    //     $this->response['snap_token'] = $snapToken;
 
    //     return response()->json($this->response);
    // }
}
