@extends ('admin.layout.admin')

@section('content-admin')
<div class="content-admin">
    <h1>Artworks</h1>
    <form action="/admin/artworks/create" method="POST">
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
            <input type="text" name="title" id="title">
        </div>
        <div class="formgroup">
            <label for="price">Price</label>
            <input type="text" name="price" id="price">
        </div>
        <div class="formgroup">
            <label for="detail">Description</label>
            <input type="text" name="detail" id="detail">
        </div>
        <div class="formgroup">
            <label for="sizeHeight">Size Height</label>
            <input type="text" name="sizeHeight" id="sizeHeight">
        </div>
        <div class="formgroup">
            <label for="sizeWidth">Size Width</label>
            <input type="text" name="sizeWidth" id="sizeWidth">
        </div>
        <div class="formgroup">
            <label for="year">Year</label>
            <input type="text" name="year" id="year">
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

    <table>
        <tr>
            <th>Artist Name</th>
            <th>Title</th>
            <th>Price</th>
            <th>Description</th>
            <th>Size Height</th>
            <th>Size Width</th>
            <th>Year</th>
            <th>Category</th>
            <th>Edit/Delete</th>
        </tr>
        @foreach ($artworks as $artwork)
        <tr>
            <th>{{ $artwork->artists->name}}</th>
            <th>{{ $artwork->title}}</th>
            <th>${{ $artwork->price}}</th>
            <th>{{ $artwork->detail}}</th>
            <th>{{ $artwork->sizeHeight}}</th>
            <th>{{ $artwork->sizeWidth}}</th>
            <th>{{ $artwork->year}}</th>
            <th>{{ $artwork->categories->category}}</th>
            <th><a href="/admin/artworks/{{ $artwork->id }}/edit">Edit</a></th>
        </tr>
        @endforeach

    </table>

</div>

@endsection