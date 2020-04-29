@extends('layouts.app')

@section('title')
Senimart - Artworks
@endsection

@section('content')
<section class="profile">
    <div class="alert">
        @if (session()->has('success_message'))

        <div class="alert-success">
            {{ session()->get('success_message') }}
        </div>
        @endif

        @if(count($errors) > 0)
        <div class="alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    <div class="flex-profile">
        <div class="sidebar" id="sidebar">
            <div class="category">
                <a href="{{ route('profile.edit') }}">
                    <h1>My Profile</h1>
                </a>
                <hr>
            </div>

            <div class="category">
                <a href="{{ route('address.index') }}">
                    <h1>Address</h1>
                </a>
                <hr>
            </div>

            <div class="orders">
                <a href="{{ route('orders.index') }}">
                    <h1>Orders</h1>
                </a>
                <hr>
            </div>

            <div class="wishlist">
                <h1>Wishlist</h1>
                <hr>
            </div>
        </div>
        <div class="profile-content">
            <a class="button-black" href="{{ route('address.new') }}">New Address</a>
            <hr>
            @foreach ($address as $ad)
            <div class="row">
                <div class="col">
                    <h5><strong>Address #{{ $loop->iteration }}</strong></h5>
                </div>
                <div class="col" style="text-align: right">
                    <a href="{{ route('address.update', $ad->id) }}">Edit</a> |
                    <a href="{{ route('address.delete', $ad->id) }}">Delete</a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h5>Full Name</h5>
                    <p>{{ $ad->receiver_name }}</p>
                </div>
                <div class="col">
                    <h5>Mobile Phone</h5>
                    <p>{{ $ad->phone_no }}</p>
                </div>
                <div class="col">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h5>Address</h5>
                    <p>{{ $ad->address }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h5>Province</h5>
                    <p>{{ $ad->province }}</p>
                </div>
                <div class="col">
                    <h5>City</h5>
                    <p>{{ $ad->city }}</p>
                </div>
                <div class="col">
                    <h5>Zip</h5>
                    <p>{{ $ad->zipcode }}</p>
                </div>
            </div>
            <hr>
            @endforeach
        </div>
    </div>
</section>
@endsection

</html>