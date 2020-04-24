@extends('layouts.app')

@section ('title')
Senimart - Payment
@endsection

@section('content')
<div class="checkout">
    <div class="title-checkout">
        <h1>Payment</h1>
        <p>Order ID: {{$sales->id}}</p>
        <hr>
    </div>
    <div class="data-input">
        <h1 class="os">Shipping Address</h1>
        <form id="addressForm">
            <h5>Full Name</h5>
                <p>{{$address->receiver_name}}</p>
            <h5>Mobile Phone</h5>
                <p>{{$address->phone_no}}</p>
            <h5>Address</h5>
                <p>{{$address->address}}</p>
            <h5>Province</h5>
                <p>{{$address->province}}</p>
            <h5>City</h5>
                <p>{{$address->city}}</p>
            <h5>Zip</h5>
                <p>{{$address->zipcode}}</p>
        </form>
    </div>
    <div class="item-checkout">
        <h1 class="os">Order Summary</h1>
        @foreach ($paymentItem->first()->artworks as $item)
        <div class="product-item">
            <div class="detail-image">
                <a href="{{route('artworks.show', $item->slug)}}"><img
                        src="{{ asset('storage/'.$item->image) }}" alt=""></a>
            </div>
            <div class="detail-text">
                <a href="{{route('artworks.show', $item->slug)}}">
                    <h2>{{$item->title}}</h2>
                </a>
                <h3>{{$item->artists->name}}</h3>
                <p>{{$item->category->name}}</p>
                <p>{{$item->weight}}g</p>
                <p> {{$item->sizeHeight}} (H) / {{$item->sizeWidth}} (W)</p>
            </div>
            <div class="price">
                <h2>Rp.{{$item->price}}</h2>
                <h3>Quantity : {{$item->pivot->qty}}</h3>
            </div>
        </div>
        <hr>
        @endforeach
        <div class="total">
            <p id="subtotal">Item(s) Subtotal : Rp.{{$sales->totalPrice}}</p>
            <p id="shipcost">Shipping Cost : Rp.{{$sales->shipcost}}</p>
            <h2 id="totalprice">Total Price : Rp.{{$sales->totalPrice+$sales->shipcost}}</h2>
        </div>
        {{-- <a class="button-black" href="">Proceed to Payment</a>
        <a href="/checkout/remove/{{$sales->id}}" class="button-list-black">Cancel</a> --}}
    
        <hr>
        <button class="button-black" id="pay-button">Pay</button>
        <a href="/checkout/{{$sales->id}}" class="button-list-black">Cancel</a>
        <pre><div id="result-json">JSON result will appear here after payment:<br></div></pre>
    </div>
</div>

<script src="{{ !config('services.midtrans.isProduction') ? 'https://app.sandbox.midtrans.com/snap/snap.js' : 'https://app.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function(){
    // SnapToken acquired from previous step
    snap.pay('{{ $sales->snap_token }}', {
        // Optional
        onSuccess: function(result){
        /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        },
        // Optional
        onPending: function(result){
        /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        },
        // Optional
        onError: function(result){
        /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        }
    });
    };
</script>
@endsection