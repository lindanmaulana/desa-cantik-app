@props(['title' => 'Agregat RT'])

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
        <h3 class="text-xs font-bold tracking-widest text-gray-400 uppercase"></h3>

        <div class="relative w-48 text-left" @click.away="open = false">
            <button @click="open = !open" type="button"
                class="w-full flex items-center justify-between bg-white border border-indigo-200 text-primary text-sm max-md:text-xs font-semibold rounded-xl p-2.5 px-4 shadow-sm hover:border-primary focus:outline-none transition-all duration-200">
                <span x-text="activeRT">{{ $title }}</span>
                <svg class="size-4 text-primary transition-transform duration-300" :class="{ 'rotate-180': open }"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
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
                        <svg x-show="activeRT === item" class="size-4 text-primary" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7">
                            </path>
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
