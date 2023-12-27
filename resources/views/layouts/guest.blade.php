<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Kuryente') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased overflow-x-hidden overflow-y-hidden">
    {{-- background --}}
    <div
        class="absolute object-none bg-cover drop-shadow-lg z-0 w-full sm:w-2/3 -left-72  h-screen bg-gradient-to-tr from-violet-light to-red-light rounded-3xl rotate-45">
    </div>
    {{-- form --}}
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 z-10">
        {{-- logo --}}
        <div class="z-10">
            <a href="/">
                <x-application-logo style="height: 7%; width: 7%;" class="w-20 h-20 fill-current" />
            </a>
        </div>
        {{-- form --}}
        <div class=" z-10 w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>

</body>


</html>
