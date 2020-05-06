<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Midtrans;
use \Midtrans\Snap;
use \Midtrans\Transaction;
use App\Sales;
use App\Artworks;
use App\ShippingAddress;

class PaymentController extends Controller
{
    public function show($payment) {
      $id = Auth::id();

      $sales = Sales::where('id', $payment)->firstOrFail();
      
      // $totalPay = $sales->totalPrice+$sales->shipcost;
      
      if($id == $sales->user_id) {
        // if(!$sales->snap_token) {
        // $params = array(
        //   'transaction_details' => array(
        //   'order_id' => $payment,
        //   'gross_amount' => $totalPay,
        //   )
        // );
        
        // $snapToken = Snap::getSnapToken($params);
        // $sales = Sales::find($payment);
        // $sales->snap_token = $snapToken;
        // $sales->save();
        
        // $status = "";
        // }
        // else {
        //   $status = Transaction::status($payment);
        // }
        
        // $paymentItem = ArtworksSales::where('sales_id', $payment)->get();
        $paymentItem = Sales::with('artworks')->where('id', $payment)->get();
        
        $address = ShippingAddress::where('id', $sales->address_id)->firstOrFail();
        
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.rajaongkir.com/starter/city?id=".$address->city_id."&province=".$address->province_id,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: d09963f00e691b1ade90ec2c14474cf5"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        $result = json_decode($response);
        
        $address->province = $result->rajaongkir->results->province;
        $address->city = $result->rajaongkir->results->type." ".$result->rajaongkir->results->city_name;
        
        return view('payment', compact('sales', 'paymentItem', 'address'));
      }
      else {
        return redirect()->route('home');
      }
    }

    public function newPay(Request $request) {
      $id = Auth::id();
      $sales = Sales::where('id', $request->id)->firstOrFail();
      $totalPay = $sales->totalPrice+$sales->shipcost;

      if($id == $sales->user_id) {
        if(!$sales->snap_token) {
          $params = array(
            'transaction_details' => array(
            'order_id' => $request->id,
            'gross_amount' => $totalPay,
            )
          );
          
          $snapToken = Snap::getSnapToken($params);
          $sales = Sales::find($request->id);
          $sales->snap_token = $snapToken;
          $sales->save();
          
          $token = $sales->snap_token;
          $status = "";
        }
        else {
          $token = $sales->snap_token;
        }
        return $token;
      }
      else {
        return redirect()->route('home');
      }
    }

    public function cancel($orderId) {
      $sales = Sales::where('id', $orderId)->firstOrFail();

      if($sales->snap_token) {
        $cancel = Transaction::cancel($orderId);
      }

      return redirect()->route('sales.remove', $orderId);
    }

    public function notifHandler(Request $request) {
      $notif = new \Midtrans\Notification();
      \DB::transaction(function() use($notif) {

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $orderId = $notif->order_id;
        $fraud = $notif->fraud_status;
        $order = Sales::findOrFail($orderId);

        if ($transaction == 'capture') {

          // For credit card transaction, we need to check whether transaction is challenge by FDS or not
          if ($type == 'credit_card') {

            if($fraud == 'challenge') {
              // TODO set payment status in merchant's database to 'Challenge by FDS'
              // TODO merchant should decide whether this transaction is authorized or not in MAP
              // $order->addUpdate("Transaction order_id: " . $orderId ." is challenged by FDS");
              $order->setPending();
            } else {
              // TODO set payment status in merchant's database to 'Success'
              // $order->addUpdate("Transaction order_id: " . $orderId ." successfully captured using " . $type);
              $order->setSuccess();
            }

          }

        } elseif ($transaction == 'settlement') {

          // TODO set payment status in merchant's database to 'Settlement'
          // $order->addUpdate("Transaction order_id: " . $orderId ." successfully transfered using " . $type);
          $order->setSuccess();

        } elseif($transaction == 'pending'){

          // TODO set payment status in merchant's database to 'Pending'
          // $order->addUpdate("Waiting customer to finish transaction order_id: " . $orderId . " using " . $type);
          $order->setPending();

        } elseif ($transaction == 'deny') {

          // TODO set payment status in merchant's database to 'Failed'
          // $order->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is Failed.");
          $order->setFailed();

        } elseif ($transaction == 'expire') {

          // TODO set payment status in merchant's database to 'expire'
          // $order->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is expired.");
          $order->setExpired();

        } elseif ($transaction == 'cancel') {

          // TODO set payment status in merchant's database to 'Failed'
          // $order->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is canceled.");
          $order->setFailed();

        }

      });

      return;
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
