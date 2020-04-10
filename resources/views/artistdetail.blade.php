@extends ('layouts.app')

@section ('content')
<section class="artist-detail">
    <div class="artistd-photo">
        <img src="{{ asset('storage/' . $artist->photo)}}" alt="">
    </div>
    <div class="artisd-bio">
        <h1>{{$artist->name}}</h1>
        <p><strong>Biography.</strong></p>
        <p>{!! $artist->biography !!}</p>
        <p><strong>Birth Year</strong> : {{ $artist->yearbirth }}</p>
        <p><strong>Hometown</strong> : {{ $artist->hometown }}</p>
    </div>
</section>

<div class="title">
    <h1>{{ $artist->name }} Artworks</h1>
</div>

<div class="art-related">
    @foreach ($artworks as $artwork)
    <div class="art-image">
        <a href="/artwork/{{$artwork->slug}}">
            <img src="{{asset('storage/'. $artwork->image)}}" alt="" />
        </a>
        <a href="/artwork/{{$artwork->slug}}">
            <h2>{{$artwork->title}}</h2>
        </a>
        <h3>{{$artwork->artists->name}}</h3>
        <h5 id="price">Rp{{$artwork->price}}</h5>
        <a href="{{ route('artworks.index', ['category' => $artwork->category->slug ])}}">
            <p>{{$artwork->category->name}}</p>
        </a>
        <p>{{$artwork->sizeHeight}} cm (H) / {{$artwork->sizeWidth}} cm (W)</p>

    </div>
    @endforeach
</div>

@endsection