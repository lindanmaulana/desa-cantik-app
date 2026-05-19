<x-layouts.dashboard>
    @php
        $genderLabels = [
            'male' => 'Laki-laki',
            'female' => 'Perempuan',
        ];
        $religionLabels = [
            'islam' => 'Islam',
            'protestant' => 'Kristen Protestan',
            'catholic' => 'Katolik',
            'hindu' => 'Hindu',
            'budha' => 'Buddha',
            'confucian' => 'Konghucu',
            'other' => 'Lainnya',
        ];
        $maritalLabels = [
            'single' => 'Belum Kawin',
            'married' => 'Kawin',
            'divorced' => 'Cerai Hidup',
            'widowed' => 'Cerai Mati',
        ];
        $roleLabels = [
            'head_of_family' => 'Kepala Keluarga',
            'spouse' => 'Suami/Istri',
            'child' => 'Anak',
            'parent' => 'Orang Tua',
            'other_relative' => 'Famili Lain',
        ];
    @endphp

    <div class="p-6 bg-gray-50" x-data="{
            openData: false,
            openCreate: false,
            openUpdate: false,
            citizen: { 
                id: '', 
                family_id: '', 
                id_number: '', 
                full_name: '',
                family_role: '',
                gender: '',
                birth_place: '',
                birth_date: '',
                religion: '',
                marital_status: '',
                blood_type: ''
            },

            openModal(data) {
                this.citizen = {
                    id: data.id,
                    family_id: data.family_id || '',
                    id_number: data.id_number,
                    full_name: data.full_name,
                    family_role: data.family_role || '',
                    gender: data.gender || '',
                    birth_place: data.birth_place || '',
                    birth_date: data.birth_date || '',
                    religion: data.religion || '',
                    marital_status: data.marital_status || '',
                    blood_type: data.blood_type || ''
                };
                this.openUpdate = true;
            }
        }">

        <div class="flex flex-col items-start justify-between gap-4 mb-6 md:flex-row md:items-center">
            <div>
                <h1 class="flex items-center gap-2 text-2xl font-bold text-gray-800">
                    <x-heroicon-o-identification class="w-6 h-6 text-teal-600" />
                    Kelola Data Penduduk (Citizens)
                </h1>
                <p class="mt-1 text-sm text-gray-500">Manajemen data demografi warga desa, NIK, peran keluarga, dan status kependudukan.</p>
            </div>

            <div class="flex items-center gap-2">
                <button @click="openData = !openData" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors bg-teal-600 rounded-lg shadow-sm hover:bg-teal-700">
                    <span class="flex items-center" x-show="openData">
                        <x-heroicon-o-eye class="w-4 h-4 mr-2" />
                        Sembunyikan Data Sensitif
                    </span>
                    <span class="flex items-center" x-show="!openData">
                        <x-heroicon-o-eye-slash class="w-4 h-4 mr-2" />
                        Tampilkan Data Sensitif
                    </span>
                </button>
            
                <button @click="openCreate = true" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors bg-teal-600 rounded-lg shadow-sm hover:bg-teal-700">
                    <x-heroicon-o-plus class="w-4 h-4 mr-2" />
                    Tambah Penduduk Baru
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

        @include('dashboard.manage-data.citizens.partials.modal.create')
        @include('dashboard.manage-data.citizens.partials.modal.update')

        <div class="grid grid-cols-1 gap-4 mb-6 sm:grid-cols-3">
            <div class="flex items-center justify-between p-4 bg-white border border-gray-100 shadow-sm rounded-xl">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase">Total Penduduk</p>
                    <h3 class="mt-1 text-2xl font-bold text-gray-800">{{ $counts->total_Citizens }}</h3>
                </div>
                <div class="p-3 text-teal-600 rounded-lg bg-teal-50">
                    <x-heroicon-o-user-group class="w-6 h-6" />
                </div>
            </div>
            <div class="flex items-center justify-between p-4 bg-white border border-gray-100 shadow-sm rounded-xl">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase">Laki-Laki</p>
                    <h3 class="mt-1 text-2xl font-bold text-gray-800">{{ $counts->total_Male }}</h3>
                </div>
                <div class="p-3 text-blue-600 rounded-lg bg-blue-50">
                    <x-heroicon-o-user class="w-6 h-6" />
                </div>
            </div>
            <div class="flex items-center justify-between p-4 bg-white border border-gray-100 shadow-sm rounded-xl">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase">Perempuan</p>
                    <h3 class="mt-1 text-2xl font-bold text-gray-800">{{ $counts->total_Female }}</h3>
                </div>
                <div class="p-3 text-rose-600 rounded-lg bg-rose-50">
                    <x-heroicon-o-user class="w-6 h-6" />
                </div>
            </div>
        </div>

        <form action="{{ route('dashboard.manage-data.citizens') }}" method="GET" class="p-4 mb-6 bg-white border border-gray-100 shadow-sm rounded-xl space-y-4">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-5">
                <div class="relative col-span-1 md:col-span-2">
                    <label class="block mb-1 text-xs font-medium text-gray-500">Cari NIK / Nama</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <x-heroicon-o-magnifying-glass class="w-5 h-5 text-gray-400" />
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari NIK atau Nama..." class="w-full py-2 pl-10 pr-4 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                    </div>
                </div>

                <div>
                    <label class="block mb-1 text-xs font-medium text-gray-500">Jenis Kelamin</label>
                    <select name="gender" onchange="this.form.submit()" class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg focus:outline-none focus:border-teal-500">
                        <option value="">Semua Genders</option>
                        @foreach($genderLabels as $val => $lbl)
                            <option value="{{ $val }}" {{ request('gender') == $val ? 'selected' : '' }}>{{ $lbl }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-1 text-xs font-medium text-gray-500">Agama</label>
                    <select name="religion" onchange="this.form.submit()" class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg focus:outline-none focus:border-teal-500">
                        <option value="">Semua Agama</option>
                        @foreach($religionLabels as $val => $lbl)
                            <option value="{{ $val }}" {{ request('religion') == $val ? 'selected' : '' }}>{{ $lbl }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-1 text-xs font-medium text-gray-500">Keluarga (No. KK)</label>
                    <select name="family_id" onchange="this.form.submit()" class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg focus:outline-none focus:border-teal-500">
                        <option value="">Semua Keluarga</option>
                        @foreach($families as $fam)
                            <option value="{{ $fam->id }}" {{ request('family_id') == $fam->id ? 'selected' : '' }}>
                                KK: {{ $fam->family_card_number }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex items-center justify-end gap-2 pt-2">
                <a href="{{ route('dashboard.manage-data.citizens') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50">
                    Reset Filter
                </a>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white transition-colors bg-teal-600 rounded-lg shadow-sm hover:bg-teal-700">
                    Terapkan Filter
                </button>
            </div>
        </form>

        <div class="overflow-hidden bg-white border border-gray-100 shadow-sm rounded-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wider text-gray-500 uppercase border-b border-gray-100 bg-gray-50">
                            <th class="w-16 px-6 py-4 text-center">No</th>
                            <th class="px-6 py-4">NIK</th>
                            <th class="px-6 py-4">Nama Lengkap</th>
                            <th class="px-6 py-4">Jenis Kelamin</th>
                            <th class="px-6 py-4">Hubungan</th>
                            <th class="px-6 py-4">No. Kartu Keluarga</th>
                            <th class="px-6 py-4">Status & Agama</th>
                            <th class="w-32 px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-700 divide-y divide-gray-100">
                        @if($citizens->isNotEmpty())
                        @php $no = $citizens->firstItem(); @endphp
                        @foreach($citizens as $item)
                        <tr class="transition-colors hover:bg-gray-50/70">
                            <td class="px-6 py-4 font-medium text-center text-gray-400">{{ $no++ }}</td>
                            <td class="px-6 py-4 font-semibold text-gray-900">
                                <span x-show="openData">{{ $item->id_number }}</span>
                                <span x-show="!openData"><x-vaadin-ellipsis-h class="size-5 text-slate-400" /></span>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $item->full_name }}
                                <div class="text-xs text-gray-400">
                                    {{ $item->birth_place }}, {{ $item->birth_date ? \Carbon\Carbon::parse($item->birth_date)->translatedFormat('d F Y') : '-' }} 
                                    @if($item->blood_type) <span class="ml-1 px-1 bg-gray-100 text-gray-600 rounded text-[10px]">Gol: {{ $item->blood_type }}</span> @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                @if($item->gender)
                                    <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full {{ $item->gender->value === 'male' ? 'bg-blue-50 text-blue-700' : 'bg-rose-50 text-rose-700' }}">
                                        {{ $genderLabels[$item->gender->value] ?? $item->gender->value }}
                                    </span>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                {{ $roleLabels[$item->family_role->value] ?? $item->family_role->value }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-600">
                                @if($item->family)
                                    <span x-show="openData" class="font-mono text-xs">{{ $item->family->family_card_number }}</span>
                                    <span x-show="!openData"><x-vaadin-ellipsis-h class="size-4 text-slate-400" /></span>
                                @else
                                    <span class="text-xs text-gray-400 italic">Tidak terikat</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-xs text-gray-500">
                                <div class="font-medium text-gray-700">{{ $maritalLabels[$item->marital_status->value] ?? $item->marital_status->value }}</div>
                                <div>{{ $religionLabels[$item->religion->value] ?? $item->religion->value }}</div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button @click='openModal(@json($item))' class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-md transition-colors" title="Edit Data">
                                        <x-heroicon-o-pencil-square class="w-4 h-4" />
                                    </button>
                                    <form action="{{ route('citizens.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data penduduk ini? Data akan disimpan dalam arsip.');">
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
                                    <p class="text-sm font-medium">Data Penduduk tidak ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="flex items-center justify-between px-6 py-4 text-xs text-gray-500 border-t border-gray-100 bg-gray-50/50">
                <p>Menampilkan {{ $citizens->firstItem() ?? 0 }} sampai {{ $citizens->lastItem() ?? 0 }} dari {{ $citizens->total() }} penduduk</p>
                <div class="inline-flex gap-1">
                    @if ($citizens->onFirstPage())
                    <button class="px-3 py-1.5 border border-gray-200 rounded bg-white opacity-50 text-gray-600" disabled>
                        Sebelumnya
                    </button>
                    @else
                    <a href="{{ $citizens->previousPageUrl() }}" class="px-3 py-1.5 border border-gray-200 rounded bg-white hover:bg-gray-50 text-gray-600">
                        Sebelumnya
                    </a>
                    @endif

                    @if ($citizens->hasMorePages())
                    <a href="{{ $citizens->nextPageUrl() }}" class="px-3 py-1.5 border border-gray-200 rounded bg-white hover:bg-gray-50 text-gray-600">
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
