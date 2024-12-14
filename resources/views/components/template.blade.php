<!DOCTYPE html>
<html lang="en">
<head>
@php
    use Illuminate\Support\Facades\Request;
@endphp
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    {{-- <script src="node_modules/preline/dist/preline.js"></script> --}}
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="./node_modules/preline/dist/helper-apexcharts.js"></script> --}}
    {{-- <link rel="stylesheet" href="./node_modules/apexcharts/dist/apexcharts.css"> --}}

</head>
<style>
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
    }
</style>
<body>
    @section('title', 'content')
    @if (Request::is('/'))
        @include('components.navbar')
    @endif
    @auth
        @include('components.nav2')
    @endauth
    @yield('content')
</body>
{{-- <script src="./node_modules/lodash/lodash.min.js"></script>
<script src="./node_modules/apexcharts/dist/apexcharts.min.js"></script>
<script src="./node_modules/lodash/lodash.min.js"></script>
<script src="./node_modules/dropzone/dist/dropzone-min.js"></script> --}}
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success') }}',
        confirmButtonColor: '#A2E554',
        confirmButtonText: 'OK'
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: '{{ session('error') }}',
        confirmButtonColor: '#A2E554',
        confirmButtonText: 'OK'
    });
</script>
@endif
</html>
