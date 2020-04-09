@extends('layouts.app')
@section('title')
{{ $project->name }}
@endsection
@section('content')
<img src="{{ asset('storage/'.$project->image) }}" alt="project">
<div class="project-text">
    <h4>{{ $project->name }}</h4>
    <p>{{ \Carbon\Carbon::parse($project->date)->format('jS F Y') }}</p>
    <p>{!! $project->detail !!}
    </p>
</div>
@endsection