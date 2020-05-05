@extends('layouts.app')

@section('title')
Senimart - Artworks
@endsection

@section('content')
<section class="artworks">
  <div class="title-artwork">
    <h1>ARTWORKS</h1>
  </div>
  <div class="flex-artworks">
    <div class="sort">
      <h3>{{ $categoryName }} <span style="text-transform: capitalize">{{ $colorName }}</span>  {{ $priceName }}</h3>
      <div class="wrdd" id="sort" onclick="ddSort()">
        <span>Sort by</span>
        <ul class="dd-item" id="ddsort">
          <li class="dd-li">
            <a href="{{request()->fullUrlWithQuery(['sort' => 'low_high'])}}">Lowest - Highest
              Price</a>
          </li>
          <li class="dd-li">
            <a href="{{request()->fullUrlWithQuery(['sort' => 'high_low'])}}">Highest - Lowest
              Price</a>
          </li>
          <li class="dd-li">
            <a href="{{request()->fullUrlWithQuery(['sort' => 'newest_oldest'])}}">Newest - Latest
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="sidebar" id="sidebar">
      @if(request()->fullurl() != request()->url())
      <h1 class="clear"><a href="{{request()->url()}}">Clear Filter</a></h1>
      @endif

      <div class="category">
        <h2>ARTWORKS</h2>
        <ul>
          @foreach ($categories as $category)
          <li><a href="{{ request()->fullUrlWithQuery(['category' => $category->slug])}}">{{$category->name}}</a></li>
          @endforeach
          <li><a href="{{route('artworks.index')}}">All Category</a></li>
        </ul>
        <hr>
      </div>

      <div class="sidebar-right">
        <h5>Filter artworks by:</h5>
        <div class="price">
          <div class="wrdd" onclick="ddPrice()">
            <span>Price</span>
            <ul class="dd-item" id="dd">
              <li class="dd-li"><a href="{{request()->fullUrlWithQuery(['price' => 'under500'])}}">Under 500$</a>
              </li>
              <li class="dd-li"><a href="{{request()->fullUrlWithQuery(['price' => 'above500'])}}">Above 500$</a>
              </li>
            </ul>
          </div>
        </div>

        <div class="color">
          <div onclick="ddColor()" class="wrdd" tabindex="1">
            <span>Color</span>
            <ul class="dd-item" id="ddcolor">
              @foreach ($colors as $color)
              <li><a href="{{request()->fullUrlWithQuery(['color'=> $color->name])}}">{{ $color->name }} </a></li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="products-items">
      @forelse ($artworks as $artwork)
      <div class="item" onclick="location.href='/artwork/{{$artwork->slug}}';">
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
              <input type="hidden" name="weight" value="{{$artwork->weight}}">
              <button type="submit" class="button-white-fill">
                Add to Cart</i></button>
            </form>
            @guest
            <div class="wish">
              <a class="button-white-fill" href="{{ route('login') }}"> Wishlist <i class="fa fa-heart"
                  aria-hidden="true"></i></a>
            </div>
            @else

            <form action="{{ route('wishlist.store') }}" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="artworks_id" value="{{$artwork->id}}">
              <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
              <button type="submit" class="button-white-fill">
                Wishlist <i class="fa fa-heart" aria-hidden="true"></i>
              </button>
            </form>
            @endif
          </div>
        </div>
        <div class="artwork-detail">
          <a href="/artwork/{{$artwork->slug}}">
            <h2>{{ $artwork->title}}</h2>
          </a>
          <a href="/artist/{{$artwork->artists->slug}}">
            <p>{{ $artwork->artists->name }} </p>
          </a>
          <a href="{{ route('artworks.index', ['category' => $artwork->category->slug ])}}">
            <p>{{$artwork->category->name}}</p>
          </a>
          <p>{{ $artwork->sizeHeight }} cm (H) / {{ $artwork->sizeWidth }} cm (W)</p>
          <h3>IDR {{ $artwork->price}} </h3>
        </div>
      </div>
      @empty
      <h4>No Items Found</h4>
      @endforelse
    </div>

    <div class="button-mobile">
      <a class="button-orange" href="#top">Filter <i class="fa fa-filter" aria-hidden="true"></i></a>
      <a class="button-orange" href="#sort">Sort <i class="fa fa-sort" aria-hidden="true"></i></a>
    </div>
  </div>
</section>
@endsection

@section('js')
<script>
  function ddPrice() {
  document.getElementById("dd").classList.toggle("showdd");
}
</script>

<script>
  function ddColor() {
  document.getElementById("ddcolor").classList.toggle("showdd");
}
</script>

<script>
  function ddSort() {
  document.getElementById("ddsort").classList.toggle("showdd");
}
</script>

@endsection



</html>