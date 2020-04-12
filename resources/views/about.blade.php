@extends ('layouts.app')

@section('title')
About - Senimart
@endsection

@section ('content')

<div class="about-main">
    <div class="about">
        <img src="image/logo.png" alt="">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis, quia? Neque officia natus recusandae
            esse,
            enim laboriosam cupiditate cumque doloribus repellendus! Officiis nam optio earum modi accusamus assumenda,
            voluptas vitae?
        </p>
    </div>

    <div class="contact">
        <div class="sculpt">
            <img src="image/about1.png" alt="about-senimart">
        </div>
        <div class="contact-detail">
            <hr>
            <img class="contact-title" src="image/contact.png" alt="">
            <p><i class="fa fa-phone-alt"></i> +62-816-627-582</p>
            <p><i class="fa fa-envelope"></i> contact@senimart.id</p>
        </div>
    </div>

    <div class="location">
        <div class="location-detail">
            <hr>
            <img src="image/location.png" alt="">
            <h4>
                ARIMBI OFFICE SPACE <br />
                2nd floor, Suite 206
            </h4>
            <p>
                Jl. Kemang Timur Raya No. 38 <br />
                Kemang, Jakarta Selatan
            </p>
        </div>
        <div class="map">
            <div style="width: 100%"><iframe width="100%" height="400"
                    src="https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;q=Arimbi%20Office%2C%20Kemang+(Senimart)&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=B&amp;output=embed"
                    frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a
                        href="https://www.maps.ie/coordinates.html">gps coordinates finder</a></iframe></div><br />
        </div>
    </div>

    <div class="team">
        <img class="team-title" src="image/team.png" alt="">
        <div class="team-items">
            <div class="team1">
                <div class="team-img">
                    <img src="/image/artist1.png" alt="">
                </div>
                <div class="team-name">
                    <h1>Bintang Gemilang</h1>
                    <p>Creative Director</p>
                </div>
            </div>
            <div class="team2">
                <div class="team-img">
                    <img src="/image/artist1.png" alt="">
                </div>
                <div class="team-name">
                    <h1>Hally Ahmad</h1>
                    <p>Marketing & Communication Director</p>
                </div>
            </div>

            <div class="team3">
                <div class="team-img">
                    <img src="/image/artist1.png" alt="">
                </div>
                <div class="team-name">
                    <h1>Adam Irfan Hawari</h1>
                    <p>Operational Manager</p>
                </div>
            </div>

            <div class="team4">
                <div class="team-img">
                    <img src="/image/artist1.png" alt="">
                </div>
                <div class="team-name">
                    <h1>Edho Habinsaran</h1>
                    <p>Account & Event Manager</p>
                </div>
            </div>
            <div class="team5">
                <div class="team-img">
                    <img src="/image/artist1.png" alt="">
                </div>
                <div class="team-name">
                    <h1>Mona Liem</h1>
                    <p>Business Development Manager</p>
                </div>
            </div>
        </div>

    </div>
</div>


@endsection