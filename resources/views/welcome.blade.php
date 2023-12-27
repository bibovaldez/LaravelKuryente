<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Kuryente</title>
    {{-- add logo --}}
    <link rel="icon" href="public/imgs/applicationlogo.png" type="image/x-icon" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-white">
    {{-- Banner at top --}}
    <div
        class="hidden lg:flex items-center justify-center bg-gradient-to-b from-green-500 to-green-600 p-2 text-center text-white text-sm">
        <div>
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
            </svg>
        </div>

        <div class="mt-px ml-1">
            Smart energy management at your fingertips.
        </div>
    </div>

    {{-- Header --}}
    <div
        class="relative max-w-screen-2xl mx-auto w-full pt-2  bg-white transition duration-200 lg:bg-transparent lg:py-6">
        <div class="max-w-screen-xl mx-auto px-5 flex items-center justify-between">
            <div class="flex-1 ml-24">
                <a href="/" class="inline-flex items-center">
                    <x-application-logo style="height: 7%; width: 7%;" class=" w-12 h-12 text-green-dark fill-current" />
                </a>
            </div>
            <ul class="relative hidden lg:flex lg:items-center lg:justify-center lg:gap-3  xl:gap-5">
                <li>
                    <x-dropdown align="right" width="48" contentClasses="py-1">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2">
                                <p class="font-monsterat text-1xl text-black-light opacity-75 hover:underline">
                                    Services</p>
                                <div class="ms-2">
                                    <svg class="fill-current h-5 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link>
                                {{ __('Billing Rates') }}
                            </x-dropdown-link>

                            <x-dropdown-link>
                                {{ __('Contact') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </li>
                <li>
                    @if (Route::has('login'))
                        <div class="">
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="font-monsterat text-1xl text-black-light opacity-75 hover:underline ml-3">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}"
                                    class=" font-monsterat text-1xl text-black-light opacity-75 hover:underline active:cursor-progress hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ">Sign
                                    in</a>
                            @endauth
                        </div>
                    @endif
                </li>
            </ul>
        </div>
    </div>

    {{-- content --}}
    <section class="content-center text-center mt-12 h-fit">

        <h1 class="text-blue-light font-extrabold text-8xl font-glacial tracking-normal">
            The Smart Electric Meter
        </h1>
        <h2 class="text-green-dark font-black text-6xl font-glacial tracking-normal -mt-11">
            for Power-saving companion
        </h2>
        <p class="text-black-light px-72 font-glacial font-normal text-2xl  opacity-60 tracking-tighter">
            iKuryente is a web application designed for monitoring and controlling
            purposes,
        </p>
        <p class="text-black-light px-72 font-glacial font-normal text-2xl  opacity-60 tracking-tighter"> offering a streamlined and intuitive interface for
            effortless management.</p>
        <div class="mt-5">
            <a href="http://localhost:8000/login"
                class="text-center font-boldglacial font-bold text-xl tracking-wide items-center justify-center">
                <button
                    class="text-white-light bg-green-dark rounded-md py-1 px-16  active:cursor-progress hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Get Started
                </button>
            </a>
        </div>

    </section>



    <x-application-svg-lightning class="absolute top-32 right-96 h-20" />
    <x-application-svg-lightning class="absolute bottom-32 left-24 h-32" />
    <x-application-svg-lightning class="absolute bottom-20 right-32 h-20" />


</body>

</html>
