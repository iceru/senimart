@extends('layouts.app')

@section('content')
<section class="artworks">
  <div class="title">
    <h1>Artworks</h1>
    <hr />
  </div>
  <div class="flex-artworks">
    <div class="sidebar">

      @if(request()->fullurl() != request()->url())
      <h1><a href="{{request()->url()}}">Clear Filter</a></h1>
      @endif

      <h1>Category</h1>
      <ul>
        @foreach ($categories as $category)
        <li><a href="{{ request()->fullUrlWithQuery(['category' => $category->slug])}}">{{$category->name}}</a></li>
        @endforeach
        <li><a href="{{route('artworks.index')}}">All Category</a></li>
      </ul>

      <h1>Price</h1>
      <ul>
        <li><a href="{{request()->fullUrlWithQuery(['price' => 'under500'])}}">Under 500$</a></li>
        <li><a href="{{request()->fullUrlWithQuery(['price' => 'above500'])}}">Above 500$</a></li>
      </ul>

      <h1>Color</h1>
      <div class="color">
        @foreach ($colors as $color)
        <a class="{{$color->name}}" href="{{request()->fullUrlWithQuery(['color'=> $color->name])}}"></a>
        @endforeach
      </div>

    </div>
    <div class="products">
      @forelse ($artworks as $artwork)
      <div class="products-img">
        <img src="{{ asset('storage/'.$artwork->image) }}" alt="arts" />
        <a href="/artwork/{{$artwork->slug}}">
          <h2>{{ $artwork->title}}</h2>
        </a>
        <h3>{{ $artwork->artists->name }} </h3>
        <p>{{$artwork->category->name}}</p>
        <p>{{ $artwork->sizeHeight }} cm (H) / {{ $artwork->sizeWidth }} cm (W)</p>
        <p>Rp{{ $artwork->price}}</p>
      </div>
      @empty
      <p>No Items Found</p>
      @endforelse
    </div>
  </div>
</section>
@endsection


<script src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

<script>
  $(".sidebar > ul > li > a").click(function() {             // when clicking any of these links
    $(".sidebar > ul > li > a").removeClass("selected"); // remove highlight from all links
    $(this).addClass("selected");          // add highlight to clicked link
})
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"
  integrity="sha256-MAgcygDRahs+F/Nk5Vz387whB4kSK9NXlDN3w58LLq0=" crossorigin="anonymous"></script>
</body>

</html>