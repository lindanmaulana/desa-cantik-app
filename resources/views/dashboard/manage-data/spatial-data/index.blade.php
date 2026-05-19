<x-layouts.dashboard>
    @php
        $typeLabels = [
            'resident_house' => 'Rumah Penduduk',
            'public_facility' => 'Fasilitas Publik',
            'village_boundary' => 'Batas Wilayah Desa',
            'msme_location' => 'Lokasi Usaha (UMKM)',
        ];
    @endphp

    <div class="p-6 bg-gray-50" x-data="{
            openCreate: false,
            openUpdate: false,
            spatial: {
                id: '',
                feature_type: '',
                feature_id: '',
                latitude: '',
                longtitude: '',
                geojson: ''
            },

            openModal(data) {
                this.spatial = {
                    id: data.id,
                    feature_type: data.feature_type || '',
                    feature_id: data.feature_id || '',
                    latitude: data.latitude || '',
                    longtitude: data.longtitude || '',
                    geojson: data.geojson ? JSON.stringify(data.geojson) : ''
                };
                this.openUpdate = true;
            }
        }">

        <div class="flex flex-col items-start justify-between gap-4 mb-6 md:flex-row md:items-center">
            <div class="max-w-2xl">
                <h2 class="flex items-center gap-2 text-2xl font-bold text-gray-800">
                    <x-iconsax-lin-map class="w-6 h-6 text-emerald-600" />
                    Manajemen Pemetaan Koordinat Spasial Geografis (GIS)
                </h2>
                <p class="mt-1 text-sm text-gray-500">Pemetaan koordinat digital desa terintegrasi. Menghubungkan titik lokasi rumah warga, fasilitas prasarana publik, dan titik UMKM.</p>
            </div>

            <button @click="openCreate = true" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors bg-emerald-600 rounded-lg shadow-sm hover:bg-emerald-700">
                <x-heroicon-o-plus class="w-4 h-4 mr-2" />
                Tambah Koordinat Baru
            </button>
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

        @include('dashboard.manage-data.spatial-data.partials.modal.create')
        @include('dashboard.manage-data.spatial-data.partials.modal.update')

        <div class="grid grid-cols-2 gap-4 mb-6 sm:grid-cols-4">
            <div class="flex items-center justify-between p-4 bg-white border border-gray-100 shadow-sm rounded-xl">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase">Total Titik Peta</p>
                    <h3 class="mt-1 text-2xl font-bold text-gray-800">{{ $counts->total_Points }} Titik</h3>
                </div>
                <div class="p-3 text-emerald-600 rounded-lg bg-emerald-50">
                    <x-iconsax-lin-map class="w-6 h-6" />
                </div>
            </div>
            <div class="flex items-center justify-between p-4 bg-white border border-gray-100 shadow-sm rounded-xl">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase">Rumah Penduduk</p>
                    <h3 class="mt-1 text-2xl font-bold text-gray-800">{{ $counts->houses_Count }} Titik</h3>
                </div>
                <div class="p-3 text-blue-600 rounded-lg bg-blue-50">
                    <x-heroicon-o-home class="w-6 h-6" />
                </div>
            </div>
            <div class="flex items-center justify-between p-4 bg-white border border-gray-100 shadow-sm rounded-xl">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase">Fasilitas Publik</p>
                    <h3 class="mt-1 text-2xl font-bold text-gray-800">{{ $counts->facilities_Count }} Titik</h3>
                </div>
                <div class="p-3 text-amber-600 rounded-lg bg-amber-50">
                    <x-iconsax-lin-buildings class="w-6 h-6" />
                </div>
            </div>
            <div class="flex items-center justify-between p-4 bg-white border border-gray-100 shadow-sm rounded-xl">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase">Lokasi UMKM</p>
                    <h3 class="mt-1 text-2xl font-bold text-gray-800">{{ $counts->msmes_Count }} Titik</h3>
                </div>
                <div class="p-3 text-purple-600 rounded-lg bg-purple-50">
                    <x-bi-shop class="w-6 h-6" />
                </div>
            </div>
        </div>

        <form action="{{ route('dashboard.manage-data.spatial-data') }}" method="GET" class="p-4 mb-6 bg-white border border-gray-100 shadow-sm rounded-xl space-y-4">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <div class="col-span-1 md:col-span-2">
                    <label class="block mb-1 text-xs font-medium text-gray-500">Filter Jenis Objek Geografis</label>
                    <select name="feature_type" onchange="this.form.submit()" class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg focus:outline-none focus:border-emerald-500">
                        <option value="">Semua Jenis Objek</option>
                        @foreach($typeLabels as $val => $lbl)
                            <option value="{{ $val }}" {{ request('feature_type') == $val ? 'selected' : '' }}>{{ $lbl }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="flex items-end justify-end gap-2">
                    <a href="{{ route('dashboard.manage-data.spatial-data') }}" class="w-full text-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50">
                        Reset
                    </a>
                    <button type="submit" class="w-full px-4 py-2 text-sm font-medium text-white transition-colors bg-emerald-600 rounded-lg shadow-sm hover:bg-emerald-700">
                        Terapkan Filter
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
                            <th class="px-6 py-4">Tipe Objek Spasial</th>
                            <th class="px-6 py-4">Nama Objek Terkait</th>
                            <th class="px-6 py-4 text-center">Garis Lintang (Latitude)</th>
                            <th class="px-6 py-4 text-center">Garis Bujur (Longitude)</th>
                            <th class="px-6 py-4 text-center">GeoJSON Geometry</th>
                            <th class="w-32 px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-700 divide-y divide-gray-100">
                        @if($spatialDataList->isNotEmpty())
                        @php $no = $spatialDataList->firstItem(); @endphp
                        @foreach($spatialDataList as $item)
                        <tr class="transition-colors hover:bg-gray-50/70">
                            <td class="px-6 py-4 font-medium text-center text-gray-400">{{ $no++ }}</td>
                            <td class="px-6 py-4">
                                @if($item->feature_type->value === 'resident_house')
                                    <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-full bg-blue-50 text-blue-700 border border-blue-100">
                                        <x-heroicon-o-home class="w-3.5 h-3.5 mr-1" />
                                        {{ $typeLabels[$item->feature_type->value] }}
                                    </span>
                                @elseif($item->feature_type->value === 'public_facility')
                                    <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-full bg-amber-50 text-amber-700 border border-amber-100">
                                        <x-iconsax-lin-buildings class="w-3.5 h-3.5 mr-1" />
                                        {{ $typeLabels[$item->feature_type->value] }}
                                    </span>
                                @elseif($item->feature_type->value === 'msme_location')
                                    <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-full bg-purple-50 text-purple-700 border border-purple-100">
                                        <x-bi-shop class="w-3.5 h-3.5 mr-1" />
                                        {{ $typeLabels[$item->feature_type->value] }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-full bg-slate-50 text-slate-700 border border-slate-100">
                                        <x-heroicon-o-map class="w-3.5 h-3.5 mr-1" />
                                        {{ $typeLabels[$item->feature_type->value] }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($item->feature_type->value === 'resident_house' && $item->feature)
                                    <div class="font-semibold text-gray-900">{{ $item->feature->name }}</div>
                                    <div class="text-xs text-gray-400">NIK: {{ $item->feature->nik }}</div>
                                @elseif($item->feature_type->value === 'public_facility' && $item->feature)
                                    <div class="font-semibold text-gray-900">{{ $item->feature->facility_name }}</div>
                                    <div class="text-xs text-gray-400">Pendanaan: {{ $item->feature->funding_source }}</div>
                                @elseif($item->feature_type->value === 'msme_location' && $item->feature)
                                    <div class="font-semibold text-gray-900">{{ $item->feature->name }}</div>
                                    <div class="text-xs text-gray-400">NIB: {{ $item->feature->nib }}</div>
                                @elseif($item->feature_type->value === 'village_boundary')
                                    <div class="font-semibold text-gray-600 italic">Batas Peta Batas Wilayah</div>
                                @else
                                    <span class="text-xs text-rose-500 italic">Relasi Objek Terhapus / Rusak</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-mono text-center text-gray-700">{{ number_format($item->latitude, 8) }}</td>
                            <td class="px-6 py-4 font-mono text-center text-gray-700">{{ number_format($item->longtitude, 8) }}</td>
                            <td class="px-6 py-4 text-center">
                                @if($item->geojson)
                                    <span class="inline-flex items-center px-2 py-0.5 text-xs font-semibold rounded-md bg-emerald-50 text-emerald-700 border border-emerald-100" title="{{ json_encode($item->geojson) }}">
                                        GeoJSON Geometri
                                    </span>
                                @else
                                    <span class="text-xs text-gray-400 italic">Bukan Poligon</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button @click='openModal(@json($item))' class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-md transition-colors" title="Edit Spasial">
                                        <x-heroicon-o-pencil-square class="w-4 h-4" />
                                    </button>
                                    <form action="{{ route('spatial-data.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus titik koordinat GIS ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-red-600 hover:bg-red-50 rounded-md transition-colors" title="Hapus Spasial">
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
                                    <p class="text-sm font-medium">Titik spasial GIS tidak ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="flex items-center justify-between px-6 py-4 text-xs text-gray-500 border-t border-gray-100 bg-gray-50/50">
                <p>Menampilkan {{ $spatialDataList->firstItem() ?? 0 }} sampai {{ $spatialDataList->lastItem() ?? 0 }} dari {{ $spatialDataList->total() }} titik koordinat</p>
                <div class="inline-flex gap-1">
                    @if ($spatialDataList->onFirstPage())
                    <button class="px-3 py-1.5 border border-gray-200 rounded bg-white opacity-50 text-gray-600" disabled>
                        Sebelumnya
                    </button>
                    @else
                    <a href="{{ $spatialDataList->previousPageUrl() }}" class="px-3 py-1.5 border border-gray-200 rounded bg-white hover:bg-gray-50 text-gray-600">
                        Sebelumnya
                    </a>
                    @endif

                    @if ($spatialDataList->hasMorePages())
                    <a href="{{ $spatialDataList->nextPageUrl() }}" class="px-3 py-1.5 border border-gray-200 rounded bg-white hover:bg-gray-50 text-gray-600">
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
