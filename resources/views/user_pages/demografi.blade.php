<x-layouts.user>
    <div class="space-y-6 max-md:space-y-3" x-data="{ isGenerated: false }">
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
                    <a href="">
                        <x-buttons.filter-button icon="ri-group-fill" :active="true">
                            Kelompok Umur
                        </x-buttons.filter-button>
                    </a>

                    <a href="">
                        <x-buttons.filter-button icon="ri-genderless-line">
                            Jenis Kelamin
                        </x-buttons.filter-button>
                    </a>

                    <a href="">
                        <x-buttons.filter-button icon="ri-heart-3-fill">
                            Status Perkawinan
                        </x-buttons.filter-button>
                    </a>

                    <a href="">
                        <x-buttons.filter-button icon="ri-map-pin-user-fill">
                            Keberadaan
                        </x-buttons.filter-button>
                    </a>

                    <a href="">
                        <x-buttons.filter-button icon="ri-user-settings-fill">
                            Status Penduduk
                        </x-buttons.filter-button>
                    </a>
                </div>
            </div>

            <x-cards.chart-card id="chart-umur" title="Kelompok Umur" subtitle="Kelompok Umur — Demografi" />

            <div
                class="p-6 max-md:p-3 space-y-4 overflow-hidden bg-white border border-gray-100 shadow-sm rounded-3xl max-md:rounded-xl">
                <div class="border-b border-gray-50">
                    <h3 class="text-xs font-bold tracking-widest text-gray-400 uppercase">Agregat Desa</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-xs md:text-sm text-left">
                        <thead class="text-xs font-bold text-white uppercase bg-primary">
                            <tr>
                                <th class="px-6 py-4 text-center">No</th>
                                <th class="px-6 py-4">Kategori</th>
                                <th class="px-6 py-4 text-center">Laki-laki</th>
                                <th class="px-6 py-4 text-center">Perempuan</th>
                                <th class="px-6 py-4 text-center">Jumlah</th>
                                <th class="px-6 py-4 text-center">% Desa</th>
                                <th class="px-6 py-4">Proporsi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr class="transition-colors hover:bg-gray-50">
                                <td class="px-6 py-4 text-center text-gray-500">1</td>
                                <td class="px-6 py-4 font-medium text-gray-700">Pra Lansia (55-64)</td>
                                <td class="px-6 py-4 text-center text-gray-600">366</td>
                                <td class="px-6 py-4 text-center text-gray-600">353</td>
                                <td class="px-6 py-4 font-bold text-center text-primary">719</td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="px-3 py-1 rounded-full bg-indigo-50 text-indigo-500 font-bold text-[11px]">8.9%</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="w-24 h-2 bg-gray-100 rounded-full">
                                        <div class="h-2 bg-indigo-500 rounded-full" style="width: 8.9%"></div>
                                    </div>
                                </td>
                            </tr>

                            <tr class="transition-colors hover:bg-gray-50">
                                <td class="px-6 py-4 text-center text-gray-500">2</td>
                                <td class="px-6 py-4 font-medium text-gray-700">Dewasa Produktif (25-54)</td>
                                <td class="px-6 py-4 text-center text-gray-600">2.029</td>
                                <td class="px-6 py-4 text-center text-gray-600">1.758</td>
                                <td class="px-6 py-4 font-bold text-center text-primary">3.787</td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="px-3 py-1 rounded-full bg-sky-50 text-sky-500 font-bold text-[11px]">46.8%</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="w-24 h-2 bg-gray-100 rounded-full">
                                        <div class="h-2 rounded-full bg-sky-400 w-[46.8%]"></div>
                                    </div>
                                </td>
                            </tr>

                            <tr class="transition-colors hover:bg-gray-50">
                                <td class="px-6 py-4 text-center text-gray-500">3</td>
                                <td class="px-6 py-4 font-medium text-gray-700">Lansia (65+)</td>
                                <td class="px-6 py-4 text-center text-gray-600">409</td>
                                <td class="px-6 py-4 text-center text-gray-600">368</td>
                                <td class="px-6 py-4 font-bold text-center text-primary">777</td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="px-3 py-1 rounded-full bg-amber-50 text-amber-500 font-bold text-[11px]">9.6%</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="w-24 h-2 bg-gray-100 rounded-full">
                                        <div class="h-2 rounded-full bg-amber-400 w-[9.6%]"></div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot class="bg-quaternary">
                            <tr class="font-bold text-primary">
                                <td class="py-4 pl-10 text-left" colspan="2">Total</td>
                                <td class="px-6 py-4 text-center">4.243</td>
                                <td class="px-6 py-4 text-center">3.844</td>
                                <td class="px-6 py-4 text-center">8.087</td>
                                <td class="px-6 py-4 text-center">100%</td>
                                <td class="px-6 py-4"></td>
                            </tr>
                            </tbody>
                    </table>
                </div>
            </div>

            <div class="p-6 max-md:p-3 space-y-4 overflow-hidden bg-white border border-gray-100 shadow-sm rounded-3xl max-md:rounded-xl"
                x-data="{
                    open: false,
                    activeRT: 'KLIWON',
                    allData: {
                        'KLIWON': [
                            { rw: '001', rt: '001', kategori: 'Pra Lansia (55-64)', l: 58, p: 56, jumlah: 114, persen: '10.5%' },
                            { rw: '001', rt: '001', kategori: 'Dewasa Produktif (25-54)', l: 266, p: 248, jumlah: 514, persen: '47.3%' },
                            { rw: '001', rt: '001', kategori: 'Lansia (65+)', l: 51, p: 58, jumlah: 109, persen: '10.0%' }
                        ],
                        'MANIS': [
                            { rw: '001', rt: '002', kategori: 'Pra Lansia (55-64)', l: 42, p: 38, jumlah: 80, persen: '9.2%' },
                            { rw: '001', rt: '002', kategori: 'Dewasa Produktif (25-54)', l: 190, p: 210, jumlah: 400, persen: '46.0%' },
                            { rw: '001', rt: '002', kategori: 'Lansia (65+)', l: 35, p: 45, jumlah: 80, persen: '9.2%' }
                        ],
                        'PAHING': [
                            { rw: '002', rt: '001', kategori: 'Pra Lansia (55-64)', l: 60, p: 62, jumlah: 122, persen: '11.1%' },
                            { rw: '002', rt: '001', kategori: 'Dewasa Produktif (25-54)', l: 230, p: 250, jumlah: 480, persen: '43.6%' },
                            { rw: '002', rt: '001', kategori: 'Lansia (65+)', l: 48, p: 50, jumlah: 98, persen: '8.9%' }
                        ]
                    },
                    get currentRows() {
                        return this.allData[this.activeRT] || [];
                    }
                }">

                <div class="flex items-center justify-between border-b border-gray-50 pb-2">
                    <h3 class="text-xs font-bold tracking-widest text-gray-400 uppercase">Agregat RT</h3>

                    <div class="relative w-48 text-left" @click.away="open = false">
                        <button @click="open = !open" type="button"
                            class="w-full flex items-center justify-between bg-white border border-indigo-200 text-primary text-sm max-md:text-xs font-semibold rounded-xl p-2.5 px-4 shadow-sm hover:border-primary focus:outline-none transition-all duration-200">
                            <span x-text="activeRT"></span>
                            <svg class="size-4 text-primary transition-transform duration-300"
                                :class="{ 'rotate-180': open }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="open" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                            x-transition:leave-end="opacity-0 scale-95 translate-y-1"
                            class="absolute right-0 mt-2 w-full bg-white border border-slate-100 rounded-xl shadow-xl p-1.5 z-30 space-y-0.5 overflow-hidden"
                            style="display: none;">

                            <template x-for="item in ['KLIWON', 'MANIS', 'PAHING']">
                                <button type="button" @click="activeRT = item; open = false;"
                                    class="w-full text-left px-3 py-2 text-sm max-md:text-xs rounded-lg font-medium transition-colors duration-150 flex items-center justify-between"
                                    :class="activeRT === item ? 'bg-primary/10 text-primary font-bold' :
                                        'text-slate-600 hover:bg-slate-50'">
                                    <span x-text="item"></span>
                                    <svg x-show="activeRT === item" class="size-4 text-primary" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </button>
                            </template>
                        </div>
                    </div>
                </div>

                <div class="w-full overflow-x-auto">
                    <table class="w-full text-xs md:text-sm text-left border-collapse">
                        <thead class="text-xs font-bold text-white uppercase bg-primary">
                            <tr>
                                <th class="px-6 py-4 text-center">RW</th>
                                <th class="px-6 py-4 text-center">RT</th>
                                <th class="px-6 py-4">Kategori</th>
                                <th class="px-6 py-4 text-center">L</th>
                                <th class="px-6 py-4 text-center">P</th>
                                <th class="px-6 py-4 text-center">Jumlah</th>
                                <th class="px-6 py-4 text-center">%</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <template x-for="(row, index) in currentRows" :key="index">
                                <tr class="transition-colors hover:bg-gray-50">
                                    <td class="px-6 py-4 font-bold text-center text-gray-700 border-r border-gray-50"
                                        x-text="row.rw"></td>
                                    <td class="px-6 py-4 font-bold text-center text-gray-700 border-r border-gray-50"
                                        x-text="row.rt"></td>
                                    <td class="px-6 py-4 italic text-gray-600" x-text="row.kategori"></td>
                                    <td class="px-6 py-4 text-center text-gray-600" x-text="row.l"></td>
                                    <td class="px-6 py-4 text-center text-gray-600" x-text="row.p"></td>
                                    <td class="px-6 py-4 font-bold text-center text-primary" x-text="row.jumlah"></td>
                                    <td class="px-6 py-4 text-center text-gray-400" x-text="row.persen"></td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var options = {
                    series: [{
                        name: 'Laki-laki',
                        data: [400, 2000, 450, 200, 550, 650, 50]
                    }, {
                        name: 'Perempuan',
                        data: [380, 1750, 400, 180, 540, 600, 60]
                    }],
                    chart: {
                        type: 'bar',
                        height: 400,
                        toolbar: {
                            show: false
                        },
                        fontFamily: 'Inter, sans-serif'
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '55%',
                            borderRadius: 8,
                            dataLabels: {
                                position: 'top'
                            }
                        },
                    },
                    colors: ['#6366f1', '#f472b6'],
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: true,
                        width: 5,
                        colors: ['transparent']
                    },
                    xaxis: {
                        categories: ['Pra Lansia (55-64)', 'Dewasa Produktif (25-54)', 'Lansia (65+)',
                            'Balita (0-4)', 'Anak-anak (5-14)', 'Remaja (15-24)', 'Tidak Diisi'
                        ],
                        axisBorder: {
                            show: false
                        },
                    },
                    fill: {
                        opacity: 1
                    },
                    legend: {
                        position: 'bottom',
                        markers: {
                            radius: 12
                        }
                    },
                    grid: {
                        borderColor: '#f1f1f1'
                    }
                };

                var chart = new window.ApexCharts(document.querySelector("#chart-umur"), options);
                chart.render();
            });
        </script>
    @endpush
</x-layouts.user>
