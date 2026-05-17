<x-layouts.dashboard>
    <div class="space-y-6">
        <div class="flex items-center gap-4 pb-6 mb-10 border-b border-slate-200">
            <x-phosphor-money class="p-3 rounded-md size-12 bg-primary/20 text-primary" />
            <div>
                <h3 class="text-xl font-bold">Ekonomi</h3>
                <p class="text-slate-600">Analisis ekonomi & aset Desa Sukaraja</p>
            </div>
        </div>

        <div class="flex items-center justify-center border-2 border-dashed rounded-2xl border-slate-300 min-h-96">
            <div class="flex flex-col items-center justify-center gap-2">
                <x-phosphor-money class="p-3 mb-4 rounded-md size-16 bg-primary/20 text-primary" />
                <h4 class="text-xl font-bold">Hitung Agregat Ekonomi</h4>
                <p class="max-w-md mb-4 text-base text-center text-slate-600">Sistem akan memproses seluruh data untuk menghasilkan statistik Ekonomi. Proses ini hanya dilakukan sekali per sesi.</p>

                <button class="flex items-center gap-2 px-6 py-3 text-lg font-semibold text-white rounded-full shadow-lg bg-gradient-to-r from-primary to-secondary"><x-ri-play-circle-fill class="size-5" /> Generate Aggregate</button>
            </div>
        </div>

        @include('dashboard.statistics.social.partials.stats-card')

        <div class="p-8 bg-white border border-gray-100 shadow-sm rounded-3xl">
            <h3 class="mb-6 text-xs font-bold tracking-widest text-gray-400 uppercase">
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


        <x-cards.chart-card
            id="chart-religion"
            title="Agama"
            subtitle="Agama — Sosial" />


        <div class="p-6 space-y-4 overflow-hidden bg-white border border-gray-100 shadow-sm rounded-3xl">
            <div class="border-b border-gray-50">
                <h3 class="text-xs font-bold tracking-widest text-gray-400 uppercase">Agregat Desa</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs font-bold text-white uppercase bg-[#1e293b]">
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
                            <td class="px-6 py-4 font-medium text-gray-700">ISLAM</td>
                            <td class="px-6 py-4 text-center text-gray-600">3.850</td>
                            <td class="px-6 py-4 text-center text-gray-600">3.650</td>
                            <td class="px-6 py-4 font-bold text-center text-gray-800">7.500</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full bg-indigo-50 text-indigo-600 font-bold text-[11px]">92.7%</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="w-24 h-2 bg-gray-100 rounded-full">
                                    <div class="h-2 bg-indigo-500 rounded-full" style="width: 92.7%"></div>
                                </div>
                            </td>
                        </tr>

                        <tr class="transition-colors hover:bg-gray-50">
                            <td class="px-6 py-4 text-center text-gray-500">2</td>
                            <td class="px-6 py-4 font-medium text-gray-700">PROTESTAN</td>
                            <td class="px-6 py-4 text-center text-gray-600">110</td>
                            <td class="px-6 py-4 text-center text-gray-600">105</td>
                            <td class="px-6 py-4 font-bold text-center text-gray-800">215</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-600 font-bold text-[11px]">2.7%</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="w-24 h-2 bg-gray-100 rounded-full">
                                    <div class="h-2 bg-blue-500 rounded-full" style="width: 2.7%"></div>
                                </div>
                            </td>
                        </tr>

                        <tr class="transition-colors hover:bg-gray-50">
                            <td class="px-6 py-4 text-center text-gray-500">3</td>
                            <td class="px-6 py-4 font-medium text-gray-700">KATOLIK</td>
                            <td class="px-6 py-4 text-center text-gray-600">70</td>
                            <td class="px-6 py-4 text-center text-gray-600">65</td>
                            <td class="px-6 py-4 font-bold text-center text-gray-800">135</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full bg-sky-50 text-sky-600 font-bold text-[11px]">1.7%</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="w-24 h-2 bg-gray-100 rounded-full">
                                    <div class="h-2 rounded-full bg-sky-500" style="width: 1.7%"></div>
                                </div>
                            </td>
                        </tr>

                        <tr class="transition-colors hover:bg-gray-50">
                            <td class="px-6 py-4 text-center text-gray-500">4</td>
                            <td class="px-6 py-4 font-medium text-gray-700">HINDU</td>
                            <td class="px-6 py-4 text-center text-gray-600">20</td>
                            <td class="px-6 py-4 text-center text-gray-600">22</td>
                            <td class="px-6 py-4 font-bold text-center text-gray-800">42</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full bg-amber-50 text-amber-600 font-bold text-[11px]">0.5%</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="w-24 h-2 bg-gray-100 rounded-full">
                                    <div class="h-2 rounded-full bg-amber-500" style="width: 0.5%"></div>
                                </div>
                            </td>
                        </tr>

                        <tr class="transition-colors hover:bg-gray-50">
                            <td class="px-6 py-4 text-center text-gray-500">5</td>
                            <td class="px-6 py-4 font-medium text-gray-700">BUDHA</td>
                            <td class="px-6 py-4 text-center text-gray-600">40</td>
                            <td class="px-6 py-4 text-center text-gray-600">34</td>
                            <td class="px-6 py-4 font-bold text-center text-gray-800">74</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-600 font-bold text-[11px]">0.9%</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="w-24 h-2 bg-gray-100 rounded-full">
                                    <div class="h-2 rounded-full bg-emerald-500" style="width: 0.9%"></div>
                                </div>
                            </td>
                        </tr>

                        <tr class="transition-colors hover:bg-gray-50">
                            <td class="px-6 py-4 text-center text-gray-500">6</td>
                            <td class="px-6 py-4 font-medium text-gray-700">KONGHUCU</td>
                            <td class="px-6 py-4 text-center text-gray-600">12</td>
                            <td class="px-6 py-4 text-center text-gray-600">14</td>
                            <td class="px-6 py-4 font-bold text-center text-gray-800">26</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full bg-pink-50 text-pink-600 font-bold text-[11px]">0.3%</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="w-24 h-2 bg-gray-100 rounded-full">
                                    <div class="h-2 bg-pink-500 rounded-full" style="width: 0.3%"></div>
                                </div>
                            </td>
                        </tr>

                        <tr class="transition-colors hover:bg-gray-50">
                            <td class="px-6 py-4 text-center text-gray-500">7</td>
                            <td class="px-6 py-4 font-medium text-gray-700">LAINNYA</td>
                            <td class="px-6 py-4 text-center text-gray-600">25</td>
                            <td class="px-6 py-4 text-center text-gray-600">22</td>
                            <td class="px-6 py-4 font-bold text-center text-gray-800">47</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full bg-purple-50 text-purple-600 font-bold text-[11px]">0.6%</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="w-24 h-2 bg-gray-100 rounded-full">
                                    <div class="h-2 bg-purple-500 rounded-full" style="width: 0.6%"></div>
                                </div>
                            </td>
                        </tr>

                        <tr class="transition-colors hover:bg-gray-50">
                            <td class="px-6 py-4 text-center text-gray-500">8</td>
                            <td class="px-6 py-4 font-medium text-gray-700">Tidak Di Isi</td>
                            <td class="px-6 py-4 text-center text-gray-600">26</td>
                            <td class="px-6 py-4 text-center text-gray-600">22</td>
                            <td class="px-6 py-4 font-bold text-center text-gray-800">48</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-600 font-bold text-[11px]">0.6%</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="w-24 h-2 bg-gray-100 rounded-full">
                                    <div class="h-2 bg-gray-400 rounded-full" style="width: 0.6%"></div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot class="bg-gray-50/50">
                        <tr class="font-bold text-gray-800">
                            <td class="py-4 pl-10 text-left" colspan="2">Total</td>
                            <td class="px-6 py-4 text-center">4.153</td>
                            <td class="px-6 py-4 text-center">3.934</td>
                            <td class="px-6 py-4 text-center">8.087</td>
                            <td class="px-6 py-4 text-center">100%</td>
                            <td class="px-6 py-4"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="p-6 space-y-4 overflow-hidden bg-white border border-gray-100 shadow-sm rounded-3xl">
            <div class="flex items-center justify-between border-b border-gray-50">
                <h3 class="text-xs font-bold tracking-widest text-gray-400 uppercase">Agregat RT</h3>

                <div class="relative">
                    <select class="appearance-none bg-white border border-indigo-200 text-indigo-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-48 p-2.5 pr-10 outline-none">
                        <option selected>KLIWON</option>
                        <option value="manis">MANIS</option>
                        <option value="pahing">PAHING</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-3 text-indigo-500 pointer-events-none">
                        <i class="ri-arrow-down-s-line"></i>
                    </div>
                </div>
            </div>

            <div class="w-full overflow-x-auto">
                <table class="w-full text-sm text-left border-collapse">
                    <thead class="text-xs font-bold text-white uppercase bg-[#1e293b]">
                        <tr>
                            <th class="px-6 py-4">RW</th>
                            <th class="px-6 py-4">RT</th>
                            <th class="px-6 py-4">Kategori</th>
                            <th class="px-6 py-4 text-center">L</th>
                            <th class="px-6 py-4 text-center">P</th>
                            <th class="px-6 py-4 text-center">Jumlah</th>
                            <th class="px-6 py-4 text-center">%</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr>
                            <td rowspan="8" class="px-6 py-4 font-bold text-center text-gray-800 border-r border-gray-50">001</td>
                            <td rowspan="8" class="px-6 py-4 font-bold text-center text-gray-800 border-r border-gray-50">001</td>
                            <td class="px-6 py-4 font-medium text-gray-700">ISLAM</td>
                            <td class="px-6 py-4 text-center text-gray-600">385</td>
                            <td class="px-6 py-4 text-center text-gray-600">365</td>
                            <td class="px-6 py-4 font-bold text-center text-gray-800">750</td>
                            <td class="px-6 py-4 font-semibold text-center text-gray-500">92.7%</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 font-medium text-gray-700">PROTESTAN</td>
                            <td class="px-6 py-4 text-center text-gray-600">11</td>
                            <td class="px-6 py-4 text-center text-gray-600">10</td>
                            <td class="px-6 py-4 font-bold text-center text-gray-800">21</td>
                            <td class="px-6 py-4 text-center text-gray-400">2.7%</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 font-medium text-gray-700">KATOLIK</td>
                            <td class="px-6 py-4 text-center text-gray-600">7</td>
                            <td class="px-6 py-4 text-center text-gray-600">6</td>
                            <td class="px-6 py-4 font-bold text-center text-gray-800">13</td>
                            <td class="px-6 py-4 text-center text-gray-400">1.7%</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 font-medium text-gray-700">HINDU</td>
                            <td class="px-6 py-4 text-center text-gray-600">2</td>
                            <td class="px-6 py-4 text-center text-gray-600">2</td>
                            <td class="px-6 py-4 font-bold text-center text-gray-800">4</td>
                            <td class="px-6 py-4 text-center text-gray-400">0.5%</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 font-medium text-gray-700">BUDHA</td>
                            <td class="px-6 py-4 text-center text-gray-600">4</td>
                            <td class="px-6 py-4 text-center text-gray-600">3</td>
                            <td class="px-6 py-4 font-bold text-center text-gray-800">7</td>
                            <td class="px-6 py-4 text-center text-gray-400">0.9%</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 font-medium text-gray-700">KONGHUCU</td>
                            <td class="px-6 py-4 text-center text-gray-600">1</td>
                            <td class="px-6 py-4 text-center text-gray-600">2</td>
                            <td class="px-6 py-4 font-bold text-center text-gray-800">3</td>
                            <td class="px-6 py-4 text-center text-gray-400">0.3%</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 font-medium text-gray-700">LAINNYA</td>
                            <td class="px-6 py-4 text-center text-gray-600">3</td>
                            <td class="px-6 py-4 text-center text-gray-600">2</td>
                            <td class="px-6 py-4 font-bold text-center text-gray-800">5</td>
                            <td class="px-6 py-4 text-center text-gray-400">0.6%</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 font-medium text-gray-700">Tidak Di Isi</td>
                            <td class="px-6 py-4 text-center text-gray-600">3</td>
                            <td class="px-6 py-4 text-center text-gray-600">2</td>
                            <td class="px-6 py-4 font-bold text-center text-gray-800">5</td>
                            <td class="px-6 py-4 text-center text-gray-400">0.6%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
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
                    categories: ['Pra Lansia (55-64)', 'Dewasa Produktif (25-54)', 'Lansia (65+)', 'Balita (0-4)', 'Anak-anak (5-14)', 'Remaja (15-24)', 'Tidak Diisi'],
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

    @include('dashboard.statistics.demographics.partials.chart-script')
    @endpush
</x-layouts.dashboard>
