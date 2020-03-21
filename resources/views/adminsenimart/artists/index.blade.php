@extends ('admin.layout.admin')

@section('content-admin')
<div class="content-admin">
    <h1>Artists</h1>
    <a href="{{ route('artists.create')}}">Add Artists</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Biography</th>
            <th>Birth Year</th>
            <th>Hometown</th>
            <th>Photo</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        @foreach ($artists as $artist)
        <tr>
            <td>{{$artist->id}}</td>
            <td>{{$artist->name}}</td>
            <td>{{$artist->biography}}</td>
            <td>{{$artist->yearbirth}}</td>
            <td>{{$artist->hometown}}</td>
            <td><img src="{{asset('storage/' . $artist->photo)}}" style="width: 7em" alt=""></td>
            <td><a href="artists/{{$artist->id}}/edit">Edit</a></td>
            <td>
                <form action="{{ route('artists.destroy', ['artist' => $artist]) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
</div>
@endsection