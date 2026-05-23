<x-layouts.app>
    <div
        class="relative flex flex-col items-center justify-center min-h-screen px-4 overflow-hidden bg-quaternary font-sans antialiased">

        <div class="absolute inset-0 pointer-events-none overflow-hidden z-0">
            <div class="wave-obj wave-1 bg-primary/60"></div>
            <div class="wave-obj wave-2 bg-primary/40"></div>
            <div class="wave-obj wave-3 bg-primary/50"></div>
            <div class="wave-obj wave-4 bg-primary/30"></div>
            <div class="wave-obj wave-5 bg-primary/20"></div>
        </div>

        <div class="relative z-10 w-full max-w-md">
            {{ $slot }}
        </div>
    </div>
</x-layouts.app>
