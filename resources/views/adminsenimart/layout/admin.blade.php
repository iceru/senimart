<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <div class="vertical-menu">
            <img src="image/logo.png" alt="">
            <h2>Hello, admin</h2>
            <a href="#">Dashboard</a>
            <a href="">Artworks</a>
            <a href="{{ route('adminartists.index')}}">Artists</a>
            <a href="#">User</a>
            <a href="#">Logout</a>
            <a href="/">Back to Senimart.id</a>
        </div>
        @yield('content-admin')
    </div>
</body>

</html>