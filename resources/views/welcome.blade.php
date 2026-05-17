<x-layouts.dashboard>
    <div class="grid grid-cols-2 container mx-auto">
        <div class="space-y-8">
            <div class="max-w-52 text-center bg-secondary/30 rounded-full px-4 py-1 text-sm font-medium text-primary">
                <p>
                    Pemerintah Desa Sukaraja
                </p>
            </div>

            <h2 class="text-5xl font-bold line-clamp-6">PANDAWA STATISTIK <span
                    class="bg-linear-to-r from-primary to-secondary text-transparent bg-clip-text">DESA SUKARAJA</span>
            </h2>
            <h3 class="font-bold text-slate-500 text-xl">Pusat Analisis dan Wawasan Data Statistik</h3>
            <p class="text-lg text-slate-500 italic">Orchestrating local data for data-driven policies: Empowering
                Villages through integrated, transparent, and evidence-based for impactful statistics.</p>

            <div class="space-x-4 flex items-center">
                <x-button variant="primary" size="md">
                    <a href="{{ route('auth.login') }}" class="block w-full h-full">Login Petugas</a>
                </x-button>
                <x-button variant="outline" size="md">Pelajari Lebih</x-button>
            </div>
        </div>

        <div>

        </div>
    </div>
</x-layouts.dashboard>
