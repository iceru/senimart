@extends ('layouts.app')

@section('title')
{{$artist->name }} - Artist - Senimart
@endsection

@section ('content')
<section class="artist-detail">
    <div class="back">
        <a href="{{ route('artists.index') }}">
            <p> <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Artists </p>
        </a>
    </div>
    <div class="artistd-photo">
        <img src="{{ asset('storage/' . $artist->photo)}}" alt="">
    </div>
    <div class="artisd-bio">
        <h1>{{$artist->name}}</h1>
        <div class="bio-detail">
            <p><strong class="by">Birth Year</strong>: {{ $artist->yearbirth }}</p>
            <p><strong class="ht">Hometown</strong>: {{ $artist->hometown }}</p>
            <p><strong class="wr">Works</strong>: Jakarta</p>
        </div>

        <p>{!! $artist->biography !!}</p>

    </div>
</section>

<div class="title-related">
    <hr>
    <h1>ARTWORKS BY {{ $artist->name }}</h1>
    <hr>
</div>

<div class="art-related">
    @foreach ($artworks as $artwork)
    <div class="related-item">
        <a href="/artwork/{{$artwork->slug}}">
            <img src="{{ asset('storage/'.$artwork->image) }}" alt="arts" />
        </a>
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
    @endforeach
</div>

@endsection