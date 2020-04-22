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
            <img class="img-service1" src="image/service1.png" alt="">
        </div>
        <div class="service2">
            <img class="number" src="/image/02.png" alt="">
            <p>Art Events, Activators & <br>
                Project Management</p>
            <img class="img-service2" src="image/service2.png" alt="">
        </div>
        <div class="service3">
            <img class="number" src="/image/03.png" alt="">
            <p>Development & <br> Workshop</p>
            <img class="img-service3" src="image/service3.png" alt="">
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
                    <p>More Detail <i class="fa fa-arrow-right" aria-hidden="true"></i></p>
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
                                <div id="#carouseldata" class="carousel slide" data-ride="carousel"
                                    data-interval="3000">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="{{ asset('storage/'.$project->image) }}" class="d-block w-100"
                                                alt="{{$project->slug}}" />
                                        </div>
                                        @foreach (json_decode($project->gallery, true) as $images)
                                        <div class="carousel-item">
                                            <img src="{{ URL::to('storage/' . $images)}}" class="d-block w-100"
                                                alt="{{$project->name}}">
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- <div class="art">
                                    <div class="art-item">
                                        <img class="activeimg" src="{{ asset('storage/'.$project->image) }}"
                                alt="{{$project->slug}}" id="currentImage" />
                            </div>
                            @if ($project->gallery)
                            <div class="arts">
                                <div class="arts-item">
                                    <img src="{{ asset('storage/'.$project->image) }}" alt="{{$project->name}}" />
                                </div>
                                @foreach (json_decode($project->gallery, true) as $images)
                                <div class="arts-item">
                                    <img src="{{ URL::to('storage/' . $images)}}" alt="{{$project->name}}">
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div> --}}

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
@endsection