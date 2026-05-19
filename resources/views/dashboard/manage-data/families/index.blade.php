<x-layouts.dashboard>
    <div class="p-6 bg-gray-50" x-data="{
            openData: false,
            openCreate: false,
            openUpdate: false,
            family: { id: '', territory_id: '', family_card_number: '', address_detail: ''},

            openModal(data) {
                this.family = {
                    id: data.id,
                    territory_id: data.territory_id || '',
                    family_card_number: data.family_card_number,
                    address_detail: data.address_detail
                };
                this.openUpdate = true;
            }
        }">

        <div class="flex flex-col items-start justify-between gap-4 mb-6 md:flex-row md:items-center">
            <div>
                <h1 class="flex items-center gap-2 text-2xl font-bold text-gray-800">
                    <x-heroicon-o-users class="w-6 h-6 text-teal-600" />
                    Kelola Data Keluarga (Families)
                </h1>
                <p class="mt-1 text-sm text-gray-500">Manajemen data nomor Kartu Keluarga (KK) dan wilayah tinggal warga desa.</p>
            </div>

            <div class="flex items-center gap-2">
                <button @click="openData = !openData" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors bg-teal-600 rounded-lg shadow-sm hover:bg-teal-700">
                    <x-heroicon-o-eye class="w-4 h-4 mr-2" x-show="openData" />
                    <x-heroicon-o-eye-slash class="w-4 h-4 mr-2" x-show="!openData" />
                    <span x-show="openData">Sembunyikan Data Sensitif</span>
                    <span x-show="!openData">Tampilkan Data Sensitif</span>
                </button>
            
                <button @click="openCreate = true" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors bg-teal-600 rounded-lg shadow-sm hover:bg-teal-700">
                    <x-heroicon-o-plus class="w-4 h-4 mr-2" />
                    Tambah Keluarga Baru
                </button>
            </div>
        </div>

        @if(session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
            <span class="font-medium">Berhasil!</span> {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
            <span class="font-medium">Gagal!</span> {{ session('error') }}
        </div>
        @endif

        @include('dashboard.manage-data.families.partials.modal.create')
        @include('dashboard.manage-data.families.partials.modal.update')

        <div class="grid grid-cols-1 gap-4 mb-6 sm:grid-cols-3">
            <div class="flex items-center justify-between p-4 bg-white border border-gray-100 shadow-sm rounded-xl">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase">Total Kepala Keluarga</p>
                    <h3 class="mt-1 text-2xl font-bold text-gray-800">{{ $counts->total_Families }}</h3>
                </div>
                <div class="p-3 text-teal-600 rounded-lg bg-teal-50">
                    <x-heroicon-o-users class="w-6 h-6" />
                </div>
            </div>
            <div class="flex items-center justify-between p-4 bg-white border border-gray-100 shadow-sm rounded-xl">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase">Total Dusun</p>
                    <h3 class="mt-1 text-2xl font-bold text-gray-800">{{ $counts->total_SubVillage }}</h3>
                </div>
                <div class="p-3 text-blue-600 rounded-lg bg-blue-50">
                    <x-heroicon-o-flag class="w-6 h-6" />
                </div>
            </div>
            <div class="flex items-center justify-between p-4 bg-white border border-gray-100 shadow-sm rounded-xl">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase">Total Warga Terdata</p>
                    <h3 class="mt-1 text-2xl font-bold text-gray-800">{{ $counts->total_Citizens }}</h3>
                </div>
                <div class="p-3 text-indigo-600 rounded-lg bg-indigo-50">
                    <x-heroicon-o-user-group class="w-6 h-6" />
                </div>
            </div>
        </div>

        <form action="{{ route('dashboard.manage-data.families') }}" method="GET" class="flex flex-col items-center justify-between gap-4 p-4 mb-6 bg-white border border-gray-100 shadow-sm rounded-xl md:flex-row">
            <div class="relative w-full md:w-72">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <x-heroicon-o-magnifying-glass class="w-5 h-5 text-gray-400" />
                </span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari No KK atau alamat..." class="w-full py-2 pl-10 pr-4 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
            </div>

            <div class="flex items-center justify-end w-full gap-2 md:w-auto">
                <select name="territory_id" onchange="this.form.submit()" class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg md:w-64 focus:outline-none focus:border-teal-500">
                    <option value="">Semua Wilayah</option>
                    @foreach($territories as $territory)
                        <option value="{{ $territory->id }}" {{ request('territory_id') == $territory->id ? 'selected' : '' }}>
                            Dusun {{ ucfirst($territory->sub_village) }} (RT {{ $territory->rt }} / RW {{ $territory->rw }})
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white transition-colors bg-teal-600 rounded-lg shadow-sm hover:bg-teal-700">
                    Filter
                </button>
            </div>
        </form>

        <div class="overflow-hidden bg-white border border-gray-100 shadow-sm rounded-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wider text-gray-500 uppercase border-b border-gray-100 bg-gray-50">
                            <th class="w-16 px-6 py-4 text-center">ID</th>
                            <th class="px-6 py-4">No Kartu Keluarga (KK)</th>
                            <th class="px-6 py-4">Wilayah Tinggal</th>
                            <th class="px-6 py-4">Detail Alamat</th>
                            <th class="px-6 py-4 text-center">Jumlah Anggota</th>
                            <th class="w-32 px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-700 divide-y divide-gray-100">
                        @if($families->isNotEmpty())
                        @php $no = $families->firstItem(); @endphp
                        @foreach($families as $item)
                        <tr class="transition-colors hover:bg-gray-50/70">
                            <td class="px-6 py-4 font-medium text-center text-gray-400">{{ $no++ }}</td>
                            <td x-show="openData" class="px-6 py-4 font-semibold text-gray-900">{{ $item->family_card_number }}</td>
                            <td x-show="!openData" class="px-6 py-4 font-semibold text-gray-900"><x-vaadin-ellipsis-h class="size-5 text-slate-400" /></td>
                            <td class="px-6 py-4 text-gray-600">
                                @if($item->territory)
                                    Dusun {{ ucfirst($item->territory->sub_village) }} (RT {{ $item->territory->rt }} / RW {{ $item->territory->rw }})
                                @else
                                    <span class="text-xs text-gray-400 italic">Tidak dikaitkan</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-500 max-w-xs truncate">{{ $item->address_detail }}</td>
                            <td class="px-6 py-4 text-center font-medium">{{ $item->citizens->count() }} orang</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button @click='openModal(@json($item))' class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-md transition-colors" title="Edit Data">
                                        <x-heroicon-o-pencil-square class="w-4 h-4" />
                                    </button>
                                    <form action="{{ route('families.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data keluarga ini? Seluruh data warga/penduduk yang terikat dengan KK ini mungkin akan mengalami kendala.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-red-600 hover:bg-red-50 rounded-md transition-colors" title="Hapus Data">
                                            <x-heroicon-o-trash class="w-4 h-4" />
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="8" class="py-10 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center gap-2 py-4">
                                    <x-heroicon-o-folder-open class="size-8 text-gray-300" />
                                    <p class="text-sm font-medium">Data Keluarga tidak ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="flex items-center justify-between px-6 py-4 text-xs text-gray-500 border-t border-gray-100 bg-gray-50/50">
                <p>Menampilkan {{ $families->firstItem() ?? 0 }} sampai {{ $families->lastItem() ?? 0 }} dari {{ $families->total() }} keluarga</p>
                <div class="inline-flex gap-1">
                    @if ($families->onFirstPage())
                    <button class="px-3 py-1.5 border border-gray-200 rounded bg-white opacity-50 text-gray-600" disabled>
                        Sebelumnya
                    </button>
                    @else
                    <a href="{{ $families->previousPageUrl() }}" class="px-3 py-1.5 border border-gray-200 rounded bg-white hover:bg-gray-50 text-gray-600">
                        Sebelumnya
                    </a>
                    @endif

                    @if ($families->hasMorePages())
                    <a href="{{ $families->nextPageUrl() }}" class="px-3 py-1.5 border border-gray-200 rounded bg-white hover:bg-gray-50 text-gray-600">
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
