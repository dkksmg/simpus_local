{{-- <base href="./"> --}}
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<meta name="description" content="Website Sistem Puskesmas Terintegrasi dengan Kemenkes">
<meta name="author" content="ardianfm - DKK Semarang">
<meta name="keyword" content="Simpus, Satu Sehat, Kota Semarang, Dinas Kesehatan Kota Semarang">
<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
<title>SIM E-Klinik</title>
<link rel="shortcut icon" href="http://119.2.50.170:9093/penilaian_klinik/assets/img/favicon.png" type="image/x-icon" />
<link rel="manifest" href="{{ url('assets/favicon/manifest.json') }}">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="{{ url('assets/favicon/ms-icon-144x144.png') }}">
<meta name="theme-color" content="#ffffff">
<!-- Vendors styles-->
<link rel="stylesheet" href="{{ url('vendors/simplebar/css/simplebar.css') }}">
<link rel="stylesheet" href="{{ url('css/vendors/simplebar.css') }}">
<!-- Main styles for this application-->
<link href="{{ url('css/style.css') }}" rel="stylesheet">
<!-- We use those styles to show code examples, you should remove them in your application.-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css">
<link href="{{ url('css/examples.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.0/css/all.css">
<style>
    .btn-out {
        background: none !important;
        cursor: pointer;
        clear: both;
        font-weight: 400;
        color: var(--cui-dropdown-link-color);
        text-align: inherit;
        text-decoration: none;
        white-space: nowrap;
        background-color: transparent;
        border: 0;
    }
</style>
