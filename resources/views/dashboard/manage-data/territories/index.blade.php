<x-layouts.dashboard>
    <div class="p-6 bg-gray-50" x-data="{
            openCreate: false,
            openUpdate: false,
            territory: { id: '', sub_village: '', area_name: '', rw: '', rt: ''},

            openModal(data) {
                this.territory = data;
                this.openUpdate = true;
            }
        }">

        <div class="flex flex-col items-start justify-between gap-4 mb-6 md:flex-row md:items-center">
            <div>
                <h1 class="flex items-center gap-2 text-2xl font-bold text-gray-800">
                    <x-heroicon-o-map-pin class="w-6 h-6 text-teal-600" />
                    Kelola Data Wilayah (Territories)
                </h1>
                <p class="mt-1 text-sm text-gray-500">Manajemen data master Dusun, RW, dan RT untuk basis data warga.</p>
            </div>

            <div class="flex items-center gap-2">
                <button @click="openCreate = true" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors bg-teal-600 rounded-lg shadow-sm hover:bg-teal-700">
                    <x-heroicon-o-plus class="w-4 h-4 mr-2" />
                    Tambah Wilayah Baru
                </button>
            </div>
        </div>

        @include('dashboard.manage-data.territories.partials.create')
        @include('dashboard.manage-data.territories.partials.update')

        <div class="grid grid-cols-1 gap-4 mb-6 sm:grid-cols-3">
            <div class="flex items-center justify-between p-4 bg-white border border-gray-100 shadow-sm rounded-xl">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase">Total Dusun</p>
                    <h3 class="mt-1 text-2xl font-bold text-gray-800">4</h3>
                </div>
                <div class="p-3 text-teal-600 rounded-lg bg-teal-50">
                    <x-heroicon-o-flag class="w-6 h-6" />
                </div>
            </div>
            <div class="flex items-center justify-between p-4 bg-white border border-gray-100 shadow-sm rounded-xl">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase">Total RW</p>
                    <h3 class="mt-1 text-2xl font-bold text-gray-800">12</h3>
                </div>
                <div class="p-3 text-blue-600 rounded-lg bg-blue-50">
                    <x-heroicon-o-squares-2x2 class="w-6 h-6" />
                </div>
            </div>
            <div class="flex items-center justify-between p-4 bg-white border border-gray-100 shadow-sm rounded-xl">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase">Total RT</p>
                    <h3 class="mt-1 text-2xl font-bold text-gray-800">36</h3>
                </div>
                <div class="p-3 text-indigo-600 rounded-lg bg-indigo-50">
                    <x-heroicon-o-home class="w-6 h-6" />
                </div>
            </div>
        </div>

        <div class="flex flex-col items-center justify-between gap-4 p-4 mb-6 bg-white border border-gray-100 shadow-sm rounded-xl md:flex-row">
            <div class="relative w-full md:w-72">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <x-heroicon-o-magnifying-glass class="w-5 h-5 text-gray-400" />
                </span>
                <input type="text" placeholder="Cari nama dusun atau wilayah..." class="w-full py-2 pl-10 pr-4 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
            </div>

            <div class="flex items-center justify-end w-full gap-2 md:w-auto">
                <select class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg md:w-44 focus:outline-none focus:border-teal-500">
                    <option value="">Semua Dusun</option>
                    <option value="pahing">Pahing</option>
                    <option value="pon">Pon</option>
                    <option value="wage">Wage</option>
                </select>
            </div>
        </div>

        <div class="overflow-hidden bg-white border border-gray-100 shadow-sm rounded-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wider text-gray-500 uppercase border-b border-gray-100 bg-gray-50">
                            <th class="w-16 px-6 py-4 text-center">ID</th>
                            <th class="px-6 py-4">Nama Dusun (`sub_village`)</th>
                            <th class="px-6 py-4">Nama Spesifik / Blok (`area_name`)</th>
                            <th class="px-6 py-4 text-center">RW</th>
                            <th class="px-6 py-4 text-center">RT</th>
                            <th class="w-32 px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-700 divide-y divide-gray-100">
                        @if($territories->isNotEmpty())

                        <?php $no = 1; ?>
                        @foreach($territories as $territory)
                        <tr class="transition-colors hover:bg-gray-50/70">
                            <td class="px-6 py-4 font-medium text-center text-gray-400">{{ $no++ }}</td>
                            <td class="px-6 py-4 font-semibold text-gray-900">{{ $territory->sub_village }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $territory->area_name }}</td>
                            <td class="px-6 py-4 font-medium text-center">{{ $territory->rw }}</td>
                            <td class="px-6 py-4 font-medium text-center">{{ $territory->rt }}</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button @click='openModal(@json($territory))' class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-md transition-colors" title="Edit Data">
                                        <x-heroicon-o-pencil-square class="w-4 h-4" />
                                    </button>
                                    <button class="p-1.5 text-red-600 hover:bg-red-50 rounded-md transition-colors" title="Hapus Data" onclick="confirm('Apakah Anda yakin ingin menghapus wilayah ini?')">
                                        <x-heroicon-o-trash class="w-4 h-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="6" class="py-4 text-center text-red-500">
                                <p class="flex items-center justify-center gap-2 py-4"><x-heroicon-o-folder-open class="size-5" /> Data Wilayah tidak tersedia.</p>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="flex items-center justify-between px-6 py-4 text-xs text-gray-500 border-t border-gray-100 bg-gray-50/50">
                <p>Menampilkan {{ $territories->firstItem() }} sampai {{ $territories->lastItem() }} dari {{ $territories->total() }} wilayah</p>
                <div class="inline-flex gap-1">
                    @if ($territories->onFirstPage())
                    <button class="px-3 py-1.5 border border-gray-200 rounded bg-white opacity-50 text-gray-600" disabled>
                        Sebelumnya
                    </button>
                    @else
                    <a href="{{ $territories->previousPageUrl() }}" class="px-3 py-1.5 border border-gray-200 rounded bg-white hover:bg-gray-50 text-gray-600">
                        Sebelumnya
                    </a>
                    @endif

                    @if ($territories->hasMorePages())
                    <a href="{{ $territories->nextPageUrl() }}" class="px-3 py-1.5 border border-gray-200 rounded bg-white hover:bg-gray-50 text-gray-600">
                        Selanjutnya
                    </a>
                    @else
                    <button class="px-3 py-1.5 border border-gray-200 rounded bg-white opacity-50 text-gray-600" disabled>
                        Selanjutnya
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>



    @push('scripts')
    <script>

    </script>
    @endpush

</x-layouts.dashboard>
