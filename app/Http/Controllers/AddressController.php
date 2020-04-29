<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\ShippingAddress;
use App\Sales;
use App\User;

class AddressController extends Controller
{
    public function index() {
        $userid = Auth::id();

        // $checkoutItem = Sales::with('artworks')->where('id', $checkout)->get();
        $address = ShippingAddress::where('user_id', $userid)->get();

        foreach($address as $a) {
            $curl = curl_init();
    
            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api.rajaongkir.com/starter/city?id=".$a->city_id."&province=".$a->province_id,
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
    
            $a->province = $result->rajaongkir->results->province;
            $a->city = $result->rajaongkir->results->type." ".$result->rajaongkir->results->city_name;
        }

        return view('address', compact('address'))->with('user', auth()->user());;
    }

    public function findCity(Request $request) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=".$request->id,
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

        $city = json_decode($response);
        $cities = $city->rajaongkir->results;

        return $cities;
    }

    public function new() {
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

        return view('newAddress', compact('provinces'))->with('user', auth()->user());
    }

    public function add(Request $request) {
        $userid = Auth::id();

        $shippingAddress = new ShippingAddress;
        $shippingAddress->receiver_name = $request->receiver_name;
        $shippingAddress->phone_no = $request->phone_no;
        $shippingAddress->address = $request->address;
        $shippingAddress->province_id = $request->province_id;
        $shippingAddress->city_id = $request->city_id;
        $shippingAddress->zipcode = $request->zipcode;
        $shippingAddress->user_id = $userid;

        $shippingAddress->save();

        $route = Route::currentRouteName();
        // echo $route;
        
        if($route == 'address.add') {
            return redirect('/user/address')->with('user', auth()->user());
        }
        elseif($route == 'address.checkoutadd') {
            $sid = $request->id_sales;
            return redirect()->action('SalesController@show', ['id' => $sid]);
        }
        
        
    }

    public function delete($request) {
        ShippingAddress::find($request)->delete();
        return redirect('/user/address')->with('user', auth()->user());
    }
}
