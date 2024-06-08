<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>

<div class="container">
    @include('layouts.header')

    @yield('content')

    @include('layouts.footer')
</div>

</body>
</html>
