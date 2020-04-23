@extends('layouts.app')

@section('title')
Senimart - Artworks
@endsection

@section('content')
<section class="artworks">
  <div class="title-artist">
    <h1>Artworks</h1>
  </div>
  <div class="flex-artworks">
    <div class="sidebar" id="sidebar">
      @if(request()->fullurl() != request()->url())
      <h1 class="clear"><a href="{{request()->url()}}">Clear Filter</a></h1>
      @endif

      <div class="category">
        <h1>Category</h1>
        <hr>
        <ul>
          @foreach ($categories as $category)
          <li><a href="{{ request()->fullUrlWithQuery(['category' => $category->slug])}}">{{$category->name}}</a></li>
          @endforeach
          <li><a href="{{route('artworks.index')}}">All Category</a></li>
        </ul>
      </div>

      <div class="price">
        <h1>Price</h1>
        <hr>
        <ul>
          <li><a href="{{request()->fullUrlWithQuery(['price' => 'under500'])}}">Under 500$</a></li>
          <li><a href="{{request()->fullUrlWithQuery(['price' => 'above500'])}}">Above 500$</a></li>
        </ul>
      </div>

      <div class="color">
        <h1>Color</h1>
        <hr>
        <div class="item">
          @foreach ($colors as $color)
          <a class="{{$color->name}}" data-toggle="tooltip" data-placement="top" title="{{$color->name}}"
            href="{{request()->fullUrlWithQuery(['color'=> $color->name])}}"></a>
          @endforeach
        </div>

      </div>

    </div>
    <div class="products-items">
      @forelse ($artworks as $artwork)
      <div class="item">
        <div class="cart-wishlist">
          <a href="/artwork/{{$artwork->slug}}">
            <img src="{{ asset('storage/'.$artwork->image) }}" alt="arts" />
          </a>
          <div class="form-cart-wishlist">
            <form class="form-cart" action="{{route('cart.store')}}" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="id" value="{{$artwork->id}}">
              <input type="hidden" name="title" value="{{$artwork->title}}">
              <input type="hidden" name="price" value="{{$artwork->price}}">
              <button type="submit" class="button-white">
                <i class="fa fa-shopping-basket fa-lg" aria-hidden="true"></i>
              </button>
            </form>
            <form action="{{ route('wishlist.store') }}" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="artworks_id" value="{{$artwork->id}}">
              <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
              <button type="submit" class="button-white">
                <i class="fa fa-heart fa-lg" aria-hidden="true"></i>
              </button>
            </form>
          </div>


        </div>
        <a href="/artwork/{{$artwork->slug}}">
          <h2>{{ $artwork->title}}</h2>
        </a>
        <h3 id="price">Rp{{ $artwork->price}} </h3>
        <a href="/artist/{{$artwork->artists->slug}}">
          <h5>{{ $artwork->artists->name }} </h5>
        </a>
        <a href="{{ route('artworks.index', ['category' => $artwork->category->slug ])}}">
          <p>{{$artwork->category->name}}</p>
        </a>


        {{-- <p>{{ $artwork->sizeHeight }} cm (H) / {{ $artwork->sizeWidth }} cm (W)</p> --}}
      </div>
      @empty
      <h4>No Items Found</h4>
      @endforelse
    </div>
  </div>
</section>
@endsection



</html>