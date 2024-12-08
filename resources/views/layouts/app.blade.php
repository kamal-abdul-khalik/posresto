<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? config('app.name') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="min-h-screen bg-base-200">
        @auth
            <div class="drawer lg:drawer-open">
                <input id="sidebar-drawer" type="checkbox" class="drawer-toggle" />
                <div class="drawer-content">
                    @livewire('partials.navbar')
                    <x-banner />
                    {{ $slot }}
                    @if (!Route::is('transaction.create'))
                        <a href="{{ route('transaction.create') }}" wire:navigate type="button"
                            class="fixed right-4 bottom-4 z-50 btn btn-circle print:hidden btn-info">
                            <x-tabler-cash-register class="size-6" />
                        </a>
                    @endif
                </div>
                <div class="drawer-side">
                    <label for="sidebar-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
                    @livewire('partials.sidebar')
                </div>
            </div>
        @endauth

        @guest
            <div class="flex flex-col gap-8 justify-center items-center h-screen print:hidden">
                <x-tabler-chef-hat class="size-20" />
                <h1 class="text-4xl font-bold">{{ config('app.name') }}</h1>
                {{ $slot }}
            </div>
        @endguest
        <x-toaster-hub />
        @stack('scripts')
    </body>

</html>
