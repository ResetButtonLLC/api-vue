<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <base href="{{ url('/') }}">
        <title>{{ config('app.name') }}</title>
        <link href="{{ asset('assets/css/chunk-vendors.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
        <link type="image/x-icon" rel="shortcut icon" href="/favicon.ico" />
        <link type="image/png" rel="icon" href="/favicon.png" />
    </head>
    <body>

        <div id="app">
            <div class="preloader">
                <div class="preloader-content">
                </div>
            </div>
        </div>

        <script>
            window.config = @json([
                'appName' => config('app.name'),
            ])
        </script>
        <script src="{{ asset("assets/js/chunk-vendors.js") }}" charset="utf-8"></script>
        <script src="{{ asset("assets/js/app.js") }}" charset="utf-8"></script>
    </body>
</html>