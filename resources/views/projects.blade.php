@extends ('layouts.app')

@section('title')
Senimart - Projects
@endsection

@section('content')
<div class="services">
    <hr>
    <h1>SERVICES</h1>
    <div class="service-item">
        <div class="service1">
            <img class="number" src="/image/01.png" alt="">
            <p class="p-1">Art Gallery</p>
            <img src="image/service1.png" alt="">
        </div>
        <div class="service2">
            <img class="number" src="/image/02.png" alt="">
            <p>Art Events, Activators & <br>
                Project Management</p>
            <img src="image/service2.png" alt="">
        </div>
        <div class="service3">
            <img class="number" src="/image/03.png" alt="">
            <p>Development & <br> Workshop</p>
            <img src="image/service3.png" alt="">
        </div>
    </div>
</div>

<!-- Button trigger modal -->


<div class="projects">
    <div class="title-projects">
        <img src="/image/projects.png" alt="">
        <p>Senimart Projects Thorought the Years</p>
    </div>
    <div class="projects-item">
        @foreach ($projects as $project)
        <div class="project1">
            <img src="{{ asset('storage/'.$project->image) }}" alt="project">
            <div class="project-text">
                <h4>{{ $project->name }}</h4>
                <div class="place-date">
                    <p><i class="fa fa-map-marker-alt" aria-hidden="true"></i>&nbsp; {{ $project->place }}</p>
                    <p><i class="fa fa-calendar-alt"
                            aria-hidden="true"></i>&nbsp;{{ \Carbon\Carbon::parse($project->date)->format('jS F Y') }}
                    </p>
                </div>

                {{-- <p>{!! $project->detail !!}</p> --}}
                <button type="button" class="button-list-black" data-toggle="modal"
                    data-target="#modelId{{ $project->id }}">
                    More Detail
                </button>
            </div>
        </div>
        @endforeach

        @foreach ($projects as $project)

        <!-- Modal -->
        <div class="modal fade" id="modelId{{ $project->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="modal-text">
                                <h4>{{ $project->name }}</h4>
                                <div class="place-date">
                                    <p><i class="fa fa-map-marker-alt" aria-hidden="true"></i>&nbsp;
                                        {{ $project->place }}
                                    </p>
                                    <p><i class="fa fa-calendar-alt"
                                            aria-hidden="true"></i>&nbsp;{{ \Carbon\Carbon::parse($project->date)->format('jS F Y') }}
                                    </p>
                                </div>
                                <p>{!! $project->detail !!}
                                </p>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="button-black" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection