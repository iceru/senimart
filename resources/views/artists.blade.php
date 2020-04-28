@extends ('layouts.app')

@section('title')
Senimart - Artists
@endsection

@section ('content')
<div class="artist-section">
    <div class="title-artist">
        <h1>ARTISTS</h1>
    </div>

    <div class="sort-name">
        <hr>
        <div class="alphabet">
            <a href="{{request()->url()}}">All &nbsp;|&nbsp;</a>
            <a href="{{ route('artists.index', ['sortname' => 'noalpha'])}}">#</a>
            @foreach(range('A','Z') as $letter)
            <a href="{{ route('artists.index', ['sortname' => $letter])}}"> {{ $letter }}</a>
            @endforeach
        </div>
        <hr>
    </div>

    <div class="artists-home">
        <div class="artist-items">
            @forelse ($artists as $artist)
            <div class="artist1">
                <a href="artist/{{ $artist->slug}}">
                    <img src="{{ URL::asset('storage/'.$artist->photo)}}" alt="">
                </a>
                <div class="artist-name">
                    <a href="artist/{{ $artist->slug}}">
                        <h4>{{ $artist->name }}</h4>
                    </a>
                </div>

            </div>

            @empty
            <p>Artists Not Found</p>
            @endforelse
        </div>
        {{ $artists->links() }}
    </div>
</div>


@endsection