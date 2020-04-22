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
            @foreach ($orders as $order)
            <h2>{{ $order->id }}</h2>
            <p>Rp{{ $order->totalPrice }}</p>

            @foreach ($order->artworks as $artwork)
            <h2>{{ $artwork->title }}</h2>
            <h2><img src="{{ asset($artwork->image) }}" alt=""></h2>
            @endforeach
            @endforeach
        </div>
    </div>
</section>
@endsection



</html>