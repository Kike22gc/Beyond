<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="token" id="token" value="{{ csrf_token() }}">
        <title>Beyond The Bench</title>

        @if (env('SESSION_SECURE_COOKIE'))
            <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
        @else
            <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @endif

<script type="application/javascript">
            window.Laravel = { csrfToken: '{{ csrf_token() }}'};
        </script>
    </head>
    <body class="antialiased">
        <div id = "app">
            <app></app>
        </div>
        @if (env('SESSION_SECURE_COOKIE'))
            <script src="{{secure_asset('js/app.js')}}"></script>
        @else
            <script src="{{asset('js/app.js')}}"></script>
        @endif
    </body>
</html>
