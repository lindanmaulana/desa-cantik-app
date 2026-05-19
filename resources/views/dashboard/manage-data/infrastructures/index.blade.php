<x-layouts.dashboard>
    @php
        $typeLabels = [
            'road' => 'Jalanan Desa',
            'bridge' => 'Jembatan Umum',
            'irrigation' => 'Saluran Irigasi',
            'education' => 'Sarana Pendidikan',
            'health' => 'Sarana Kesehatan',
            'worship' => 'Tempat Ibadah',
            'goverment' => 'Kantor Pemerintahan',
        ];

        $conditionLabels = [
            'good' => 'Baik / Layak',
            'damaged_light' => 'Rusak Ringan',
            'damaged_severe' => 'Rusak Berat',
        ];
    @endphp

    <div class="p-6 bg-gray-50" x-data="{
            openData: false,
            openCreate: false,
            openUpdate: false,
            infrastructure: {
                id: '',
                facility_name: '',
                facility_type: '',
                condition: '',
                construction_year: '',
                funding_source: ''
            },

            openModal(data) {
                this.infrastructure = {
                    id: data.id,
                    facility_name: data.facility_name || '',
                    facility_type: data.facility_type || '',
                    condition: data.condition || '',
                    construction_year: data.construction_year || '',
                    funding_source: data.funding_source || ''
                };
                this.openUpdate = true;
            }
        }">

        <div class="flex flex-col items-start justify-between gap-4 mb-6 md:flex-row md:items-center">
            <div class="max-w-2xl">
                <h2 class="flex items-center gap-2 text-2xl font-bold text-gray-800">
                    <x-iconsax-lin-buildings class="w-6 h-6 text-emerald-600" />
                    Manajemen Logistik & Aset Fisik Desa (Infrastructures)
                </h2>
                <p class="mt-1 text-sm text-gray-500">Pemetaan sarana umum, pencatatan status kelayakan infrastruktur fisik desa, tahun konstruksi, dan alokasi anggaran.</p>
            </div>

            <div class="flex items-center gap-2">
                <button @click="openData = !openData" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors bg-emerald-600 rounded-lg shadow-sm hover:bg-emerald-700">
                    <span class="flex items-center" x-show="openData">
                        <x-heroicon-o-eye class="w-4 h-4 mr-2" />
                        Sembunyikan Data Anggaran
                    </span>
                    <span class="flex items-center" x-show="!openData">
                        <x-heroicon-o-eye-slash class="w-4 h-4 mr-2" />
                        Tampilkan Data Anggaran
                    </span>
                </button>
            
                <button @click="openCreate = true" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors bg-emerald-600 rounded-lg shadow-sm hover:bg-emerald-700">
                    <x-heroicon-o-plus class="w-4 h-4 mr-2" />
                    Tambah Aset Baru
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

        @include('dashboard.manage-data.infrastructures.partials.modal.create')
        @include('dashboard.manage-data.infrastructures.partials.modal.update')

        <div class="grid grid-cols-1 gap-4 mb-6 sm:grid-cols-3">
            <div class="flex items-center justify-between p-4 bg-white border border-gray-100 shadow-sm rounded-xl">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase">Total Inventaris Aset</p>
                    <h3 class="mt-1 text-2xl font-bold text-gray-800">{{ $counts->total_Assets }} Unit</h3>
                </div>
                <div class="p-3 text-emerald-600 rounded-lg bg-emerald-50">
                    <x-iconsax-lin-buildings class="w-6 h-6" />
                </div>
            </div>
            <div class="flex items-center justify-between p-4 bg-white border border-gray-100 shadow-sm rounded-xl">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase">Kondisi Layak / Baik</p>
                    <h3 class="mt-1 text-2xl font-bold text-gray-800">{{ $counts->good_Condition }} Unit</h3>
                </div>
                <div class="p-3 text-blue-600 rounded-lg bg-blue-50">
                    <x-heroicon-o-check-circle class="w-6 h-6" />
                </div>
            </div>
            <div class="flex items-center justify-between p-4 bg-white border border-gray-100 shadow-sm rounded-xl">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase">Mengalami Kerusakan</p>
                    <h3 class="mt-1 text-2xl font-bold text-gray-800">{{ $counts->damaged_Assets }} Unit</h3>
                </div>
                <div class="p-3 text-rose-600 rounded-lg bg-rose-50">
                    <x-heroicon-o-exclamation-triangle class="w-6 h-6" />
                </div>
            </div>
        </div>

        <form action="{{ route('dashboard.manage-data.infrastructures') }}" method="GET" class="p-4 mb-6 bg-white border border-gray-100 shadow-sm rounded-xl space-y-4">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
                <div class="relative col-span-1 md:col-span-2">
                    <label class="block mb-1 text-xs font-medium text-gray-500">Cari Nama Aset / Sumber Dana</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <x-heroicon-o-magnifying-glass class="w-5 h-5 text-gray-400" />
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Jembatan, Jalan, atau Anggaran..." class="w-full py-2 pl-10 pr-4 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                    </div>
                </div>

                <div>
                    <label class="block mb-1 text-xs font-medium text-gray-500">Jenis Fasilitas</label>
                    <select name="facility_type" onchange="this.form.submit()" class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg focus:outline-none focus:border-emerald-500">
                        <option value="">Semua Jenis</option>
                        @foreach($typeLabels as $val => $lbl)
                            <option value="{{ $val }}" {{ request('facility_type') == $val ? 'selected' : '' }}>{{ $lbl }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-1 text-xs font-medium text-gray-500">Kondisi Kelayakan</label>
                    <select name="condition" onchange="this.form.submit()" class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg focus:outline-none focus:border-emerald-500">
                        <option value="">Semua Kondisi</option>
                        @foreach($conditionLabels as $val => $lbl)
                            <option value="{{ $val }}" {{ request('condition') == $val ? 'selected' : '' }}>{{ $lbl }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="flex items-center justify-end gap-2 pt-2 border-t border-gray-50">
                <a href="{{ route('dashboard.manage-data.infrastructures') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50">
                    Reset Filter
                </a>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white transition-colors bg-emerald-600 rounded-lg shadow-sm hover:bg-emerald-700">
                    Terapkan Pencarian
                </button>
            </div>
        </form>

        <div class="overflow-hidden bg-white border border-gray-100 shadow-sm rounded-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wider text-gray-500 uppercase border-b border-gray-100 bg-gray-50">
                            <th class="w-16 px-6 py-4 text-center">No</th>
                            <th class="px-6 py-4">Nama Sarana Prasarana</th>
                            <th class="px-6 py-4">Jenis Fasilitas</th>
                            <th class="px-6 py-4">Kondisi Kelayakan</th>
                            <th class="px-6 py-4 text-center">Tahun Konstruksi</th>
                            <th class="px-6 py-4">Sumber Anggaran</th>
                            <th class="w-32 px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-700 divide-y divide-gray-100">
                        @if($infrastructures->isNotEmpty())
                        @php $no = $infrastructures->firstItem(); @endphp
                        @foreach($infrastructures as $item)
                        <tr class="transition-colors hover:bg-gray-50/70">
                            <td class="px-6 py-4 font-medium text-center text-gray-400">{{ $no++ }}</td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-900">{{ $item->facility_name }}</div>
                                <div class="text-xs text-gray-400">ID: {{ substr($item->id, 0, 8) }}...</div>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $typeLabels[$item->facility_type->value] ?? $item->facility_type->value }}
                            </td>
                            <td class="px-6 py-4">
                                @if($item->condition->value === 'good')
                                    <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-100">
                                        <span class="w-1.5 h-1.5 mr-1.5 bg-emerald-500 rounded-full"></span>
                                        {{ $conditionLabels[$item->condition->value] }}
                                    </span>
                                @elseif($item->condition->value === 'damaged_light')
                                    <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-full bg-amber-50 text-amber-700 border border-amber-100">
                                        <span class="w-1.5 h-1.5 mr-1.5 bg-amber-500 rounded-full"></span>
                                        {{ $conditionLabels[$item->condition->value] }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-full bg-rose-50 text-rose-700 border border-rose-100">
                                        <span class="w-1.5 h-1.5 mr-1.5 bg-rose-500 rounded-full"></span>
                                        {{ $conditionLabels[$item->condition->value] }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-semibold text-center text-gray-900">
                                @if($item->construction_year)
                                    <span x-show="openData">{{ $item->construction_year }}</span>
                                    <span x-show="!openData"><x-vaadin-ellipsis-h class="size-4 text-slate-400 inline" /></span>
                                @else
                                    <span class="italic text-gray-400 text-xs">Belum Tercatat</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-800">
                                <span x-show="openData">{{ $item->funding_source }}</span>
                                <span x-show="!openData"><x-vaadin-ellipsis-h class="size-5 text-slate-400 inline" /></span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button @click='openModal(@json($item))' class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-md transition-colors" title="Edit Aset">
                                        <x-heroicon-o-pencil-square class="w-4 h-4" />
                                    </button>
                                    <form action="{{ route('infrastructures.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus aset infrastruktur ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-red-600 hover:bg-red-50 rounded-md transition-colors" title="Hapus Aset">
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
                                    <p class="text-sm font-medium">Aset infrastruktur tidak ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="flex items-center justify-between px-6 py-4 text-xs text-gray-500 border-t border-gray-100 bg-gray-50/50">
                <p>Menampilkan {{ $infrastructures->firstItem() ?? 0 }} sampai {{ $infrastructures->lastItem() ?? 0 }} dari {{ $infrastructures->total() }} unit sarana</p>
                <div class="inline-flex gap-1">
                    @if ($infrastructures->onFirstPage())
                    <button class="px-3 py-1.5 border border-gray-200 rounded bg-white opacity-50 text-gray-600" disabled>
                        Sebelumnya
                    </button>
                    @else
                    <a href="{{ $infrastructures->previousPageUrl() }}" class="px-3 py-1.5 border border-gray-200 rounded bg-white hover:bg-gray-50 text-gray-600">
                        Sebelumnya
                    </a>
                    @endif

                    @if ($infrastructures->hasMorePages())
                    <a href="{{ $infrastructures->nextPageUrl() }}" class="px-3 py-1.5 border border-gray-200 rounded bg-white hover:bg-gray-50 text-gray-600">
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
