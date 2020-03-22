@extends('layouts.app')

@section ('title')
Senimart - Wishlist
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

    @if (Cart::instance('wishlist')->count() > 0)

    <h1>Wishlist</h1>
    <p id="text-line">{{ Cart::instance('wishlist')->count() }} Item(s) in Wishlist</p>
    <hr>
    @foreach (Cart::instance('wishlist')->content() as $item)
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
            <p> {{$item->model->sizeHeight}} (H) / {{$item->model->sizeWidth}} (W)</p>
        </div>
        <div class="cart-price">
            <h1>Rp.{{$item->model->price}}</h1>
            <form action="{{route('cart.store')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{$item->model->id}}">
                <input type="hidden" name="title" value="{{$item->model->title}}">
                <input type="hidden" name="price" value="{{$item->model->price}}">
                <button type="submit" class="button-black">Add to Cart</button>
            </form>
            <form action="{{route('cart.rmwish', $item->rowId)}}" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="button">Remove</button>
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

    <h3>No items in Wishlist</h3>
    <a href="{{route('artworks.index')}}" class="button-black">Continue Shopping</a>

    @endif
    <hr>
    <div class="total">
        <div class="cart-button">
            <a href="{{route('artworks.index')}}" class="button">Continue Shopping</a>
            <a href="" class="button">Add to Cart</a>
        </div>
    </div>
</div>
@endsection