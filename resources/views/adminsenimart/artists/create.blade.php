@extends ('admin.layout.admin')

@section('content-admin')
<div class="content-admin">
    <h1>Artists</h1>
    <form action="{{ route('artists.store') }}" method="POST" enctype="multipart/form-data">

        <div class="formgroup">
            <label for="name">Name</label>
            <input type="text" name="name" id="name">
        </div>
        <div class="formgroup">
            <label for="biography">Biography</label>
            <textarea name="biography" id="biography" cols="50" rows="10"></textarea>
        </div>
        <div class="formgroup">
            <label for="yearbirth">Birth Year</label>
            <input type="text" name="yearbirth" id="yearbirth">
        </div>
        <div class="formgroup">
            <label for="hometown">Hometown</label>
            <input type="text" name="hometown" id="hometown">
        </div>
        <div class="formgroup">
            <label for="photo">Photo</label>
            <input type="file" name="photo" id="photo">
        </div>
        @csrf

        <button type="submit"> Submit </button>
    </form>
</div>
@endsection