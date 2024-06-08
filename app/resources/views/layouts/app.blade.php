<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('pageTitle', config('app.name'))</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>

<div class="container">
    @include('layouts.header')
    <div id="pageContent">
        @yield('content')
    </div>
    @include('layouts.footer')
</div>

</body>
</html>
