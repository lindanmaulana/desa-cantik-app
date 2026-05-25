<x-layouts.client>
    <div class="space-y-6 max-md:space-y-3" x-data="{ isGenerated: new URLSearchParams(window.location.search).has('type') }">
        <div class="space-y-4" x-show="!isGenerated" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-4 absolute w-full">

            <div class="flex items-center gap-4 pb-6 mb-10 border-b border-slate-200">
                <x-ionicon-people-sharp class="p-3 rounded-md size-12 bg-primary/20 text-primary" />
                <div>
                    <h3 class="text-xl max-md:text-base font-bold">Ekonomi</h3>
                    <p class="text-slate-600 text-lg max-md:text-sm">Analisis ekonomi & aset Desa Sukaraja</p>
                </div>
            </div>

            <div class="flex items-center justify-center border-2 border-dashed rounded-2xl border-slate-300 min-h-96">
                <div class="flex flex-col items-center justify-center gap-2">
                    <x-ionicon-people-sharp class="p-3 mb-4 rounded-md size-16 bg-primary/20 text-primary" />
                    <h4 class="text-xl max-md:text-base font-bold">Hitung Agregat Ekonomi</h4>
                    <p class="max-w-md mb-4 text-base max-md:text-sm text-center text-slate-600">
                        Sistem akan memproses seluruh data untuk menghasilkan statistik Ekonomi. Proses ini hanya
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

            @include('dashboard.statistics.economy.partials.stats-card')

            <div class="p-8 max-md:p-4 bg-white border border-gray-100 shadow-sm rounded-3xl max-md:rounded-xl">
                <h3 class="mb-6 text-xs max-md:text-center font-bold tracking-widest text-gray-400 uppercase">
                    Pilih Jenis Agregat
                </h3>

                <div class="flex flex-wrap gap-3">
                    <a href="">
                        <x-buttons.filter-button icon="ri-bank-line" :active="true">
                            Agama
                        </x-buttons.filter-button>
                    </a>

                    <a href="">
                        <x-buttons.filter-button icon="ri-book-open-line">
                            Partisipasi Sekolah
                        </x-buttons.filter-button>
                    </a>

                    <a href="">
                        <x-buttons.filter-button icon="ri-graduation-cap-line">
                            Jenjang Pendidikan
                        </x-buttons.filter-button>
                    </a>

                    <a href="">
                        <x-buttons.filter-button icon="ri-checkbox-circle-line">
                            Ijazah Terakhir
                        </x-buttons.filter-button>
                    </a>

                    <a href="">
                        <x-buttons.filter-button icon="ri-drop-line">
                            Golongan Darah
                        </x-buttons.filter-button>
                    </a>

                    <a href="">
                        <x-buttons.filter-button icon="ri-accessibility-fill">
                            Disabilitas
                        </x-buttons.filter-button>
                    </a>

                    <a href="">
                        <x-buttons.filter-button icon="ri-parent-line">
                            Kehamilan
                        </x-buttons.filter-button>
                    </a>

                    <a href="">
                        <x-buttons.filter-button icon="ri-team-line">
                            Keluarga Berencana
                        </x-buttons.filter-button>
                    </a>

                    <a href="">
                        <x-buttons.filter-button icon="ri-heart-pulse-line">
                            BPJS Kesehatan
                        </x-buttons.filter-button>
                    </a>

                    <a href="">
                        <x-buttons.filter-button icon="ri-gift-line">
                            Bantuan Sosial
                        </x-buttons.filter-button>
                    </a>

                    <a href="">
                        <x-buttons.filter-button icon="ri-water-flash-line">
                            Sumber Air
                        </x-buttons.filter-button>
                    </a>

                    <a href="">
                        <x-buttons.filter-button icon="ri-lightbulb-line">
                            Penerangan
                        </x-buttons.filter-button>
                    </a>

                    <a href="">
                        <x-buttons.filter-button icon="ri-home-heart-line">
                            Fasilitas BAB
                        </x-buttons.filter-button>
                    </a>
                </div>
            </div>

            <x-cards.chart-card id="chart-religion" title="Agama" subtitle="Agama — Sosial" />

        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var options = {
                    // Series disesuaikan dengan Enum Religion (Total 7 agama + Tidak Di Isi)
                    series: [{
                            name: 'ISLAM',
                            data: [400, 2000, 450, 200, 550, 650, 50]
                        },
                        {
                            name: 'PROTESTAN',
                            data: [50, 150, 30, 20, 40, 45, 5]
                        },
                        {
                            name: 'KATOLIK',
                            data: [30, 100, 25, 15, 35, 30, 2]
                        },
                        {
                            name: 'HINDU',
                            data: [10, 40, 5, 5, 10, 15, 0]
                        },
                        {
                            name: 'BUDHA',
                            data: [15, 60, 12, 8, 15, 20, 1]
                        },
                        {
                            name: 'KONGHUCU',
                            data: [5, 20, 2, 1, 5, 8, 0]
                        },
                        {
                            name: 'LAINNYA (OTHER)',
                            data: [12, 35, 8, 4, 12, 18, 3]
                        },
                        {
                            name: 'Tidak Di Isi',
                            data: [380, 1750, 400, 180, 540, 600, 60]
                        }
                    ],
                    chart: {
                        type: 'bar',
                        height: 450, // Dinaikkan sedikit tingginya agar lebih lega karena bar-nya banyak
                        toolbar: {
                            show: false
                        },
                        fontFamily: 'Inter, sans-serif'
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '70%', // Diperlebar sedikit dari 55% biar muat menampung banyak bar agama
                            borderRadius: 4, // Diturunkan ke 4 agar lengkungan bar yang rapat tetap terlihat rapi
                            dataLabels: {
                                position: 'top'
                            }
                        },
                    },
                    // Ditambahkan palet warna unik untuk masing-masing dari 8 kelompok data
                    colors: [
                        '#6366f1', // Islam (Indigo)
                        '#3b82f6', // Protestan (Blue)
                        '#0ea5e9', // Katolik (Sky)
                        '#f59e0b', // Hindu (Amber)
                        '#10b981', // Budha (Emerald)
                        '#ec4899', // Konghucu (Pink)
                        '#8b5cf6', // Lainnya (Purple)
                        '#9ca3af' // Tidak Di Isi (Gray)
                    ],
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: true,
                        width: 2, // Diturunkan dari 5 ke 2 agar bar yang berdempetan tidak saling memakan space
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
                        horizontalAlign: 'center',
                        markers: {
                            radius: 12
                        }
                    },
                    grid: {
                        borderColor: '#f1f1f1',
                    }
                };

                var chart = new window.ApexCharts(document.querySelector("#chart-religion"), options);
                chart.render();
            });
        </script>
    @endpush
</x-layouts.client>
