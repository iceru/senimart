<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
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
            'address_id' => '0'
        ]);

        $tweight = 0;

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

            $tweight = $tweight+$item->model->weight;

            $artworks = Artworks::find($item->id);
            $artworks->sales()->attach($sales, ['qty' => $item->qty]);
        }

        $sales = Sales::find($sid);
        $sales->totalweight = $tweight;
        $sales->save();

        return redirect()->action('SalesController@show', ['id' => $sid]);
    }

    public function show($checkout) {
        $id = Auth::id();
        $sales = Sales::where('id', $checkout)->firstOrFail();
        
        if($id == $sales->user_id) {

            $user = User::where('id', $id)->firstOrFail();

            //provinces
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
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
            
            $prov = json_decode($response);
            $provinces = $prov->rajaongkir->results;
            
            //cities
            // $curl = curl_init();

            // curl_setopt_array($curl, array(
            //   CURLOPT_URL => "https://api.rajaongkir.com/starter/city",
            //   CURLOPT_RETURNTRANSFER => true,
            //   CURLOPT_ENCODING => "",
            //   CURLOPT_MAXREDIRS => 10,
            //   CURLOPT_TIMEOUT => 30,
            //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //   CURLOPT_CUSTOMREQUEST => "GET",
            //   CURLOPT_HTTPHEADER => array(
            //     "key: d09963f00e691b1ade90ec2c14474cf5"
            //   ),
            // ));
            
            // $cities = curl_exec($curl);
            // $err = curl_error($curl);
            
            // curl_close($curl);
            
            // $city = json_decode($response);
            // $cities = $city->rajaongkir->results;

            // $checkoutItem = ArtworksSales::where('sales_id', $checkout)->get();
            $checkoutItem = Sales::with('artworks')->where('id', $checkout)->get();
            return view('checkout', compact('user', 'provinces', 'sales', 'checkoutItem'));
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
