@extends('layouts.app')

@section('title')
Senimart
@endsection

@section('content')

<section class="index">
  <div class="calltoaction">
    <div class="cta-text">
      <h1>We're Back</h1>
      <img src="/image/logowhite.png" alt="">
      {{-- <h4>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</h4> --}}
      {{-- <div class="button-ctr">
        <a href="{{route('artworks.index')}}" class="button-white">Shop Now</a>
    </div> --}}
  </div>

  </div>
  {{-- <div class="cta-text">
    
  </div> --}}

  <div class="featured">
    <h1>Featured Arts</h1>
    <div class="break"></div>
    <hr />
    <div class="break"></div>
    <div class="painting-featured">
      @foreach ($featured as $featured)
      <div class="painting-item">
        <a href="/artwork/{{$featured->slug}}">
          <img src="{{asset('storage/'. $featured->image)}}" alt="picture-1" />
        </a>
        <div class="painting-text">
          <a href="/artwork/{{$featured->slug}}">
            <h2>{{ $featured->title }}</h2>
          </a>
          <div class="author-price">
            <div class="author">
              <a href="/artist/{{$featured->artists->slug}}">
                <h5>{{ $featured->artists->name }}</h5>
              </a>
              <a href="{{ route('artworks.index', ['category' => $featured->category->slug])}}">
                <p>{{ $featured->category->name}} </p>
              </a>
            </div>
            <h3>Rp{{ $featured->price }}</h3>
          </div>
        </div>


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
      <a href="{{ route('artworks.index', ['price' => 'under500'])}}">
        <div class="price-pic1" onclick="location.href='#';">
          <h2>UNDER</h2>
          <h1>500$</h1>
        </div>
      </a>
      <a href="{{ route('artworks.index', ['price' => 'above500'])}}">
        <div class="price-pic2">
          <h2>OVER</h2>
          <h1>500$</h1>
        </div>
      </a>
    </div>
  </div>

  <div class="products">
    <h1>Products</h1>
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
    <h1>Featured Artists</h1>
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