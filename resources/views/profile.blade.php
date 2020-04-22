@extends('layouts.app')

@section('title')
Senimart - Artworks
@endsection

@section('content')
<section class="profile">
    <div class="flex-profile">
        <div class="sidebar" id="sidebar">
            @if(request()->fullurl() != request()->url())
            <h1 class="clear"><a href="{{request()->url()}}">Clear Filter</a></h1>
            @endif

            <div class="category">
                <hr>
                <h1>Category</h1>
                <hr>
            </div>

            <div class="price">
                <h1>Price</h1>
                <hr>
            </div>

            <div class="color">
                <h1>Color</h1>
                <hr>
            </div>
        </div>
        <div class="products-items">
        </div>
    </div>
</section>
@endsection



</html>