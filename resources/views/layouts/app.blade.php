<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $metaTitle ?: 'Technology Blog' }}</title>
    <meta name="author" content="">
    <meta name="" content="{{ $metaDescription }}">

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        .font-family-karla {
            font-family: karla;
        }

        pre {
            padding: 1rem;
            margin-bottom: 1rem;
            background-color: black;
            color: white;
            border-radius: 8px;
        }
    </style>

</head>

<body class="bg-white font-family-karla">

    <!-- Top Bar Nav -->
    {{-- <nav class="w-full py-4 bg-blue-800 shadow">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between">


            <div class="flex items-center text-lg no-underline text-white pr-6">
                <a class="" href="#">
                    <i class="fab fa-facebook"></i>
                </a>
                <a class="pl-6" href="#">
                    <i class="fab fa-instagram"></i>
                </a>
                <a class="pl-6" href="#">
                    <i class="fab fa-twitter"></i>
                </a>
                <a class="pl-6" href="#">
                    <i class="fab fa-linkedin"></i>
                </a>
            </div>
        </div>

    </nav> --}}

    <!-- Text Header -->
    <header class="w-full container mx-auto">
        <div class="flex flex-col items-center py-12">
            <a class="font-bold text-gray-800 uppercase hover:text-gray-700 text-5xl" href="#">
                Minimal Blog
            </a>
            <p class="text-lg text-gray-600">
                {{ App\Models\TextWidget::getTitle('header') }}
            </p>
        </div>
    </header>

    <!-- Topic Nav -->
    <nav class="w-full py-4 border-t border-b bg-gray-100" x-data="{ open: false }">

        <div class="block sm:hidden">
            <a href="#"
                class=" md:hidden text-base font-bold uppercase text-center flex justify-center items-center"
                @click="open = !open">
                Topics <i :class="open ? 'fa-chevron-down' : 'fa-chevron-up'" class="fas ml-2"></i>
            </a>
        </div>
        <div :class="open ? 'block' : 'hidden'" class="w-full flex-grow sm:flex sm:items-center sm:w-auto">

            <div
                class="w-full container mx-auto flex  sm:flex-row items-center justify-between text-sm font-bold uppercase mt-0 px-6 py-2">
                <div> <a href="{{ route('home') }}"
                        class="hover:bg-blue-700 rounded py-2 px-4 mx-2 hover:text-white">Home</a>
                    @foreach ($categories as $category)
                        <a href="{{ route('by-category', $category) }}"
                            class="hover:bg-blue-700 hover:text-white rounded py-2 px-4 mx-2">{{ $category->title }}</a>
                    @endforeach
                    <a href="{{ route('about-us') }}"
                        class="hover:bg-blue-700 hover:text-white rounded py-2 px-4 mx-2">About us</a>
                </div>
                <div>
                    @auth
                        <div class="flex sm:items-center sm:ms-6">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="hover:bg-blue-700 hover:text-white rounded py-2 px-4 mx-2 flex items-center">
                                        <div>{{ Auth::user()->name }}</div>

                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="hover:bg-blue-700 hover:text-white rounded py-2 px-4 mx-2">Login</a>
                        <a href="{{ route('register') }}"
                            class="bg-blue-700 text-white rounded py-2 px-4 mx-2">Register</a>

                    @endauth
                </div>


            </div>
        </div>
    </nav>

    <div class="w-full container mx-auto">
        <form action="{{ route('search') }}" class="p-3"><input name="q" value="{{request('q')}}"
                class="w-full rounded focus:outline-none focus:border-gray-400 focus:ring-2 focus:ring-gray-500 text-gray-500"
                placeholder="type something to search " /></form>

        {{ $slot }}
    </div>


    <!-- Post Section -->


    <!-- Sidebar Section -->



    <footer class="w-full border-t bg-white pb-12">

        <div class="w-full container mx-auto flex flex-col items-center">
            <div class="uppercase py-6">&copy; myblog.com</div>
        </div>
    </footer>


    @livewireScripts
</body>

</html>
