<x-layouts.admin>
    <div class="space-y-6">
        <div class="flex items-center gap-4 border-b pb-6 border-slate-200 mb-10">
            <x-ionicon-people-sharp class="size-13 bg-primary/20 p-3 rounded-md" />
            <div>
                <h3 class="text-xl font-bold">Demografi</h3>
                <p class="text-slate-600">Analisis agregat demografi Desa Sukaraja</p>
            </div>
        </div>

        <div class="rounded-2xl border-2 border-slate-300 border-dashed min-h-100 flex items-center justify-center">
            <div class="flex flex-col items-center justify-center gap-2">
                <x-ionicon-people-sharp class="size-16 bg-primary/20 p-3 rounded-md mb-4" />
                <h4 class="text-xl font-bold">Hitung Agregat Demografi</h4>
                <p class="text-base text-slate-600 max-w-110 text-center mb-4">Sistem akan memproses seluruh data untuk menghasilkan statistik Demografi. Proses ini hanya dilakukan sekali per sesi.</p>

                <button class="bg-linear-to-r from-primary to-secondary px-6 py-3 rounded-full flex items-center gap-2 text-white text-lg font-semibold shadow-lg"><x-ri-play-circle-fill class="size-5" /> Generate Aggregate</button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 p-6 bg-gray-50">
            <x-cards.stats-card
                title="Total Data"
                value="8.087"
                icon="fas fa-users"
                color="bg-indigo-500" />

            <x-cards.stats-card
                title="Laki-laki"
                value="4.243"
                icon="fas fa-mars"
                color="bg-sky-400" />

            <x-cards.stats-card
                title="Perempuan"
                value="3.844"
                icon="fas fa-venus"
                color="bg-pink-500" />

            <x-cards.stats-card
                title="Penduduk Total"
                value="8.087"
                icon="fas fa-database"
                color="bg-amber-500" />
        </div>

        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-6">
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

        <x-cards.chart-card
            id="chart-umur"
            title="Kelompok Umur"
            subtitle="Kelompok Umur — Demografi" />

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden p-6 space-y-4">
            <div class="border-b border-gray-50">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest">Agregat Desa</h3>
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
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-center text-gray-500">1</td>
                            <td class="px-6 py-4 font-medium text-gray-700">Pra Lansia (55-64)</td>
                            <td class="px-6 py-4 text-center text-gray-600">366</td>
                            <td class="px-6 py-4 text-center text-gray-600">353</td>
                            <td class="px-6 py-4 text-center font-bold text-gray-800">719</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full bg-indigo-50 text-indigo-500 font-bold text-[11px]">8.9%</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="w-24 h-2 bg-gray-100 rounded-full">
                                    <div class="bg-indigo-500 h-2 rounded-full" style="width: 8.9%"></div>
                                </div>
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-center text-gray-500">2</td>
                            <td class="px-6 py-4 font-medium text-gray-700">Dewasa Produktif (25-54)</td>
                            <td class="px-6 py-4 text-center text-gray-600">2.029</td>
                            <td class="px-6 py-4 text-center text-gray-600">1.758</td>
                            <td class="px-6 py-4 text-center font-bold text-gray-800">3.787</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full bg-sky-50 text-sky-500 font-bold text-[11px]">46.8%</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="w-24 h-2 bg-gray-100 rounded-full">
                                    <div class="bg-sky-400 h-2 rounded-full" style="width: 46.8%"></div>
                                </div>
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-center text-gray-500">3</td>
                            <td class="px-6 py-4 font-medium text-gray-700">Lansia (65+)</td>
                            <td class="px-6 py-4 text-center text-gray-600">409</td>
                            <td class="px-6 py-4 text-center text-gray-600">368</td>
                            <td class="px-6 py-4 text-center font-bold text-gray-800">777</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full bg-amber-50 text-amber-500 font-bold text-[11px]">9.6%</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="w-24 h-2 bg-gray-100 rounded-full">
                                    <div class="bg-amber-400 h-2 rounded-full" style="width: 9.6%"></div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot class="bg-gray-50/50">
                        <tr class="font-bold text-gray-800">
                            <td class="pl-10 py-4 text-left" colspan="2">Total</td>
                            <td class="px-6 py-4 text-center">4.243</td>
                            <td class="px-6 py-4 text-center">3.844</td>
                            <td class="px-6 py-4 text-center">8.087</td>
                            <td class="px-6 py-4 text-center">100%</td>
                            <td class="px-6 py-4"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden p-6 space-y-4">
            <div class="border-b border-gray-50 flex justify-between items-center">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest">Agregat RT</h3>

                <div class="relative">
                    <select class="appearance-none bg-white border border-indigo-200 text-indigo-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-48 p-2.5 pr-10 outline-none">
                        <option selected>KLIWON</option>
                        <option value="manis">MANIS</option>
                        <option value="pahing">PAHING</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-indigo-500">
                        <i class="ri-arrow-down-s-line"></i> {{-- Gunakan Remix Icon atau Heroicons --}}
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
                            <td rowspan="7" class="px-6 py-4 text-center font-bold text-gray-800 border-r border-gray-50">001</td>
                            <td rowspan="7" class="px-6 py-4 text-center font-bold text-gray-800 border-r border-gray-50">001</td>
                            <td class="px-6 py-4 text-gray-600 italic">Pra Lansia (55-64)</td>
                            <td class="px-6 py-4 text-center text-gray-600">58</td>
                            <td class="px-6 py-4 text-center text-gray-600">56</td>
                            <td class="px-6 py-4 text-center font-bold text-gray-800">114</td>
                            <td class="px-6 py-4 text-center text-gray-400">10.5%</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-gray-600 italic">Dewasa Produktif (25-54)</td>
                            <td class="px-6 py-4 text-center text-gray-600">266</td>
                            <td class="px-6 py-4 text-center text-gray-600">248</td>
                            <td class="px-6 py-4 text-center font-bold text-gray-800">514</td>
                            <td class="px-6 py-4 text-center text-gray-400">47.3%</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-gray-600 italic">Lansia (65+)</td>
                            <td class="px-6 py-4 text-center text-gray-600">51</td>
                            <td class="px-6 py-4 text-center text-gray-600">58</td>
                            <td class="px-6 py-4 text-center font-bold text-gray-800">109</td>
                            <td class="px-6 py-4 text-center text-gray-400">10.0%</td>
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
                    markers: {
                        radius: 12
                    }
                },
                grid: {
                    borderColor: '#f1f1f1',
                }
            };

            var chart = new window.ApexCharts(document.querySelector("#chart-umur"), options);
            chart.render();
        });
    </script>

    @include('statistics.demographics.partials.chart-script')
    @endpush
</x-layouts.admin>
