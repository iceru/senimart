@extends('layouts.app')

@section('content')
<div class="cart">

    <h1>Checkout</h1>
    <h4>Order ID: {{$sales->id}}</h4>
    <hr>
    @foreach ($checkoutItem as $item)
    <div class="cart-product">
        <div class="cart-img">
            <a href="{{route('artworks.show', $item->artworks->slug)}}"><img
                    src="{{ asset('storage/'.$item->artworks->image) }}" alt=""></a>
        </div>
        <div class="cart-detail">
            <a href="{{route('artworks.show', $item->artworks->slug)}}">
                <h1>{{$item->artworks->title}}</h1>
            </a>
            <h3>{{$item->artworks->artists->name}}</h3>
            <p>{{$item->artworks->category->name}}</p>
            <p> {{$item->artworks->sizeHeight}} (H) / {{$item->artworks->sizeWidth}} (W)</p>
        </div>
        <div class="cart-price">
            <h1>Rp.{{$item->artworks->price}}</h1>
            <h3>Quantity : {{$item->qty}}</h3>
        </div>
    </div>
    @endforeach

    <hr>
    <div class="total">
        <h1>Total Price : Rp.{{$item->sales->totalPrice}}</h1>
    </div>
    <hr>
    <h2>Shipping Address</h2>
    <form method="post" action="{{route('sales.address', $sales->id)}}">
    @csrf
    @method('PUT')
    <textarea name="address" rows="4" cols="40">{{$sales->address}}</textarea>
    <hr>
    <div class="total">
        <div class="cart-button">
            <a href="/checkout/remove/{{$sales->id}}" class="button">Cancel</a>
            <!-- <a href="" class="button">Confirm</a> -->
            <input type="submit" value="Confirm">
            </form> 
        </div>
        
<div class="checkout">
    <div class="data-input">
        <h1 class="os">Billing Address</h1>
        <div class="form-group">
            <label for="">First Name</label>
            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
        </div>
        <div class="form-group">
            <label for="">Last Name</label>
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
        <div class="product-item">
            <div class="detail-image">
                <img src="/image/similiar1.png" alt="">
            </div>
            <div class="detail-text">
                <h2>Title Art</h2>
                <h3>Artists</h3>
                <p>Category</p>
                <p>Size</p>
            </div>
            <div class="price">
                <h2>Price</h2>
            </div>
        </div>
        <hr>
        <div class="product-item">
            <div class="detail-image">
                <img src="/image/similiar1.png" alt="">
            </div>
            <div class="detail-text">
                <h2>Title Art</h2>
                <h3>Artists</h3>
                <p>Category</p>
                <p>Size</p>
            </div>
            <div class="price">
                <h2>Price</h2>
            </div>
        </div>
        <hr>
        <a class="button-black" href="">Proceed to Payment</a>
</div>
</div>
@endsection