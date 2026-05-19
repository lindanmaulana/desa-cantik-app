<nav class="sticky top-0 z-50 bg-white shadow-md shadow-primary/30">
    <div class="px-6 h-16 flex items-center justify-between">

        <div class="flex justify-start items-center gap-1 text-primary">
            <x-fab-dev class="size-7" />
            <div class="text-xl font-bold">Desa Sukaraja</div>
        </div>

        <div class="flex items-center gap-6">
            <a href="/" class="text-slate-600 hover:text-primary">Beranda</a>
            <a href="/artikel" class="text-slate-600 hover:text-primary">Artikel</a>
            <a href="/layanan" class="text-slate-600 hover:text-primary">Layanan</a>
        </div>

        <div>
            <x-button variant="primary" size="md">
                <a href="{{ route('auth.login') }}" class="capitalize">login</a>
            </x-button>
        </div>
    </div>
</nav>
