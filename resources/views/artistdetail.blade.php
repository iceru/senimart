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
        <img src="{{asset('storage/'. $artwork->image)}}" alt="" />
        <h2>{{$artwork->title}}</h2>
        <h3>{{$artwork->artists->name}}</h3>
        <p>{{$artwork->category->name}}</p>
        <p>{{$artwork->sizeHeight}} cm (H) / {{$artwork->sizeWidth}} cm (W)</p>
        <p>Rp{{$artwork->price}}</p>
    </div>
    @endforeach
</div>

@endsection