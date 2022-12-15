<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('includes.styles')
    @stack('addon-styles')
</head>

<body>
    @yield('content')
    @include('includes.scripts')

    @stack('addon-scripts')
</body>

</html>
