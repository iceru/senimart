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
                <a href="{{ route('wishlist.index') }}">
                    <h1>Wishlist</h1>
                </a>
                <hr>
            </div>
        </div>
        <div class="profile-content">
            @foreach ($wishlists as $wishlist)
            <div class="order-item">
                <img src="{{ asset('storage/'. $wishlist->artworks->image) }}" alt="">
                <div class="order-text">
                    <h3>{{ $wishlist->artworks->title }}</h3>
                    <h5>{{ $wishlist->artworks->artists->name }}</h5>
                    <p>{{ $wishlist->artworks->category->name }}</p>
                </div>
                <div class="wish-to-cart">
                    <h3>Rp.{{ $wishlist->artworks->price }}</h3>
                    <form class="form-cart" action="{{route('cart.store')}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$wishlist->artworks->id}}">
                        <input type="hidden" name="title" value="{{$wishlist->artworks->title}}">
                        <input type="hidden" name="price" value="{{$wishlist->artworks->price}}">
                        <button type="submit" class="button-black">
                            Add to Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        </button>
                    </form>
                    <form action="{{ route('wishlist.destroy', $wishlist->id) }}" method="get">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="button-black">Remove</button>
                    </form>
                </div>
            </div>
            <hr>
            @endforeach
        </div>
    </div>
</section>
@endsection



</html>