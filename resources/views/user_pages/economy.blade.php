<x-layouts.user>
    <div class="space-y-6 max-md:space-y-3" x-data="{ isGenerated: false }">
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

            @include('dashboard.statistics.social.partials.stats-card')

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
                                <td class="px-6 py-4 font-medium text-gray-700">ISLAM</td>
                                <td class="px-6 py-4 text-center text-gray-600">3..850</td>
                                <td class="px-6 py-4 text-center text-gray-600">3.650</td>
                                <td class="px-6 py-4 font-bold text-center text-primary">7.500</td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="px-3 py-1 rounded-full bg-indigo-50 text-indigo-500 font-bold text-[11px]">92.7%</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="w-24 h-2 bg-gray-100 rounded-full">
                                        <div class="h-2 bg-indigo-500 rounded-full" style="width: 8.9%"></div>
                                    </div>
                                </td>
                            </tr>

                            <tr class="transition-colors hover:bg-gray-50">
                                <td class="px-6 py-4 text-center text-gray-500">2</td>
                                <td class="px-6 py-4 font-medium text-gray-700">PROTESTAN</td>
                                <td class="px-6 py-4 text-center text-gray-600">110</td>
                                <td class="px-6 py-4 text-center text-gray-600">105</td>
                                <td class="px-6 py-4 font-bold text-center text-primary">215</td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="px-3 py-1 rounded-full bg-sky-50 text-sky-500 font-bold text-[11px]">2.7%</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="w-24 h-2 bg-gray-100 rounded-full">
                                        <div class="h-2 rounded-full bg-sky-400 w-[46.8%]"></div>
                                    </div>
                                </td>
                            </tr>

                            <tr class="transition-colors hover:bg-gray-50">
                                <td class="px-6 py-4 text-center text-gray-500">3</td>
                                <td class="px-6 py-4 font-medium text-gray-700">KATOLIK</td>
                                <td class="px-6 py-4 text-center text-gray-600">70</td>
                                <td class="px-6 py-4 text-center text-gray-600">65</td>
                                <td class="px-6 py-4 font-bold text-center text-primary">135</td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="px-3 py-1 rounded-full bg-amber-50 text-amber-500 font-bold text-[11px]">1.7%</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="w-24 h-2 bg-gray-100 rounded-full">
                                        <div class="h-2 rounded-full bg-amber-400 w-[9.6%]"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="transition-colors hover:bg-gray-50">
                                <td class="px-6 py-4 text-center text-gray-500">4</td>
                                <td class="px-6 py-4 font-medium text-gray-700">HINDU</td>
                                <td class="px-6 py-4 text-center text-gray-600">20</td>
                                <td class="px-6 py-4 text-center text-gray-600">22</td>
                                <td class="px-6 py-4 font-bold text-center text-primary">42</td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="px-3 py-1 rounded-full bg-amber-50 text-amber-600 font-bold text-[11px]">0.5%</span>
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
                                <td class="px-6 py-4 font-bold text-center text-primary">74</td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-600 font-bold text-[11px]">0.9%</span>
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
                                <td class="px-6 py-4 font-bold text-center text-primary">26</td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="px-3 py-1 rounded-full bg-pink-50 text-pink-600 font-bold text-[11px]">0.3%</span>
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
                                <td class="px-6 py-4 font-bold text-center text-primary">47</td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="px-3 py-1 rounded-full bg-purple-50 text-purple-600 font-bold text-[11px]">0.6%</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="w-24 h-2 bg-gray-100 rounded-full">
                                        <div class="h-2 bg-purple-500 rounded-full" style="width: 0.6%"></div>
                                    </div>
                                </td>
                            </tr>

                            <tr class="transition-colors hover:bg-gray-50">
                                <td class="px-6 py-4 text-center text-gray-500">8</td>
                                <td class="px-6 py-4 font-medium text-gray-700">TIDAK DI ISI</td>
                                <td class="px-6 py-4 text-center text-gray-600">26</td>
                                <td class="px-6 py-4 text-center text-gray-600">22</td>
                                <td class="px-6 py-4 font-bold text-center text-primary">48</td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="px-3 py-1 rounded-full bg-gray-100 text-gray-600 font-bold text-[11px]">0.6%</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="w-24 h-2 bg-gray-100 rounded-full">
                                        <div class="h-2 bg-gray-400 rounded-full" style="width: 0.6%"></div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot class="bg-quaternary">
                            <tr class="font-bold text-primary">
                                <td class="py-4 pl-10 text-left" colspan="2">Total</td>
                                <td class="px-6 py-4 text-center">4.153</td>
                                <td class="px-6 py-4 text-center">3.934</td>
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
                            { rw: '001', rt: '001', kategori: 'ISLAM', l: 58, p: 56, jumlah: 114, persen: '10.5%' },
                            { rw: '001', rt: '001', kategori: 'PROTESTAN', l: 266, p: 248, jumlah: 514, persen: '47.3%' },
                            { rw: '001', rt: '001', kategori: 'KATOLIK', l: 51, p: 58, jumlah: 109, persen: '10.0%' },
                            { rw: '001', rt: '001', kategori: 'HINDU', l: 0, p: 0, jumlah: 0, persen: '0%' },
                            { rw: '001', rt: '001', kategori: 'BUDHA', l: 0, p: 0, jumlah: 0, persen: '0%' },
                            { rw: '001', rt: '001', kategori: 'KONGHUCU', l: 0, p: 0, jumlah: 0, persen: '0%' },
                            { rw: '001', rt: '001', kategori: 'LAINNYA', l: 0, p: 0, jumlah: 0, persen: '0%' },
                            { rw: '001', rt: '001', kategori: 'TIDAK DI ISI', l: 0, p: 0, jumlah: 0, persen: '0%' }
                        ],
                        'MANIS': [
                            { rw: '001', rt: '002', kategori: 'ISLAM', l: 42, p: 38, jumlah: 80, persen: '9.2%' },
                            { rw: '001', rt: '002', kategori: 'PROTESTAN', l: 190, p: 210, jumlah: 400, persen: '46.0%' },
                            { rw: '001', rt: '002', kategori: 'KATOLIK', l: 35, p: 45, jumlah: 80, persen: '9.2%' },
                            { rw: '001', rt: '001', kategori: 'HINDU', l: 0, p: 0, jumlah: 0, persen: '0%' },
                            { rw: '001', rt: '001', kategori: 'BUDHA', l: 0, p: 0, jumlah: 0, persen: '0%' },
                            { rw: '001', rt: '001', kategori: 'KONGHUCU', l: 0, p: 0, jumlah: 0, persen: '0%' },
                            { rw: '001', rt: '001', kategori: 'LAINNYA', l: 0, p: 0, jumlah: 0, persen: '0%' },
                            { rw: '001', rt: '001', kategori: 'TIDAK DI ISI', l: 0, p: 0, jumlah: 0, persen: '0%' }
                        ],
                        'PAHING': [
                            { rw: '002', rt: '001', kategori: 'ISLAM', l: 60, p: 62, jumlah: 122, persen: '11.1%' },
                            { rw: '002', rt: '001', kategori: 'PROTESTAN', l: 230, p: 250, jumlah: 480, persen: '43.6%' },
                            { rw: '002', rt: '001', kategori: 'KATOLIK', l: 48, p: 50, jumlah: 98, persen: '8.9%' },
                            { rw: '001', rt: '001', kategori: 'HINDU', l: 0, p: 0, jumlah: 0, persen: '0%' },
                            { rw: '001', rt: '001', kategori: 'BUDHA', l: 0, p: 0, jumlah: 0, persen: '0%' },
                            { rw: '001', rt: '001', kategori: 'KONGHUCU', l: 0, p: 0, jumlah: 0, persen: '0%' },
                            { rw: '001', rt: '001', kategori: 'LAINNYA', l: 0, p: 0, jumlah: 0, persen: '0%' },
                            { rw: '001', rt: '001', kategori: 'TIDAK DI ISI', l: 0, p: 0, jumlah: 0, persen: '0%' }
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
</x-layouts.user>
