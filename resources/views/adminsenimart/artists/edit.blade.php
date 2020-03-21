@extends ('admin.layout.admin')

@section('content-admin')
<div class="content-admin">
    <h1>Artworks</h1>
    <form method="POST" action="{{ route('artists.update', ['artist' => $artist]) }}" enctype="multipart/form-data">
        @method('PATCH')
        <div class=" formgroup">
            <label for="name">Name</label>
            <input type="text" name="name" value="{{ old('name') ?? $artist->name }}" id="name">
        </div>
        <div class="formgroup">
            <label for="biography">Biography</label>
            <textarea name="biography" id="biography" value="{{ old('biography') ?? $artist->biography }}" cols="50"
                rows="10"></textarea>
        </div>
        <div class="formgroup">
            <label for="yearbirth">Birth Year</label>
            <input type="text" name="yearbirth" value="{{ old('yearbirth') ?? $artist->yearbirth }}" id="yearbirth">
        </div>
        <div class="formgroup">
            <label for="hometown">Hometown</label>
            <input type="text" name="hometown" value="{{ old('hometown') ?? $artist->hometown }}" id="hometown">
        </div>
        <div class="formgroup">
            <label for="photo">Photo</label>
            <input type="file" name="photo" value="{{ old('photo') ?? $artist->photo }}" id="photo">
        </div>

        <button type="submit"> Submit </button>

        @csrf
    </form>
</div>

@endsection