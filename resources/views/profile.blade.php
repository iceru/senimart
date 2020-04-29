@extends('layouts.app')

@section('title')
Senimart - Artworks
@endsection

@section('content')
<section class="profile">
    <div class="alert">
        @if (session()->has('success_message'))

        <div class="alert-success">
            {{ session()->get('success_message') }}
        </div>
        @endif

        @if(count($errors) > 0)
        <div class="alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    <div class="flex-profile">
        <h1 class="title-profile">Hello, {{ $user->name }}</h1>
        <div class="sidebar" id="sidebar">
            <div class="category">
                <a href="{{ route('profile.edit') }}">
                    <h1>My Profile</h1>
                </a>
                <hr>
            </div>

            <div class="category">
                <a href="{{ route('address.index') }}">
                    <h1>Address</h1>
                </a>
                <hr>
            </div>

            <div class="orders">
                <a href="{{ route('orders.index') }}">
                    <h1>Orders</h1>
                </a>
                <hr>
            </div>

            <div class="wishlist">
                <a href="{{route('wishlist.index')}}">
                    <h1>Wishlist</h1>
                </a>
                <hr>
            </div>
        </div>
        <div class="profile-content">
            <form action="{{ route('profile.update') }}" method="POST">
                @method('patch')
                @csrf
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
                    <small id="helpId" class="form-text text-muted">Leave Password blank to keep current
                        password</small>
                </div>
                <div class="form-group">
                    <label for="">Confirm Passwords</label>
                    <input type="password" class="form-control" name="password-confirm" id="password-confirm"
                        aria-describedby="helpId" placeholder="">
                </div>
                <div class="form-group">
                    <button type="submit" class="button-black">Update Profile</button>
                </div>

            </form>
        </div>
    </div>
</section>
@endsection



</html>