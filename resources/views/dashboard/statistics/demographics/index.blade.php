<x-layouts.dashboard>
    {{-- Main Container --}}
    <div class="space-y-6 max-md:space-y-4 px-4 sm:px-6 max-md:px-2" x-data="{ isGenerated: new URLSearchParams(window.location.search).has('type') }">

        {{-- HEADER: Tetap muncul sebelum & sesudah generate, ukuran teks mengecil di mobile --}}
        <div class="flex items-center gap-3 sm:gap-4 pb-4 sm:pb-6 mb-6 sm:mb-10 border-b border-slate-200">
            <x-ionicon-people-sharp
                class="p-2 sm:p-3 rounded-md size-10 sm:size-12 bg-primary/20 text-primary shrink-0" />
            <div>
                <h3 class="text-lg sm:text-xl font-bold text-slate-800">Demografi</h3>
                <p class="text-sm sm:text-lg text-slate-600">Analisis agregat demografi Desa Sukaraja</p>
            </div>
        </div>

        {{-- TAMPILAN SEBELUM GENERATE --}}
        <div class="space-y-4" x-show="!isGenerated" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-4 absolute w-full">

            <div
                class="flex items-center justify-center border-2 border-dashed rounded-2xl border-slate-300 min-h-[300px] sm:min-h-96 p-4">
                <div class="flex flex-col items-center justify-center gap-2 text-center max-w-md">
                    <x-ionicon-people-sharp
                        class="p-3 mb-2 sm:mb-4 rounded-md size-12 sm:size-16 bg-primary/20 text-primary" />
                    <h4 class="text-lg sm:text-xl font-bold text-slate-800">Hitung Agregat Demografi</h4>
                    <p class="text-xs sm:text-base text-slate-600 mb-4 px-2">
                        Sistem akan memproses seluruh data untuk menghasilkan statistik Demografi. Proses ini hanya
                        dilakukan sekali per sesi.
                    </p>

                    <a href="{{ route('dashboard.statistics.demograph', ['type' => 'ageGroup']) }}"
                        class="flex items-center gap-2 px-5 py-2.5 sm:px-6 sm:py-3 text-sm sm:text-lg font-semibold text-white rounded-full shadow-lg bg-gradient-to-r from-primary to-secondary active:scale-95 transition-transform">
                        <x-ri-play-circle-fill class="size-4 sm:size-5" />
                        Generate Aggregate
                    </a>
                </div>
            </div>
        </div>

        {{-- TAMPILAN SETELAH GENERATE --}}
        <div class="space-y-4 sm:space-y-6" x-show="isGenerated" x-cloak style="display: none;"
            x-transition:enter="transition ease-out duration-500 delay-200"
            x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">

            @include('dashboard.statistics.demographics.partials.stats-card')

            {{-- Filter Jenis Agregat --}}
            <div class="p-4 sm:p-8 bg-white border border-gray-100 shadow-sm rounded-2xl sm:rounded-3xl">
                <h3 class="mb-4 sm:mb-6 text-[10px] sm:text-xs font-bold tracking-widest text-gray-400 uppercase">
                    Pilih Jenis Agregat
                </h3>

                {{-- flex-wrap & gap-2 membuat tombol otomatis turun rapi di layar kecil --}}
                <div class="flex flex-wrap gap-2 sm:gap-3">
                    <a href="{{ route('dashboard.statistics.demograph', ['type' => 'ageGroup']) }}"
                        class="max-md:w-full">
                        <x-buttons.filter-button icon="ri-group-fill" :active="$currentType->value === 'ageGroup'"
                            class="max-md:w-full justify-center text-xs sm:text-sm">
                            Kelompok Umur
                        </x-buttons.filter-button>
                    </a>

                    <a href="{{ route('dashboard.statistics.demograph', ['type' => 'gender']) }}" class="max-md:w-full">
                        <x-buttons.filter-button icon="ri-genderless-line" :active="$currentType->value === 'gender'"
                            class="max-md:w-full justify-center text-xs sm:text-sm">
                            Jenis Kelamin
                        </x-buttons.filter-button>
                    </a>

                    <a href="{{ route('dashboard.statistics.demograph', ['type' => 'maritalStatus']) }}"
                        class="max-md:w-full">
                        <x-buttons.filter-button icon="ri-heart-3-fill" :active="$currentType->value === 'maritalStatus'"
                            class="max-md:w-full justify-center text-xs sm:text-sm">
                            Status Perkawinan
                        </x-buttons.filter-button>
                    </a>

                    <a href="{{ route('dashboard.statistics.demograph', ['type' => 'presence']) }}"
                        class="max-md:w-full">
                        <x-buttons.filter-button icon="ri-map-pin-user-fill" :active="$currentType->value === 'presence'"
                            class="max-md:w-full justify-center text-xs sm:text-sm">
                            Keberadaan
                        </x-buttons.filter-button>
                    </a>

                    <a href="{{ route('dashboard.statistics.demograph', ['type' => 'residencyStatus']) }}"
                        class="max-md:w-full">
                        <x-buttons.filter-button icon="ri-user-settings-fill" :active="$currentType->value === 'residencyStatus'"
                            class="max-md:w-full justify-center text-xs sm:text-sm">
                            Status Penduduk
                        </x-buttons.filter-button>
                    </a>
                </div>
            </div>

            {{-- Card Chart --}}
            <x-cards.chart-card id="chart" :title="match ($currentType->value) {
                'ageGroup' => 'Kelompok Umur',
                'gender' => 'Jenis Kelamin',
                default => 'Demografi',
            }" :subtitle="match ($currentType->value) {
                'ageGroup' => 'Kelompok Umur — Demografi',
                'gender' => 'Jenis Kelamin — Demografi',
                default => 'Statistik Demografi',
            }" />

            {{-- Tabel Agregat Desa --}}
            <div class="p-4 sm:p-6 space-y-4 bg-white border border-gray-100 shadow-sm rounded-2xl sm:rounded-3xl">
                <div class="border-b border-gray-50 pb-2">
                    <h3 class="text-[10px] sm:text-xs font-bold tracking-widest text-gray-400 uppercase">Agregat Desa
                    </h3>
                </div>

                {{-- Wrapper Utama Kontrol Scroll --}}
                <div class="w-full overflow-x-auto rounded-xl border border-gray-100 block whitespace-nowrap snap-x">
                    <table class="w-full text-xs sm:text-sm text-left table-auto min-w-[700px]">
                        <thead class="text-[11px] sm:text-xs font-bold text-white uppercase bg-[#1e293b] sticky top-0">
                            <tr>
                                <th class="px-3 py-3 sm:px-6 sm:py-4 text-center w-12">No</th>
                                <th class="px-4 py-3 sm:px-6 sm:py-4">Kategori</th>
                                <th class="px-3 py-3 sm:px-6 sm:py-4 text-center">Laki-laki</th>
                                <th class="px-3 py-3 sm:px-6 sm:py-4 text-center">Perempuan</th>
                                <th class="px-3 py-3 sm:px-6 sm:py-4 text-center">Jumlah</th>
                                <th class="px-3 py-3 sm:px-6 sm:py-4 text-center">% Desa</th>
                                <th class="px-4 py-3 sm:px-6 sm:py-4 w-32">Proporsi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr class="transition-colors hover:bg-gray-50/50">
                                <td class="px-3 py-3 sm:px-6 sm:py-4 text-center text-gray-500">1</td>
                                <td class="px-4 py-3 sm:px-6 sm:py-4 font-medium text-gray-700 max-w-[180px] truncate">
                                    Pra Lansia (55-64)</td>
                                <td class="px-3 py-3 sm:px-6 sm:py-4 text-center text-gray-600">366</td>
                                <td class="px-3 py-3 sm:px-6 sm:py-4 text-center text-gray-600">353</td>
                                <td class="px-3 py-3 sm:px-6 sm:py-4 font-bold text-center text-gray-800">719</td>
                                <td class="px-3 py-3 sm:px-6 sm:py-4 text-center">
                                    <span
                                        class="px-2 py-0.5 sm:px-3 sm:py-1 rounded-full bg-indigo-50 text-indigo-500 font-bold text-[10px] sm:text-[11px]">8.9%</span>
                                </td>
                                <td class="px-4 py-3 sm:px-6 sm:py-4">
                                    <div class="w-full max-w-[100px] sm:w-24 h-2 bg-gray-100 rounded-full">
                                        <div class="h-2 bg-indigo-500 rounded-full" style="width: 8.9%"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="transition-colors hover:bg-gray-50/50">
                                <td class="px-3 py-3 sm:px-6 sm:py-4 text-center text-gray-500">2</td>
                                <td class="px-4 py-3 sm:px-6 sm:py-4 font-medium text-gray-700 max-w-[180px] truncate">
                                    Dewasa Produktif (25-54)</td>
                                <td class="px-3 py-3 sm:px-6 sm:py-4 text-center text-gray-600">2.029</td>
                                <td class="px-3 py-3 sm:px-6 sm:py-4 text-center text-gray-600">1.758</td>
                                <td class="px-3 py-3 sm:px-6 sm:py-4 font-bold text-center text-gray-800">3.787</td>
                                <td class="px-3 py-3 sm:px-6 sm:py-4 text-center">
                                    <span
                                        class="px-2 py-0.5 sm:px-3 sm:py-1 rounded-full bg-sky-50 text-sky-500 font-bold text-[10px] sm:text-[11px]">46.8%</span>
                                </td>
                                <td class="px-4 py-3 sm:px-6 sm:py-4">
                                    <div class="w-full max-w-[100px] sm:w-24 h-2 bg-gray-100 rounded-full">
                                        <div class="h-2 rounded-full bg-sky-400 w-[46.8%]"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="transition-colors hover:bg-gray-50/50">
                                <td class="px-3 py-3 sm:px-6 sm:py-4 text-center text-gray-500">3</td>
                                <td class="px-4 py-3 sm:px-6 sm:py-4 font-medium text-gray-700 max-w-[180px] truncate">
                                    Lansia (65+)</td>
                                <td class="px-3 py-3 sm:px-6 sm:py-4 text-center text-gray-600">409</td>
                                <td class="px-3 py-3 sm:px-6 sm:py-4 text-center text-gray-600">368</td>
                                <td class="px-3 py-3 sm:px-6 sm:py-4 font-bold text-center text-gray-800">777</td>
                                <td class="px-3 py-3 sm:px-6 sm:py-4 text-center">
                                    <span
                                        class="px-2 py-0.5 sm:px-3 sm:py-1 rounded-full bg-amber-50 text-amber-500 font-bold text-[10px] sm:text-[11px]">9.6%</span>
                                </td>
                                <td class="px-4 py-3 sm:px-6 sm:py-4">
                                    <div class="w-full max-w-[100px] sm:w-24 h-2 bg-gray-100 rounded-full">
                                        <div class="h-2 rounded-full bg-amber-400 w-[9.6%]"></div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot class="bg-slate-50 font-bold text-slate-800">
                            <tr>
                                <td class="px-4 py-3.5 sm:px-6 sm:py-4 text-left" colspan="2">Total</td>
                                <td class="px-3 py-3.5 sm:px-6 sm:py-4 text-center">4.243</td>
                                <td class="px-3 py-3.5 sm:px-6 sm:py-4 text-center">3.844</td>
                                <td class="px-3 py-3.5 sm:px-6 sm:py-4 text-center text-primary">8.087</td>
                                <td class="px-3 py-3.5 sm:px-6 sm:py-4 text-center">100%</td>
                                <td class="px-4 py-3.5 sm:px-6 sm:py-4"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            {{-- Tabel Agregat RT --}}
            <div class="p-4 sm:p-6 space-y-4 bg-white border border-gray-100 shadow-sm rounded-2xl sm:rounded-3xl">
                <div
                    class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-gray-50 pb-2">
                    <h3 class="text-[10px] sm:text-xs font-bold tracking-widest text-gray-400 uppercase">Agregat RT
                    </h3>

                    <div class="relative w-full sm:w-48">
                        <select
                            class="appearance-none w-full bg-white border border-indigo-200 text-indigo-900 text-xs sm:text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block p-2.5 pr-10 outline-none">
                            <option selected>KLIWON</option>
                            <option value="manis">MANIS</option>
                            <option value="pahing">PAHING</option>
                        </select>
                        <div
                            class="absolute inset-y-0 right-0 flex items-center px-3 text-indigo-500 pointer-events-none">
                            <i class="ri-arrow-down-s-line"></i>
                        </div>
                    </div>
                </div>

                {{-- Wrapper Utama Kontrol Scroll dengan penanganan presisi untuk Rowspan --}}
                <div class="w-full overflow-x-auto rounded-xl border border-gray-100 block whitespace-nowrap snap-x">
                    <table class="w-full text-xs sm:text-sm text-left border-collapse table-auto min-w-[650px]">
                        <thead class="text-[11px] sm:text-xs font-bold text-white uppercase bg-[#1e293b]">
                            <tr>
                                <th class="px-3 py-3 sm:px-5 sm:py-4 text-center w-16">RW</th>
                                <th class="px-3 py-3 sm:px-5 sm:py-4 text-center w-16">RT</th>
                                <th class="px-4 py-3 sm:px-6 sm:py-4">Kategori</th>
                                <th class="px-3 py-3 sm:px-6 sm:py-4 text-center w-16">L</th>
                                <th class="px-3 py-3 sm:px-6 sm:py-4 text-center w-16">P</th>
                                <th class="px-3 py-3 sm:px-6 sm:py-4 text-center w-24">Jumlah</th>
                                <th class="px-3 py-3 sm:px-6 sm:py-4 text-center w-20">%</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 align-middle">
                            <tr class="hover:bg-gray-50/30">
                                <td rowspan="3"
                                    class="px-3 py-3 sm:px-5 sm:py-4 font-bold text-center text-gray-800 border-r border-gray-100 bg-slate-50/50">
                                    001</td>
                                <td rowspan="3"
                                    class="px-3 py-3 sm:px-5 sm:py-4 font-bold text-center text-gray-800 border-r border-gray-100 bg-slate-50/50">
                                    001</td>
                                <td class="px-4 py-3 sm:px-6 sm:py-4 italic text-gray-600 max-w-[180px] truncate">Pra
                                    Lansia (55-64)</td>
                                <td class="px-3 py-3 sm:px-6 sm:py-4 text-center text-gray-600">58</td>
                                <td class="px-3 py-3 sm:px-6 sm:py-4 text-center text-gray-600">56</td>
                                <td class="px-3 py-3 sm:px-6 sm:py-4 font-bold text-center text-gray-800">114</td>
                                <td class="px-3 py-3 sm:px-6 sm:py-4 text-center text-gray-400 font-medium">10.5%</td>
                            </tr>
                            <tr class="hover:bg-gray-50/30">
                                {{-- Kolom RW & RT otomatis diisi oleh rowspan baris pertama --}}
                                <td class="px-4 py-3 sm:px-6 sm:py-4 italic text-gray-600 max-w-[180px] truncate">
                                    Dewasa Produktif (25-54)</td>
                                <td class="px-3 py-3 sm:px-6 sm:py-4 text-center text-gray-600">266</td>
                                <td class="px-3 py-3 sm:px-6 sm:py-4 text-center text-gray-600">248</td>
                                <td class="px-3 py-3 sm:px-6 sm:py-4 font-bold text-center text-gray-800">514</td>
                                <td class="px-3 py-3 sm:px-6 sm:py-4 text-center text-gray-400 font-medium">47.3%</td>
                            </tr>
                            <tr class="hover:bg-gray-50/30">
                                {{-- Kolom RW & RT otomatis diisi oleh rowspan baris pertama --}}
                                <td class="px-4 py-3 sm:px-6 sm:py-4 italic text-gray-600 max-w-[180px] truncate">
                                    Lansia (65+)</td>
                                <td class="px-3 py-3 sm:px-6 sm:py-4 text-center text-gray-600">51</td>
                                <td class="px-3 py-3 sm:px-6 sm:py-4 text-center text-gray-600">58</td>
                                <td class="px-3 py-3 sm:px-6 sm:py-4 font-bold text-center text-gray-800">109</td>
                                <td class="px-3 py-3 sm:px-6 sm:py-4 text-center text-gray-400 font-medium">10.0%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                function initChart() {
                    const type = "{{ request('type') }}" || "ageGroup";
                    const chartType = '{{ $chartType ?? 'bar' }}';
                    const data = JSON.parse('@json($data ?? [])');
                    const chartLabels = JSON.parse('@json($chartLabels ?? [])');

                    const element = document.querySelector('#chart');
                    if (!element) return;

                    element.innerHTML = '';

                    switch (type) {
                        case 'ageGroup':
                            window.ChartOptions = {
                                series: [{
                                        name: "Laki-laki",
                                        data: data.male ?? []
                                    },
                                    {
                                        name: "Perempuan",
                                        data: data.female ?? []
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
                                series: [Number(data.single ?? 0), Number(data.married ?? 0), Number(data
                                    .divorced ?? 0), Number(data.widowed ?? 0)]
                            }
                            break;
                        default:
                            window.ChartOptions = {
                                series: [{
                                        name: "Laki-laki",
                                        data: data.male ?? []
                                    },
                                    {
                                        name: "Perempuan",
                                        data: data.female ?? []
                                    },
                                ],
                            }
                    }

                    if (chartType === 'bar') {
                        renderBarChart(element, data, chartLabels, window.ChartOptions.series, window.ChartOptions
                            .colors);
                    } else if (chartType === 'donut') {
                        renderDonutChart(element, data, chartLabels, window.ChartOptions.series, window.ChartOptions
                            .colors);
                    }
                }

                if (new URLSearchParams(window.location.search).has('type')) {
                    initChart();
                }
            });
        </script>
        @include('dashboard.statistics.demographics.partials.chart-script')
    @endpush
</x-layouts.dashboard>
