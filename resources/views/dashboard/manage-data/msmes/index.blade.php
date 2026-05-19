<x-layouts.dashboard>
    @php
        $categoryLabels = [
            'culinary' => 'Kuliner / Makanan',
            'fashion' => 'Fashion & Pakaian',
            'agriculture' => 'Pertanian & Peternakan',
            'services' => 'Jasa / Pelayanan',
            'craft' => 'Kerajinan Tangan',
            'trade' => 'Perdagangan / Toko',
            'other' => 'Usaha Lainnya',
        ];
    @endphp

    <div class="p-6 bg-gray-50" x-data="{
            openData: false,
            openCreate: false,
            openUpdate: false,
            msme: {
                id: '',
                citizen_id: '',
                business_name: '',
                business_category: '',
                license_number: '',
                employee_count: 0,
                mothly_revenue: ''
            },

            openModal(data) {
                this.msme = {
                    id: data.id,
                    citizen_id: data.citizen_id || '',
                    business_name: data.business_name || '',
                    business_category: data.business_category || '',
                    license_number: data.license_number || '',
                    employee_count: data.employee_count || 0,
                    mothly_revenue: data.mothly_revenue || ''
                };
                this.openUpdate = true;
            }
        }">

        <div class="flex flex-col items-start justify-between gap-4 mb-6 md:flex-row md:items-center">
            <div class="max-w-2xl">
                <h2 class="flex items-center gap-2 text-2xl font-bold text-gray-800">
                    <x-bi-shop class="w-6 h-6 text-emerald-600" />
                    Kelola Sektor Produktif Ekonomi (UMKM / MSMEs)
                </h2>
                <p class="mt-1 text-sm text-gray-500">Pemetaan dan pendataan kepemilikan usaha mikro, jumlah tenaga kerja lokal, serta estimasi omset bulanan warga desa.</p>
            </div>

            <div class="flex items-center gap-2">
                <button @click="openData = !openData" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors bg-emerald-600 rounded-lg shadow-sm hover:bg-emerald-700">
                    <span class="flex items-center" x-show="openData">
                        <x-heroicon-o-eye class="w-4 h-4 mr-2" />
                        Sembunyikan Data Sensitif
                    </span>
                    <span class="flex items-center" x-show="!openData">
                        <x-heroicon-o-eye-slash class="w-4 h-4 mr-2" />
                        Tampilkan Data Sensitif
                    </span>
                </button>
            
                <button @click="openCreate = true" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors bg-emerald-600 rounded-lg shadow-sm hover:bg-emerald-700">
                    <x-heroicon-o-plus class="w-4 h-4 mr-2" />
                    Tambah UMKM Baru
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

        @include('dashboard.manage-data.msmes.partials.modal.create')
        @include('dashboard.manage-data.msmes.partials.modal.update')

        <div class="grid grid-cols-1 gap-4 mb-6 sm:grid-cols-3">
            <div class="flex items-center justify-between p-4 bg-white border border-gray-100 shadow-sm rounded-xl">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase">Total Unit Usaha</p>
                    <h3 class="mt-1 text-2xl font-bold text-gray-800">{{ $counts->total_Msmes }}</h3>
                </div>
                <div class="p-3 text-emerald-600 rounded-lg bg-emerald-50">
                    <x-bi-shop class="w-6 h-6" />
                </div>
            </div>
            <div class="flex items-center justify-between p-4 bg-white border border-gray-100 shadow-sm rounded-xl">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase">Total Tenaga Kerja</p>
                    <h3 class="mt-1 text-2xl font-bold text-gray-800">{{ number_format($counts->total_Employees, 0, ',', '.') }} Orang</h3>
                </div>
                <div class="p-3 text-amber-600 rounded-lg bg-amber-50">
                    <x-heroicon-o-users class="w-6 h-6" />
                </div>
            </div>
            <div class="flex items-center justify-between p-4 bg-white border border-gray-100 shadow-sm rounded-xl">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase">Total Omset Bulanan</p>
                    <h3 class="mt-1 text-2xl font-bold text-gray-800">
                        <span x-show="openData">Rp. {{ number_format($counts->total_Revenue, 2, ',', '.') }}</span>
                        <span x-show="!openData"><x-vaadin-ellipsis-h class="size-6 text-slate-400 inline" /></span>
                    </h3>
                </div>
                <div class="p-3 text-blue-600 rounded-lg bg-blue-50">
                    <x-phosphor-money class="w-6 h-6" />
                </div>
            </div>
        </div>

        <form action="{{ route('dashboard.manage-data.msmes') }}" method="GET" class="p-4 mb-6 bg-white border border-gray-100 shadow-sm rounded-xl space-y-4">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
                <div class="relative col-span-1 md:col-span-2">
                    <label class="block mb-1 text-xs font-medium text-gray-500">Cari NIB / Nama Toko / Nama Pemilik</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <x-heroicon-o-magnifying-glass class="w-5 h-5 text-gray-400" />
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari NIB, Nama Toko, atau Nama Pemilik..." class="w-full py-2 pl-10 pr-4 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                    </div>
                </div>

                <div>
                    <label class="block mb-1 text-xs font-medium text-gray-500">Kategori Usaha</label>
                    <select name="business_category" onchange="this.form.submit()" class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg focus:outline-none focus:border-emerald-500">
                        <option value="">Semua Kategori</option>
                        @foreach($categoryLabels as $val => $lbl)
                            <option value="{{ $val }}" {{ request('business_category') == $val ? 'selected' : '' }}>{{ $lbl }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="self-end flex items-end justify-end gap-2">
                    <a href="{{ route('dashboard.manage-data.msmes') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50">
                        Reset Filter
                    </a>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white transition-colors bg-emerald-600 rounded-lg shadow-sm hover:bg-emerald-700">
                        Cari
                    </button>
                </div>
            </div>
        </form>

        <div class="overflow-hidden bg-white border border-gray-100 shadow-sm rounded-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wider text-gray-500 uppercase border-b border-gray-100 bg-gray-50">
                            <th class="w-16 px-6 py-4 text-center">No</th>
                            <th class="px-6 py-4">Nama Usaha / NIB</th>
                            <th class="px-6 py-4">Kategori Usaha</th>
                            <th class="px-6 py-4">Pemilik (Warga)</th>
                            <th class="px-6 py-4 text-center">Tenaga Kerja</th>
                            <th class="px-6 py-4">Omset Bulanan</th>
                            <th class="w-32 px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-700 divide-y divide-gray-100">
                        @if($msmes->isNotEmpty())
                        @php $no = $msmes->firstItem(); @endphp
                        @foreach($msmes as $item)
                        <tr class="transition-colors hover:bg-gray-50/70">
                            <td class="px-6 py-4 font-medium text-center text-gray-400">{{ $no++ }}</td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-900">{{ $item->business_name }}</div>
                                <div class="text-xs text-gray-400">
                                    NIB / Izin: 
                                    @if($item->license_number)
                                        <span x-show="openData">{{ $item->license_number }}</span>
                                        <span x-show="!openData"><x-vaadin-ellipsis-h class="size-4 text-slate-400 inline" /></span>
                                    @else
                                        <span class="italic">Tidak Ada</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-100">
                                    {{ $categoryLabels[$item->business_category->value] ?? $item->business_category->value }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($item->citizen)
                                    <div class="font-medium text-gray-800">{{ $item->citizen->full_name }}</div>
                                    <div class="text-xs text-gray-400">
                                        NIK: 
                                        <span x-show="openData">{{ $item->citizen->id_number }}</span>
                                        <span x-show="!openData"><x-vaadin-ellipsis-h class="size-4 text-slate-400 inline" /></span>
                                    </div>
                                @else
                                    <span class="text-xs text-gray-400 italic">Data Warga dihapus</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-medium text-center text-gray-900">
                                {{ $item->employee_count }} Orang
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900">
                                <span x-show="openData">Rp. {{ number_format($item->mothly_revenue, 2, ',', '.') }}</span>
                                <span x-show="!openData"><x-vaadin-ellipsis-h class="size-5 text-slate-400 inline" /></span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button @click='openModal(@json($item))' class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-md transition-colors" title="Edit UMKM">
                                        <x-heroicon-o-pencil-square class="w-4 h-4" />
                                    </button>
                                    <form action="{{ route('msmes.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus profil UMKM ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-red-600 hover:bg-red-50 rounded-md transition-colors" title="Hapus UMKM">
                                            <x-heroicon-o-trash class="w-4 h-4" />
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="7" class="py-10 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center gap-2 py-4">
                                    <x-heroicon-o-folder-open class="size-8 text-gray-300" />
                                    <p class="text-sm font-medium">Profil UMKM tidak ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="flex items-center justify-between px-6 py-4 text-xs text-gray-500 border-t border-gray-100 bg-gray-50/50">
                <p>Menampilkan {{ $msmes->firstItem() ?? 0 }} sampai {{ $msmes->lastItem() ?? 0 }} dari {{ $msmes->total() }} UMKM</p>
                <div class="inline-flex gap-1">
                    @if ($msmes->onFirstPage())
                    <button class="px-3 py-1.5 border border-gray-200 rounded bg-white opacity-50 text-gray-600" disabled>
                        Sebelumnya
                    </button>
                    @else
                    <a href="{{ $msmes->previousPageUrl() }}" class="px-3 py-1.5 border border-gray-200 rounded bg-white hover:bg-gray-50 text-gray-600">
                        Sebelumnya
                    </a>
                    @endif

                    @if ($msmes->hasMorePages())
                    <a href="{{ $msmes->nextPageUrl() }}" class="px-3 py-1.5 border border-gray-200 rounded bg-white hover:bg-gray-50 text-gray-600">
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
</x-layouts.dashboard>
