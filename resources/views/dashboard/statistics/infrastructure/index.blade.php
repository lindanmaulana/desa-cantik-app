<x-layouts.dashboard>
    <x-comming-soon title="Infrastruktur" description="Data Infrastruktur Desa akan segera hadir." icon="bi-building-gear" />

    <!-- <div class="space-y-6">
        <div class="flex items-center gap-4 pb-6 mb-10 border-b border-slate-200">
            <x-bi-shop class="p-3 rounded-md size-12 bg-primary/20 text-primary" />
            <div>
                <h3 class="text-xl font-bold">UMKM</h3>
                <p class="text-slate-600">Analisis agregate UMKM Desa Sukaraja</p>
            </div>
        </div>

        <div class="flex items-center justify-center border-2 border-dashed rounded-2xl border-slate-300 min-h-96">
            <div class="flex flex-col items-center justify-center gap-2">
                <x-bi-shop class="p-3 mb-4 rounded-md size-16 bg-primary/20 text-primary" />
                <h4 class="text-xl font-bold">Hitung Agregat UMKM</h4>
                <p class="max-w-md mb-4 text-base text-center text-slate-600">Sistem akan memproses seluruh data untuk menghasilkan statistik UMKM. Proses ini hanya dilakukan sekali per sesi.</p>

                <button class="flex items-center gap-2 px-6 py-3 text-lg font-semibold text-white rounded-full shadow-lg bg-gradient-to-r from-primary to-secondary"><x-ri-play-circle-fill class="size-5" /> Generate Aggregate</button>
            </div>
        </div>

        @include('dashboard.statistics.msme.partials.stats-card')

        <div class="p-8 bg-white border border-gray-100 shadow-sm rounded-3xl">
            <h3 class="mb-6 text-xs font-bold tracking-widest text-gray-400 uppercase">
                Pilih Jenis Agregat
            </h3>

            <div class="flex flex-wrap gap-3">
                <a href="">
                    <x-buttons.filter-button icon="ri-apps-2-line" :active="true">
                        Sektor Usaha
                    </x-buttons.filter-button>
                </a>

                <a href="">
                    <x-buttons.filter-button icon="ri-user-settings-line">
                        Usia Pemilik
                    </x-buttons.filter-button>
                </a>

                <a href="">
                    <x-buttons.filter-button icon="ri-graduation-cap-line">
                        Pendidikan Pemilik
                    </x-buttons.filter-button>
                </a>

                <a href="">
                    <x-buttons.filter-button icon="ri-map-pin-line">
                        Lokasi Usaha
                    </x-buttons.filter-button>
                </a>

                <a href="">
                    <x-buttons.filter-button icon="ri-building-4-line">
                        Badan Hukum
                    </x-buttons.filter-button>
                </a>

                <a href="">
                    <x-buttons.filter-button icon="ri-file-shield-2-line">
                        Kepemilikan NIB
                    </x-buttons.filter-button>
                </a>

                <a href="">
                    <x-buttons.filter-button icon="ri-wallet-3-line">
                        Omzet/Bulan
                    </x-buttons.filter-button>
                </a>

                <a href="">
                    <x-buttons.filter-button icon="ri-qr-code-line">
                        Transaksi Digital
                    </x-buttons.filter-button>
                </a>

                <a href="">
                    <x-buttons.filter-button icon="ri-global-line">
                        Platform Digital
                    </x-buttons.filter-button>
                </a>

                <a href="">
                    <x-buttons.filter-button icon="ri-bank-line">
                        Sumber Modal
                    </x-buttons.filter-button>
                </a>

                <a href="">
                    <x-buttons.filter-button icon="ri-tree-line">
                        Ramah Lingkungan
                    </x-buttons.filter-button>
                </a>

                <a href="">
                    <x-buttons.filter-button icon="ri-building-line">
                        Kemitraan BUM Desa
                    </x-buttons.filter-button>
                </a>
            </div>
        </div>


        <x-cards.chart-card
            id="chart-msme"
            title="Sektor Usaha"
            subtitle="Sektor Usaha — UMKM" />



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
                            <td class="px-6 py-4 font-medium text-gray-700">Penyediaan Akomodasi dan Makan Minum</td>
                            <td class="px-6 py-4 text-center text-gray-600">1.600</td>
                            <td class="px-6 py-4 text-center text-gray-600">1.635</td>
                            <td class="px-6 py-4 font-bold text-center text-gray-800">3.235</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full bg-indigo-50 text-indigo-600 font-bold text-[11px]">40.0%</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="w-24 h-2 bg-gray-100 rounded-full">
                                    <div class="h-2 bg-indigo-500 rounded-full" style="width: 40.0%"></div>
                                </div>
                            </td>
                        </tr>

                        <tr class="transition-colors hover:bg-gray-50">
                            <td class="px-6 py-4 text-center text-gray-500">2</td>
                            <td class="px-6 py-4 font-medium text-gray-700">Perdagangan (Grosir / Eceran)</td>
                            <td class="px-6 py-4 text-center text-gray-600">850</td>
                            <td class="px-6 py-4 text-center text-gray-600">767</td>
                            <td class="px-6 py-4 font-bold text-center text-gray-800">1.617</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full bg-sky-50 text-sky-600 font-bold text-[11px]">20.0%</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="w-24 h-2 bg-gray-100 rounded-full">
                                    <div class="h-2 rounded-full bg-sky-400" style="width: 20.0%"></div>
                                </div>
                            </td>
                        </tr>

                        <tr class="transition-colors hover:bg-gray-50">
                            <td class="px-6 py-4 text-center text-gray-500">3</td>
                            <td class="px-6 py-4 font-medium text-gray-700">Industri Pengolahan</td>
                            <td class="px-6 py-4 text-center text-gray-600">810</td>
                            <td class="px-6 py-4 text-center text-gray-600">807</td>
                            <td class="px-6 py-4 font-bold text-center text-gray-800">1.617</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full bg-amber-50 text-amber-600 font-bold text-[11px]">20.0%</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="w-24 h-2 bg-gray-100 rounded-full">
                                    <div class="h-2 rounded-full bg-amber-500" style="width: 20.0%"></div>
                                </div>
                            </td>
                        </tr>

                        <tr class="transition-colors hover:bg-gray-50">
                            <td class="px-6 py-4 text-center text-gray-500">4</td>
                            <td class="px-6 py-4 font-medium text-gray-700">Jasa Lainnya</td>
                            <td class="px-6 py-4 text-center text-gray-600">893</td>
                            <td class="px-6 py-4 text-center text-gray-600">725</td>
                            <td class="px-6 py-4 font-bold text-center text-gray-800">1.618</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full bg-red-50 text-red-600 font-bold text-[11px]">20.0%</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="w-24 h-2 bg-gray-100 rounded-full">
                                    <div class="h-2 bg-red-400 rounded-full" style="width: 20.0%"></div>
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
                            <td rowspan="4" class="px-6 py-4 font-bold text-center text-gray-800 border-r border-gray-50">001</td>
                            <td rowspan="4" class="px-6 py-4 font-bold text-center text-gray-800 border-r border-gray-50">001</td>
                            <td class="px-6 py-4 font-medium text-gray-700">Penyediaan Akomodasi dan Makan Minum</td>
                            <td class="px-6 py-4 text-center text-gray-600">1.600</td>
                            <td class="px-6 py-4 text-center text-gray-600">1.635</td>
                            <td class="px-6 py-4 font-bold text-center text-gray-800">3.235</td>
                            <td class="px-6 py-4 font-semibold text-center text-gray-500">40.0%</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 font-medium text-gray-700">Perdagangan (Grosir / Eceran)</td>
                            <td class="px-6 py-4 text-center text-gray-600">850</td>
                            <td class="px-6 py-4 text-center text-gray-600">767</td>
                            <td class="px-6 py-4 font-bold text-center text-gray-800">1.617</td>
                            <td class="px-6 py-4 text-center text-gray-400">20.0%</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 font-medium text-gray-700">Industri Pengolahan</td>
                            <td class="px-6 py-4 text-center text-gray-600">810</td>
                            <td class="px-6 py-4 text-center text-gray-600">807</td>
                            <td class="px-6 py-4 font-bold text-center text-gray-800">1.617</td>
                            <td class="px-6 py-4 text-center text-gray-400">20.0%</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 font-medium text-gray-700">Jasa Lainnya</td>
                            <td class="px-6 py-4 text-center text-gray-600">893</td>
                            <td class="px-6 py-4 text-center text-gray-600">725</td>
                            <td class="px-6 py-4 font-bold text-center text-gray-800">1.618</td>
                            <td class="px-6 py-4 text-center text-gray-400">20.0%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div> -->


    @push('scripts')
    <script>
        // document.addEventListener('DOMContentLoaded', function() {
        //     var options = {
        //         series: [40, 20, 20, 20],
        //         labels: [
        //             'Penyediaan Akomodasi dan Makan Minum',
        //             'Perdagangan (Grosir / Eceran)',
        //             'Industri Pengolahan',
        //             'Jasa Lainnya'
        //         ],
        //         chart: {
        //             type: 'donut',
        //             height: 450,
        //             toolbar: {
        //                 show: false
        //             },
        //             fontFamily: 'Inter, sans-serif'
        //         },
        //         plotOptions: {
        //             pie: {
        //                 donut: {
        //                     size: '70%',
        //                     labels: {
        //                         show: true,
        //                         total: {
        //                             show: true,
        //                             label: 'Total',
        //                             fontFamily: 'Inter, sans-serif',
        //                             fontWeight: 600
        //                         }
        //                     }
        //                 }
        //             }
        //         },
        //         colors: [
        //             '#6366f1',
        //             '#38bdf8',
        //             '#fbbf24',
        //             '#f87171'
        //         ],
        //         dataLabels: {
        //             enabled: true,
        //             formatter: function(val) {
        //                 return val.toFixed(1) + "%"
        //             }
        //         },
        //         stroke: {
        //             show: true,
        //             width: 2,
        //             colors: ['#fff']
        //         },
        //         legend: {
        //             position: 'bottom',
        //             horizontalAlign: 'center',
        //             markers: {
        //                 radius: 12
        //             }
        //         }
        //     };

        //     const chart = new window.ApexCharts(document.querySelector("#chart-msme"), options);
        //     chart.render();
        // });
    </script>

    @endpush
</x-layouts.dashboard>
