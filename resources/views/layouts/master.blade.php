<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'LEARNMATH')</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @yield('css')
</head>
<body>
    <div class="wrapper">
        @include('includes.header')
        <div class="container">
            @yield('content')
        </div>
    </div>
    @yield('js')
</body>
</html>
