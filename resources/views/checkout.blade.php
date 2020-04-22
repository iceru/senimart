@extends('layouts.app')

@section('content')
<div class="checkout">
    <div class="title-checkout">
        <h1>Checkout</h1>
        <p>Order ID: {{$sales->id}}</p>
        <hr>
    </div>
    <div class="data-input">
        <h1 class="os">Billing Address</h1>
        <div class="form-group">
            <label for="">Full Name</label>
            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
        </div>
        <div class="form-group">
            <label for="">Mobile Phone</label>
            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
        </div>
        <div class="form-group">
            <label for="">Address</label>
            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
        </div>
        <div class="form-group">
            <label for="">State</label>
            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
        </div>
        <div class="form-row">
            <div class="col">
                <label for="">City</label>
                <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
            </div>
            <div class="col">
                <label for="">Zip</label>
                <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
            </div>

        </div>
    </div>

    <div class="item-checkout">
        <h1 class="os">Order Summary</h1>
        @foreach ($checkoutItem as $item)
        <div class="product-item">
            <div class="detail-image">
                <a href="{{route('artworks.show', $item->artworks->slug)}}"><img
                        src="{{ asset('storage/'.$item->artworks->image) }}" alt=""></a>
            </div>
            <div class="detail-text">
                <a href="{{route('artworks.show', $item->artworks->slug)}}">
                    <h2>{{$item->artworks->title}}</h2>
                </a>
                <h3>{{$item->artworks->artists->name}}</h3>
                <p>{{$item->artworks->category->name}}</p>
                <p> {{$item->artworks->sizeHeight}} (H) / {{$item->artworks->sizeWidth}} (W)</p>
            </div>
            <div class="price">
                <h2>Rp.{{$item->artworks->price}}</h2>
                <h3>Quantity : {{$item->qty}}</h3>
            </div>
        </div>
        <hr>
        @endforeach
        <div class="total">
            <h2>Total Price : Rp.{{$item->sales->totalPrice}}</h2>
        </div>
        <a class="button-black" href="">Proceed to Payment</a>
        <a href="/checkout/remove/{{$sales->id}}" class="button-list-black">Cancel</a>
    </div>
</div>
@endsection