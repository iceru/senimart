<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Steevenz\Rajaongkir;
use App\ShippingAddress;
use App\Sales;
use App\User;

class ShippingController extends Controller
{
    public function checkCost(Request $request) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=153&destination=".$request->id."&weight=".$request->weight."&courier=jne",
            CURLOPT_HTTPHEADER => array(
              "content-type: application/x-www-form-urlencoded",
              "key: d09963f00e691b1ade90ec2c14474cf5"
            ),
          ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);

        $cost = json_decode($response);
        $costs = $cost->rajaongkir->results[0]->costs;
        // $city = json_decode($response);
        // $cities = $city->rajaongkir->results;

        return $costs;
    }

    public function addAddress(Request $request) {
        $userid = Auth::id();
        
        // $users = User::find($userid);
        $sales = Sales::find($request->sid);
        $sales->address_id = $request->address_select;
        $sales->save();
        
        // if($sales->user->address_id) {
          //   $shippingAddress = ShippingAddress::find($sales->user->address_id)->firstOrFail();
          //   $shippingAddress->receiver_name = $request->receiver_name;
          //   $shippingAddress->phone_no = $request->phone_no;
          //   $shippingAddress->address = $request->address;
          //   $shippingAddress->province_id = $request->province_id;
          //   $shippingAddress->city_id = $request->city_id;
          //   $shippingAddress->zipcode = $request->zipcode;
          
          //   $shippingAddress->save();
          
          // }
          // else {
            //   $shippingAddress = new ShippingAddress;
            //   $shippingAddress->receiver_name = $request->receiver_name;
            //   $shippingAddress->phone_no = $request->phone_no;
            //   $shippingAddress->address = $request->address;
            //   $shippingAddress->province_id = $request->province_id;
            //   $shippingAddress->city_id = $request->city_id;
            //   $shippingAddress->zipcode = $request->zipcode;
            
            //   $shippingAddress->save();
            
            //   $users->address_id = $shippingAddress->id;
            //   $users->save();
            // }
            
        $shippingAddress = ShippingAddress::where('id', $request->address_select)->firstOrFail();

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.rajaongkir.com/starter/city?id=".$shippingAddress->city_id."&province=".$shippingAddress->province_id,
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

        $shippingAddress->province = $result->rajaongkir->results->province;
        $shippingAddress->city = $result->rajaongkir->results->type." ".$result->rajaongkir->results->city_name;

        return response()->json($shippingAddress);
    }

    public function addShipCost(Request $request) {
        $sales = Sales::find($request->sid);
        $sales->shipcost = $request->cost;
        $sales->save();
    }

    public function addShip() {
        // $config['api_key'] = 'd09963f00e691b1ade90ec2c14474cf5';
        // $config['account_type'] = 'starter';

        // $rajaongkir = new Rajaongkir($config);

        // $provinces = $rajaongkir->getProvinces();

        // print_r($provinces);

        $curl = curl_init();
        $c = '153';

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "origin=501&destination=".$c."&weight=1000&courier=jne",
          CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: d09963f00e691b1ade90ec2c14474cf5"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
            // echo $response;
            $cost = json_decode($response);
            $costs = $cost->rajaongkir->results[0]->costs;

            print_r($costs);

            // foreach($cost->rajaongkir->results[0]->costs as $ongkir) {
            //     echo $ongkir->service.' = '.$ongkir->cost[0]->value.'<br>';
            // }
        }



        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //   CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
        //   CURLOPT_RETURNTRANSFER => true,
        //   CURLOPT_ENCODING => "",
        //   CURLOPT_MAXREDIRS => 10,
        //   CURLOPT_TIMEOUT => 30,
        //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //   CURLOPT_CUSTOMREQUEST => "GET",
        //   CURLOPT_HTTPHEADER => array(
        //     "key: 1a4dc526c65fb87efb194a939484e9e5"
        //   ),
        // ));
        
        // $response = curl_exec($curl);
        // $err = curl_error($curl);
        
        // curl_close($curl);
        
        // if ($err) {
        //   echo "cURL Error #:" . $err;
        // } else {
        //   $prov = json_decode($response);
        //   foreach($prov->rajaongkir->results as $p) {
        //       echo $p->province_id.'-'.$p->province."<br>";
        //   }
        // }
    }
}
