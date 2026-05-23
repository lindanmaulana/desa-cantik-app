<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-quaternary">

    <x-layouts.partials.navbar />

    <main class="container mx-auto p-8 max-md:p-4 max-lg:p-6">
        {{ $slot }}

        <div x-data="{ open: false }"
            class="fixed bottom-8 right-8 max-md:bottom-4 max-md:right-4 flex flex-col-reverse items-center gap-3 z-50">

            <button @click="open = !open"
                class="w-14 h-14 max-md:w-12 max-md:h-12 rounded-full bg-primary text-white shadow-lg flex items-center justify-center focus:outline-none transition-transform duration-300 transform active:scale-95"
                :class="open ? 'rotate-45 bg-black/30 backdrop-blur-md' : ''">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </button>

            <div x-show="open" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 scale-95" class="flex flex-col gap-2 items-center"
                style="display: none;" @click.away="open = false">
                <a href="https://instagram.com/andrnshhrwn._" target="_blank"
                    class="w-12 h-12 max-md:w-10 max-md:h-10 rounded-full bg-black/30 backdrop-blur-md text-white shadow-lg flex items-center justify-center transition-all duration-300 transform hover:scale-110">
                    <x-simpleline-social-instagram class="w-5 h-5 max-md:w-4 max-md:h-4" />
                </a>

                <a href="https://wa.me/nomorhp" target="_blank"
                    class="w-12 h-12 max-md:w-10 max-md:h-10 rounded-full bg-black/30 backdrop-blur-md text-white shadow-lg flex items-center justify-center transition-all duration-300 transform hover:scale-110">
                    <x-bi-whatsapp class="w-5 h-5 max-md:w-4 max-md:h-4" />
                </a>
            </div>

        </div>
    </main>

    @stack('scripts')
</body>

</html>
