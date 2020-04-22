@extends('layouts.app')

@section('title')
Senimart - Artworks
@endsection

@section('content')
<section class="profile">
    <div class="flex-profile">
        <h1>My</h1>
        <div class="sidebar" id="sidebar">
            @if(request()->fullurl() != request()->url())
            <h1 class="clear"><a href="{{request()->url()}}">Clear Filter</a></h1>
            @endif

            <div class="category">
                <h1>My Profile</h1>
                <hr>
            </div>

            <div class="price">
                <h1>Wishlist</h1>
                <hr>
            </div>

            <div class="color">
                <h1>Orders</h1>
                <hr>
            </div>
        </div>
        <div class="profile-content">
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $user->name) }}"
                    aria-describedby="helpId" placeholder="">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" class="form-control" name="email" id="email"
                    value="{{ old('email', $user->email) }}" aria-describedby="helpId" placeholder="">
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId"
                    placeholder="">
            </div>
            <div class="form-group">
                <label for="">Confirm Passwords</label>
                <input type="password" class="form-control" name="password-confirm" id="password-confirm"
                    aria-describedby="helpId" placeholder="">
            </div>
        </div>
    </div>
</section>
@endsection



</html>