@extends('layouts.app')

@section('title')
Search Results '{{ request()->input('query') }}' - Senimart
@endsection

@section('content')
<div class="search-container">
    <h1>Search Results</h1>
    <p>{{ $artworks->count() }} Results for <strong>{{ request()->input('query') }}</strong> </p>
    @foreach ($artworks as $art)
    <div class="result">
        <img src="{{ asset('/storage/'. $art->image) }}" alt="">
        <div class="result-text">
            <a href="/artwork/{{ $art->slug }}">
                <h2>{{ $art->title }}</h2>
            </a>
            <h4>{{ $art->artists->name }}</h4>
            <p>{{ $art->category->name }}</p>
            <p>{{ $art->sizeHeight }} cm (H) / {{ $art->sizeWidth }} cm (W)</p>
        </div>
    </div>
    <hr>
    @endforeach

    {{ $artworks->appends(request()->input())->links() }}
</div>

@endsection