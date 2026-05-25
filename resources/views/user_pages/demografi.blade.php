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
