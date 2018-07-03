<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Fasthosts Test</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <div class="container rounded-bottom outer-container">
        <header class="text-center p-3">
            <h1>Fasthosts Test - Ellen Merchant</h1>
        </header>
        <main class="p-3">
            @include('layouts._time')
            <h3>{{ $title ?? '' }}</h3>
            @yield('content')
        </main>
        <footer class="text-right pb-3">
            <span class="small">Produced by Ellen Merchant for Fasthosts application</span>
        </footer>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
@yield('js')
</body>
</html>
