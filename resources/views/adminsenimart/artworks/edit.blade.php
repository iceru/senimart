@extends ('admin.layout.admin')

@section('content-admin')
<div class="content-admin">
    <h1>Artworks</h1>
    <form method="POST" action="admin/artworks/{{$artwork->id}}">
        @method('PATCH')
        <div class="formgroup">
            <label for="artists_id">Artist ID</label>
            <select name="artists_id" id="artists_id">
                @foreach ($artists as $artist)
                <option value="{{ $artist->id}}">{{ $artist->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="formgroup">
            <label for="title">Title</label>
            <input type="text" name="title" value="{{ old('title') ?? $artwork->title}}" id="title">
        </div>
        <div class="formgroup">
            <label for="price">Price</label>
            <input type="text" name="price" value="{{ old('price') ?? $artwork->price}}" id="price">
        </div>
        <div class="formgroup">
            <label for="detail">Description</label>
            <input type="text" name="detail" value="{{ old('detail') ?? $artwork->detail}}" id="detail">
        </div>
        <div class="formgroup">
            <label for="sizeHeight">Size Height</label>
            <input type="text" name="sizeHeight" value="{{ old('sizeHeight') ?? $artwork->sizeHeight}}" id="sizeHeight">
        </div>
        <div class="formgroup">
            <label for="sizeWidth">Size Width</label>
            <input type="text" name="sizeWidth" value="{{ old('sizeWidth') ?? $artwork->sizeWidth}}" id="sizeWidth">
        </div>
        <div class="formgroup">
            <label for="year">Year</label>
            <input type="text" name="year" value="{{ old('year') ?? $artwork->year}}" id="year">
        </div>
        <div class="formgroup">
            <label for="category">Category</label>
            <select name="categories_id" id="categories_id">
                @foreach ($categories as $category)
                <option value="{{ $category->id}}">{{ $category->category }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit"> Submit </button>

        @csrf
    </form>
</div>

@endsection