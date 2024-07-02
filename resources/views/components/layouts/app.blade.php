<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? config('app.name') }}</title>
        @vite('resources/css/app.css')
    </head>

    <body class="min-h-screen bg-base-200">
        @auth
            {{ $slot }}
        @endauth

        @guest
            <div class="flex flex-col items-center justify-center h-screen">
                <h1 class="text-4xl font-bold">{{ config('app.name') }}</h1>
                <div class="p-4">
                    {{ $slot }}
                </div>
            </div>
        @endguest
    </body>

</html>
