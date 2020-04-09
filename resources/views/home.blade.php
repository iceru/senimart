@extends('layouts.app')

@section('title')
Senimart
@endsection

@section('content')

<section class="index">
  <div class="calltoaction">
    <img src="/image/header.jpg" alt="" />
  </div>
  <div class="cta-text">
    <h1>Call to Action</h1>
    <h4>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</h4>
    <div class="button-ctr">
      <a href="{{route('artworks.index')}}" class="button-white">Shop Now</a>
    </div>
  </div>

  <div class="featured">
    <h1>FEATURED ARTS</h1>
    <div class="break"></div>
    <hr />
    <div class="break"></div>
    <div class="painting-featured">
      @foreach ($featured as $featured)
      <div class="painting-item">
        <a href="/artwork/{{$featured->slug}}">
          <img src="{{asset('storage/'. $featured->image)}}" alt="picture-1" />
        </a>
        <a href="/artwork/{{$featured->slug}}">
          <h2>{{ $featured->title }}</h2>
        </a>
        <a href="/artist/{{$featured->artists->slug}}">
          <h3>{{ $featured->artists->name }}</h3>
        </a>
        <h5 class="mono">Rp{{ $featured->price }}</h5>
        <p>{{ $featured->category->name}} </p>
        <p></p>

      </div>
      @endforeach

    </div>
  </div>

  <div class="price">
    <h1>
      Browse Arts <br />
      by Price.
    </h1>
    <div class="price2">
      <div class="price-pic1" onclick="location.href='#';">
        <h2>UNDER</h2>
        <h1>500$</h1>
      </div>
      <div class="price-pic2">
        <h2>OVER</h2>
        <h1>500$</h1>
      </div>
    </div>
  </div>

  <div class="products">
    <h1>PRODUCTS</h1>
    <hr />
    <div class="products-items">
      @foreach ($artworks as $artwork)
      <div class="item">
        <a href="/artwork/{{$artwork->slug}}">
          <img src="{{asset('storage/'. $artwork->image)}}" alt="picture-1" />
        </a>
        <a href="/artwork/{{$artwork->slug}}">
          <h2>{{ $artwork->title }}</h2>
        </a>
        <a href="/artist/{{$artwork->artists->slug}}">
          <h3>{{ $artwork->artists->name }}</h3>
        </a>
        <h5 class="mono">Rp{{ $artwork->price }}</h5>
        <a href="{{ route('artworks.index', ['category' => $artwork->category->slug])}}">
          <p>{{ $artwork->category->name}} </p>
        </a>
        {{-- <p>{{ $artwork->sizeHeight }} cm (H) / {{ $artwork->sizeWidth }} cm (W)</p> --}}
      </div>
      @endforeach
    </div>
    <a href="{{route('artworks.index')}}" class="button-list-black">More Products</a>
  </div>

  <div class="categories">
    <h1>
      Browse Arts <br />
      by Categories.
    </h1>
    <div class="category-items">
      <div class="category1">
        <a href="{{ route('artworks.index', ['category' => 'painting-and-drawing'])}}">
          <p>Painting & Drawing</p>
        </a>
      </div>
      <div class="category2">
        <a href="{{ route('artworks.index', ['category' => 'digital-art-prints'])}}">
          <p>Digital Art Prints</p>
        </a>
      </div>
    </div>

    <div class="category-items2">
      <div class="category3">
        <a href="{{ route('artworks.index', ['category' => 'photography'])}}">
          <p>Photography</p>
        </a>
      </div>
      <div class="category4">
        <a href="{{ route('artworks.index', ['category' => 'mix-media'])}}">
          <p>Mix Media</p>
        </a>
      </div>
      <div class="category5">
        <a href="{{ route('artworks.index', ['category' => 'objects'])}}">
          <p>Objects</p>
        </a>
      </div>
    </div>
  </div>

  <div class="artists-home">
    <h1>FEATURED ARTISTS</h1>
    <hr />
    <div class="artist-items">
      @foreach ($artists as $artist)
      <div class="artist1">
        <a href="/artist/{{$artist->slug}}">
          <img src="{{asset('storage/'. $artist->photo)}}" alt="artist" />
        </a>
        <div class="artist-name">
          <a href="/artist/{{$artist->slug}}">
            <h4>{{ $artist->name}}</h4>
            <p>b.{{ $artist->yearbirth }}</p>
          </a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

@endsection