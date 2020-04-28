@extends ('layouts.app')

@section('title')
Senimart - {{ $artwork->title }}
@endsection

@section ('content')
<div class="breadcrumbs">
    <p><a href="{{ route('home') }}">Home</a> / <a href="{{ route('artworks.index') }}">Artworks</a> /
        {{ $artwork->title }}</p>
</div>

<section class="artworks-detail">
    <div class="art">
        <div class="art-item">
            <img class="activeimg" src="{{ asset('storage/'.$artwork->image) }}" alt="{{$artwork->slug}}"
                id="currentImage" />
        </div>
        @if ($artwork->gallery)
        <div class="arts">
            <div class="arts-item">
                <img src="{{ asset('storage/'.$artwork->image) }}" alt="{{$artwork->slug}}" />
            </div>
            @foreach (json_decode($artwork->gallery, true) as $images)
            <div class="arts-item">
                <img src="{{ URL::to('storage/' . $images)}}" alt="{{$artwork->slug}}">
            </div>
            @endforeach
        </div>
        @endif
    </div>


    <div class="desc">
        <h1>{{ $artwork->title}}</h1>
        <a href="/artist/{{$artwork->artists->slug}}">
            <h4>{{ $artwork->artists->name}}</h4>
        </a>

        <div class="desc-detail">
            <p> <strong class="tp">Type</strong>: <a
                    href="{{ route('artworks.index', ['category' => $artwork->category->slug ])}}">{{$artwork->category->name}}</a>
            </p>
            <p><strong class="md">Medium</strong>: {{$artwork->subcategory}}</p>
            <p><strong class="yr">Year</strong>: {{$artwork->year}}</p>
            <p><strong class="dm">Dimension</strong>: {{ $artwork->sizeHeight}}cm (H) / {{ $artwork->sizeWidth}}cm (W)
            </p>
        </div>


        <div class="price-wish">
            <div class="priceart">
                <h3>IDR {{ $artwork->price}}</h3>
            </div>
            @guest
            <div class="wish">
                <a class="button-wish-org" href="{{ route('login') }}"> Add to Wishlist <i class="fa fa-heart"
                        aria-hidden="true"></i></a>
            </div>
            @else

            <form action="{{ route('wishlist.store') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="artworks_id" value="{{$artwork->id}}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <button type="submit" class="button-wish-org">
                    Add to Wishlist <i class="fa fa-heart" aria-hidden="true"></i>
                </button>
            </form>
            @endif
        </div>

        <div class="artwork-button">
            <form action="{{route('cart.store')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{$artwork->id}}">
                <input type="hidden" name="title" value="{{$artwork->title}}">
                <input type="hidden" name="price" value="{{$artwork->price}}">
                <input type="hidden" name="weight" value="{{$artwork->weight}}">
                <button type="submit" class="button-orange">ADD TO CART</button>
            </form>
        </div>
        <button type="button" class="collapsible">Artwork Description</button>
        <div class="content-collapse">
            <p>
                {!! $artwork->detail !!}
            </p>
        </div>
        <button type="button" class="collapsible">Delivery Information</button>
        <div class="content-collapse">
            <p>
                Shipping and Delivery options will be available upon check out. <br>
                Shipping and Delivery costs will be automatically calculated at check out based on your location.
            </p>
        </div>


    </div>

    <div class="related">
        <div class="related-title">
            <h5>MORE ARTWORKS BY {{ $artwork->artists->name }}</h5>
            <div class="viewall">View All</div>
        </div>

        <div class="art-related">
            <div class="related1">
                @foreach ($related as $item)
                <div class="related-item">
                    <a href="/artwork/{{$item->slug}}">
                        <img src="{{ asset('storage/'.$item->image) }}" alt="arts" />
                    </a>
                    <a href="/artwork/{{$item->slug}}">
                        <h2>{{ $item->title}}</h2>
                    </a>
                    <a href="/artist/{{$item->artists->slug}}">
                        <p>{{ $item->artists->name }} </p>
                    </a>
                    <a href="{{ route('artworks.index', ['category' => $item->category->slug ])}}">
                        <p>{{$item->category->name}}</p>
                    </a>
                    <p>{{ $item->sizeHeight }} cm (H) / {{ $item->sizeWidth }} cm (W)</p>
                    <h3>IDR {{ $item->price}} </h3>
                </div>
                @endforeach
            </div>
        </div>
    </div>


</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"
    integrity="sha256-MAgcygDRahs+F/Nk5Vz387whB4kSK9NXlDN3w58LLq0=" crossorigin="anonymous"></script>

@endsection

@section('js')
<script>
    (function() {
        const currentImage = document.querySelector('#currentImage');
        const images = document.querySelectorAll('.arts-item');

        images.forEach((element) => element.addEventListener('click', thumbnailClick));

        function thumbnailClick(e) {
          // currentImage.src = this.querySelector('img').src;

            currentImage.classList.remove('activeimg');

            currentImage.addEventListener('transitionend', () => {
                currentImage.src = this.querySelector('img').src;
                currentImage.classList.add('activeimg')
            })

            images.foreach((element) => element.classList.remove('selectedimg'));
            this.classList.add('selectedimg');
        }
    })();
</script>

<script>
    var coll = document.getElementsByClassName("collapsible");
    var i;
    
    for (i = 0; i < coll.length; i++) {
      coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.maxHeight){
          content.style.maxHeight = null;
        } else {
          content.style.maxHeight = content.scrollHeight + "px";
        }
      });
    }
</script>

<script>
    if ($('.related-item').length > 4) {
    $('.related-item:gt(3)').hide();
    $('.viewall').show();
    }

    $('.viewall').on('click', function() {
    $('.related-item:gt(3)').toggle();
    $(this).text() === 'View All' ? $(this).text('View less') : $(this).text('View All');
    });
</script>


@endsection