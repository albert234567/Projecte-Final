<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sabor i Salut</title>

    <link rel="icon" type="image/png" href="{{ asset('img/Sabor_i_Salut2.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Estil personalitzat -->
    <style>
        :root {
            --primary-color: #4CAF50;
            --background-color: #ffffff;
            --text-color: #333333;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            margin: 0;
        }

        header {
            background-color: var(--background-color);
            border-bottom: 1px solid #e2e8f0; /* suau */
        }

        h1, h2, h3 {
            color: var(--primary-color);
        }

        .bg-white {
            background-color: var(--background-color) !important;
        }

        .text-primary {
            color: var(--primary-color);
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-white"> {{-- abans bg-gray-100 dark:bg-gray-900 --}}
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

    </div>
</body>
</html>
