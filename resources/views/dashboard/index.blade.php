<x-layouts.admin>
    <div class="grid grid-cols-2">
        <div class="space-y-8">
            <div class="px-4 py-1 text-sm font-medium text-center bg-green-100 rounded-full max-w-50 text-primary">
                Pemerintah Desa Sukaraja</div>

            <h2 class="text-5xl font-bold line-clamp-6">PANDAWA STATISTIK <span
                    class="text-transparent bg-linear-to-r from-primary to-secondary bg-clip-text">DESA SUKARAJA</span>
            </h2>
            <h3 class="text-xl font-bold text-slate-500">Pusat Analisis dan Wawasan Data Statistik</h3>
            <p class="text-lg italic text-slate-500">Orchestrating local data for data-driven policies: Empowering
                Villages through integrated, transparent, and evidence-based for impactful statistics.</p>

            <div class="space-x-4">
                @auth
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="rounded-lg font-bold bg-red-500 text-white hover:bg-red-600 px-4 py-2 text-sm">
                            Logout
                        </button>
                    </form>
                @else
                    <x-button variant="primary" size="md">
                        <a href="{{ route('auth.login') }}" class="block w-full h-full">Login Petugas</a>
                    </x-button>
                @endauth
                <x-button variant="outline" size="md">Pelajari Lebih</x-button>
            </div>
        </div>

        <div>

        </div>
    </div>
</x-layouts.admin>
