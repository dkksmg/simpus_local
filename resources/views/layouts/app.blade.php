<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('includes.styles')
    @stack('addon-styles')
</head>

<body>
    @if (Auth::user()->role == 'ADMIN')
        @include('includes.admin.sidebar')
    @elseif (Auth::user()->role == 'KLINIK')
        @include('includes.faskes.sidebar')
    @endif
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        @include('includes.header')
        @yield('content')
        @include('includes.footer')
    </div>
    @include('sweetalert::alert')
    @include('includes.scripts')
    <div id="Popup"></div>
    @stack('addon-scripts')
</body>

</html>
