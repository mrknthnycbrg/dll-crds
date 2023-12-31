<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'DLL-CRDS') }}</title>

        <!-- Favicons -->
        <link type="image/png" href="{{ asset('images/logo.png') }}" rel="icon" sizes="16x16">
        <link type="image/png" href="{{ asset('images/logo.png') }}" rel="icon" sizes="32x32">
        <link type="image/png" href="{{ asset('images/logo.png') }}" rel="icon" sizes="96x96">
        <link type="image/png" href="{{ asset('images/logo.png') }}" rel="icon" sizes="180x180">
        <link type="image/png" href="{{ asset('images/logo.png') }}" rel="icon" sizes="192x192">

        <!-- Fonts -->
        <link href="https://fonts.bunny.net" rel="preconnect">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>

    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100 text-gray-900">
            <livewire:components.navigation-menu />

            <!-- Page Heading -->
            @if (isset($header))
                <header>
                    <div
                        class="mx-auto max-w-full space-y-2 border-b border-gray-200 bg-gray-50 px-4 py-8 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts

        <x-impersonate::banner style='auto' />
    </body>

</html>
