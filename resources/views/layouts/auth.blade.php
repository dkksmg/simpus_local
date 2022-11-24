<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('includes.styles')
</head>

<body>
    @yield('content')
    @include('includes.scripts')

</body>

</html>
