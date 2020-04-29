@extends('layouts.app')

@section ('title')
Senimart - Cart
@endsection

@section('content')
<div class="cart">
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

    @if (Cart::count() > 0)

    <h1>Cart</h1>
    <p id="text-line">{{ Cart::count() }} Item(s) in Cart</p>
    <hr>
    @foreach (Cart::content() as $item)
    <div class="cart-product">
        <div class="cart-img">
            <a href="{{route('artworks.show', $item->model->slug)}}"><img
                    src="{{ asset('storage/'.$item->model->image) }}" alt=""></a>
        </div>
        <div class="cart-detail">
            <a href="{{route('artworks.show', $item->model->slug)}}">
                <h1>{{$item->model->title}}</h1>
            </a>
            <h3>{{$item->model->artists->name}}</h3>
            <p>{{$item->model->category->name}}</p>
            <p>{{$item->model->weight}}g</p>
            <p> {{$item->model->sizeHeight}} (H) / {{$item->model->sizeWidth}} (W)</p>
        </div>
        <div class="cart-price">
            <h1>Rp.{{$item->model->price}}</h1>
            <h3>Quantity : {{$item->qty}}</h3>
            <form action="{{route('cart.destroy', $item->rowId)}}" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="button-list-black">Remove</button>
            </form>

            <form action="{{ route('wishlist.store') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="artworks_id" value="{{$item->id}}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <button type="submit" class="button-list-black">
                    Wishlist <i class="fa fa-heart" aria-hidden="true"></i>
                </button>
            </form>
            {{-- 
            <form action="{{route('cart.wishlist', $item->rowId)}}" method="post">
            {{ csrf_field() }}

            <button type="submit" class="button">Add to Wishlist</button>
            </form> --}}
        </div>
    </div>
    @endforeach


    @else

    <h3>No items in Cart</h3>
    <a href="{{route('artworks.index')}}" class="button-black">Continue Shopping</a>

    @endif
    <hr>
    <div class="total">
        <h1>Total Price : Rp.{{Cart::subtotal()}}</h1>
        <div class="cart-button">
            <a href="{{route('artworks.index')}}" class="button-black">Continue Shopping</a>
            @if (Cart::count() > 0)
            <a href="{{route('sales.checkout')}}" class="button-black">Checkout</a>
            @endif
        </div>
    </div>
</div>
@endsection