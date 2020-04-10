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
    <div class="sidebar">
      @if(request()->fullurl() != request()->url())
      <h1><a href="{{request()->url()}}">Clear Filter</a></h1>
      @endif

      <div class="category">
        <h1>Category</h1>
        <ul>
          @foreach ($categories as $category)
          <li><a href="{{ request()->fullUrlWithQuery(['category' => $category->slug])}}">{{$category->name}}</a></li>
          @endforeach
          <li><a href="{{route('artworks.index')}}">All Category</a></li>
        </ul>
      </div>

      <div class="price">
        <h1>Price</h1>
        <ul>
          <li><a href="{{request()->fullUrlWithQuery(['price' => 'under500'])}}">Under 500$</a></li>
          <li><a href="{{request()->fullUrlWithQuery(['price' => 'above500'])}}">Above 500$</a></li>
        </ul>
      </div>

      <div class="color">
        <h1>Color</h1>
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
        <img src="{{ asset('storage/'.$artwork->image) }}" alt="arts" />
        <a href="/artwork/{{$artwork->slug}}">
          <h2>{{ $artwork->title}}</h2>
        </a>
        <a href="/artist/{{$artwork->artists->slug}}">
          <h3>{{ $artwork->artists->name }} </h3>
        </a>
        <h5 id="price">Rp{{ $artwork->price}}</h5>
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


</body>

</html>