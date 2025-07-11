<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="/quively.svg">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

                <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

                @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="text-gray-900 antialiased">
        <x-navbar/>
        <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-11/12 overflow-hidden rounded-lg bg-white px-6 py-4 shadow-md sm:w-full sm:max-w-md">
        {{ $slot }}
    </div>
</div>
    </body>
</html>
