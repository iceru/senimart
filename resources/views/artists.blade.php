@extends ('layouts.app')

@section('title')
Senimart - Artists
@endsection

@section ('content')
<div class="title-artist">
    <h1>Artists</h1>
</div>

<section class="artists">
    <div class="sort-name">
        <a href="">#</a>
        @foreach(range('a','z') as $letter)
        <a href="{{ route('artists.index', ['sortname' => $letter])}}"> {{ $letter }}</a>
        @endforeach
    </div>
    <div class="break"></div>
    @foreach ($artists as $artist)
    <div class="artist-profile">
        <div class="artist-image">
            <a href="artist/{{ $artist->slug}}">
                <img src="{{ URL::asset('storage/'.$artist->photo)}}" alt="">
            </a>
        </div>
        <div class="artist-desc">
            <a href="artist/{{ $artist->slug}}">
                <h3>{{ $artist->name }}</h3>
            </a>
            <p>{{ $artist->hometown }}</p>
            <p>{{ $artist->yearbirth }}</p>
        </div>
    </div>
    @endforeach
</section>

@endsection