<x-layouts.client>
    <div class="space-y-6 max-md:space-y-3" x-data="{ isGenerated: new URLSearchParams(window.location.search).has('type') }">
        <div class="space-y-4" x-show="!isGenerated" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-4 absolute w-full">

            <div class="flex items-center gap-4 pb-6 mb-10 border-b border-slate-200">
                <x-ionicon-people-sharp class="p-3 rounded-md size-12 bg-primary/20 text-primary" />
                <div>
                    <h3 class="text-xl max-md:text-base font-bold">Demografi</h3>
                    <p class="text-slate-600 text-lg max-md:text-sm">Analisis agregat demografi Desa Sukaraja</p>
                </div>
            </div>

            <div class="flex items-center justify-center border-2 border-dashed rounded-2xl border-slate-300 min-h-96">
                <div class="flex flex-col items-center justify-center gap-2">
                    <x-ionicon-people-sharp class="p-3 mb-4 rounded-md size-16 bg-primary/20 text-primary" />
                    <h4 class="text-xl max-md:text-base font-bold">Hitung Agregat Demografi</h4>
                    <p class="max-w-md mb-4 text-base max-md:text-sm text-center text-slate-600">
                        Sistem akan memproses seluruh data untuk menghasilkan statistik Demografi. Proses ini hanya
                        dilakukan sekali per sesi.
                    </p>

                    <button @click="isGenerated = true"
                        class="flex items-center gap-2 px-6 py-3 text-lg max-md:text-base font-semibold text-white rounded-full shadow-lg bg-gradient-to-r from-primary to-secondary">
                        <x-ri-play-circle-fill class="size-5" />
                        Generate Aggregate
                    </button>
                </div>
            </div>
        </div>

        <div class="space-y-4" x-show="isGenerated" x-cloak style="display: none;"
            x-transition:enter="transition ease-out duration-500 delay-200"
            x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">

            @include('dashboard.statistics.demographics.partials.stats-card')

            <div class="p-8 max-md:p-4 bg-white border border-gray-100 shadow-sm rounded-3xl max-md:rounded-xl">
                <h3 class="mb-6 text-xs max-md:text-center font-bold tracking-widest text-gray-400 uppercase">
                    Pilih Jenis Agregat
                </h3>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('statistik.demografi', ['type' => 'ageGroup']) }}">
                        <x-buttons.filter-button icon="ri-group-fill" :active="$currentType->value === 'ageGroup'">
                            Kelompok Umur
                        </x-buttons.filter-button>
                    </a>

                    <a href="{{ route('statistik.demografi', ['type' => 'gender']) }}">
                        <x-buttons.filter-button icon="ri-genderless-line" :active="$currentType->value === 'gender'">
                            Jenis Kelamin
                        </x-buttons.filter-button>
                    </a>

                    <a href="{{ route('statistik.demografi', ['type' => 'maritalStatus']) }}">
                        <x-buttons.filter-button icon="ri-heart-3-fill" :active="$currentType->value === 'maritalStatus'">
                            Status Perkawinan
                        </x-buttons.filter-button>
                    </a>

                    <a href="{{ route('statistik.demografi', ['type' => 'presence']) }}">
                        <x-buttons.filter-button icon="ri-map-pin-user-fill" :active="$currentType->value === 'presence'">
                            Keberadaan
                        </x-buttons.filter-button>
                    </a>

                    <a href="{{ route('statistik.demografi', ['type' => 'residencyStatus']) }}">
                        <x-buttons.filter-button icon="ri-user-settings-fill" :active="$currentType->value === 'residencyStatus'">
                            Status Penduduk
                        </x-buttons.filter-button>
                    </a>
                </div>
            </div>

            <x-cards.chart-card id="chart" :title="match ($currentType->value) {
                'ageGroup' => 'Kelompok Umur',
                'gender' => 'Jenis Kelamin',
                default => 'Demografi',
            }" :subtitle="match ($currentType->value) {
                'ageGroup' => 'Kelompok Umur — Demografi',
                'gender' => 'Jenis Kelamin — Demografi',
                default => 'Statistik Demografi',
            }" />

        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const currentType = '{{ request('type', 'ageGroup') }}';

                const chartType = '{{ $chartType }}';
                const data = JSON.parse('@json($data ?? [])');
                const chartLabels = JSON.parse('@json($chartLabels ?? [])');
                const type = "{{ request('type') }}"

                const element = document.querySelector('#chart')
                if (!element) return;

                switch (type) {
                    case 'ageGroup':
                        window.ChartOptions = {
                            series: [{
                                    name: "Laki-laki",
                                    data: data.male ?? [],
                                },
                                {
                                    name: "Perempuan",
                                    data: data.female ?? [],
                                },
                            ],
                        }
                        break;

                    case 'gender':
                        window.ChartOptions = {
                            series: [Number(data.male ?? 0), Number(data.female ?? 0)],
                            colors: [window.AppColors.primary, window.AppColors.secondary]
                        }
                        break;

                    case 'maritalStatus':
                        window.ChartOptions = {
                            series: [Number(data.single), Number(data.married), Number(data.divorced), Number(data
                                .widowed)]
                        }
                        break;

                    default:
                        window.ChartOptions = {
                            series: [{
                                    name: "Laki-laki",
                                    data: data.male ?? [],
                                },
                                {
                                    name: "Perempuan",
                                    data: data.female ?? [],
                                },
                            ],
                        }
                }

                switch (chartType) {
                    case 'bar':
                        renderBarChart(element, data, chartLabels, window.ChartOptions.series, window.ChartOptions
                            .colors);
                        break;
                    case 'donut':
                        renderDonutChart(element, data, chartLabels, window.ChartOptions.series, window.ChartOptions
                            .colors);
                        break;
                }
            });
        </script>
    @endpush
</x-layouts.client>
