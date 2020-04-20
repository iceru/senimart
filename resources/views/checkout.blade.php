@extends('layouts.app')

@section('title')
Checkout - Senimart
@endsection

@section('content')
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