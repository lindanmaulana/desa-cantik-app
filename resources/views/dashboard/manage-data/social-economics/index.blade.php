<x-layouts.dashboard>
    @php
        $educationLabels = [
            'none' => 'Tidak Sekolah',
            'elementory_school' => 'SD / Sederajat',
            'middle_school' => 'SMP / Sederajat',
            'high_school' => 'SMA / Sederajat',
            'associate_degree' => 'Diploma (D1-D4)',
            'bachelor_degree' => 'Sarjana (S1)',
            'postgraduate' => 'Pascasarjana (S2-S3)',
        ];

        $houseLabels = [
            'proper' => 'Layak Huni',
            'unfit' => 'Tidak Layak Huni',
        ];

        $economicLabels = [
            'very_poor' => 'Sangat Miskin',
            'poor' => 'Miskin',
            'near_poor' => 'Hampir Miskin',
            'middle_income' => 'Menengah',
            'high_income' => 'Mampu / Kaya',
        ];
    @endphp

    <div class="p-6 bg-gray-50" x-data="{
            openData: false,
            openCreate: false,
            openUpdate: false,
            profile: {
                id: '',
                citizen_id: '',
                education_level: '',
                occupation: '',
                monthly_income: '',
                is_welfare_recipient: '0',
                assistance_type: '',
                house_condition: '',
                economic_status: ''
            },

            openModal(data) {
                this.profile = {
                    id: data.id,
                    citizen_id: data.citizen_id || '',
                    education_level: data.education_level || '',
                    occupation: data.occupation || '',
                    monthly_income: data.monthly_income || '',
                    is_welfare_recipient: data.is_welfare_recipient ? '1' : '0',
                    assistance_type: data.assistance_type || '',
                    house_condition: data.house_condition || '',
                    economic_status: data.economic_status || ''
                };
                this.openUpdate = true;
            }
        }">

        <div class="flex flex-col items-start justify-between gap-4 mb-6 md:flex-row md:items-center">
            <div>
                <h1 class="flex items-center gap-2 text-2xl font-bold text-gray-800">
                    <x-ri-heart-pulse-line class="w-6 h-6 text-emerald-600" />
                    Kelola Profil Sosial Ekonomi (Social Economics)
                </h1>
                <p class="mt-1 text-sm text-gray-500">Analisis profil kesejahteraan, bantuan pemerintah (bansos), kelayakan hunian, dan klasifikasi ekonomi warga desa.</p>
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
                    Tambah Profil Baru
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

        @include('dashboard.manage-data.social-economics.partials.modal.create')
        @include('dashboard.manage-data.social-economics.partials.modal.update')

        <div class="grid grid-cols-1 gap-4 mb-6 sm:grid-cols-3">
            <div class="flex items-center justify-between p-4 bg-white border border-gray-100 shadow-sm rounded-xl">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase">Total Profil Warga</p>
                    <h3 class="mt-1 text-2xl font-bold text-gray-800">{{ $counts->total_Profiles }}</h3>
                </div>
                <div class="p-3 text-emerald-600 rounded-lg bg-emerald-50">
                    <x-heroicon-o-folder-open class="w-6 h-6" />
                </div>
            </div>
            <div class="flex items-center justify-between p-4 bg-white border border-gray-100 shadow-sm rounded-xl">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase">Penerima Bansos</p>
                    <h3 class="mt-1 text-2xl font-bold text-gray-800">{{ $counts->total_Recipients }}</h3>
                </div>
                <div class="p-3 text-amber-600 rounded-lg bg-amber-50">
                    <x-heroicon-o-gift class="w-6 h-6" />
                </div>
            </div>
            <div class="flex items-center justify-between p-4 bg-white border border-gray-100 shadow-sm rounded-xl">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase">Rata-Rata Pendapatan</p>
                    <h3 class="mt-1 text-2xl font-bold text-gray-800">
                        <span x-show="openData">Rp. {{ number_format($counts->average_Income, 2, ',', '.') }}</span>
                        <span x-show="!openData"><x-vaadin-ellipsis-h class="size-6 text-slate-400 inline" /></span>
                    </h3>
                </div>
                <div class="p-3 text-blue-600 rounded-lg bg-blue-50">
                    <x-phosphor-money class="w-6 h-6" />
                </div>
            </div>
        </div>

        <form action="{{ route('dashboard.manage-data.social-economics') }}" method="GET" class="p-4 mb-6 bg-white border border-gray-100 shadow-sm rounded-xl space-y-4">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-5">
                <div class="relative col-span-1 md:col-span-2">
                    <label class="block mb-1 text-xs font-medium text-gray-500">Cari NIK / Nama Penduduk</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <x-heroicon-o-magnifying-glass class="w-5 h-5 text-gray-400" />
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari NIK atau Nama..." class="w-full py-2 pl-10 pr-4 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                    </div>
                </div>

                <div>
                    <label class="block mb-1 text-xs font-medium text-gray-500">Kelayakan Hunian</label>
                    <select name="house_condition" onchange="this.form.submit()" class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg focus:outline-none focus:border-emerald-500">
                        <option value="">Semua Kondisi</option>
                        @foreach($houseLabels as $val => $lbl)
                            <option value="{{ $val }}" {{ request('house_condition') == $val ? 'selected' : '' }}>{{ $lbl }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-1 text-xs font-medium text-gray-500">Klasifikasi Ekonomi</label>
                    <select name="economic_status" onchange="this.form.submit()" class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg focus:outline-none focus:border-emerald-500">
                        <option value="">Semua Status</option>
                        @foreach($economicLabels as $val => $lbl)
                            <option value="{{ $val }}" {{ request('economic_status') == $val ? 'selected' : '' }}>{{ $lbl }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-1 text-xs font-medium text-gray-500">Status Bansos</label>
                    <select name="is_welfare_recipient" onchange="this.form.submit()" class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg focus:outline-none focus:border-emerald-500">
                        <option value="">Semua Status Bansos</option>
                        <option value="1" {{ request('is_welfare_recipient') === '1' ? 'selected' : '' }}>Penerima Bantuan</option>
                        <option value="0" {{ request('is_welfare_recipient') === '0' ? 'selected' : '' }}>Bukan Penerima</option>
                    </select>
                </div>
            </div>

            <div class="flex items-center justify-end gap-2 pt-2">
                <a href="{{ route('dashboard.manage-data.social-economics') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50">
                    Reset Filter
                </a>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white transition-colors bg-emerald-600 rounded-lg shadow-sm hover:bg-emerald-700">
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
                            <th class="px-6 py-4">NIK & Penduduk</th>
                            <th class="px-6 py-4">Pendidikan & Pekerjaan</th>
                            <th class="px-6 py-4">Estimasi Pendapatan</th>
                            <th class="px-6 py-4">Kondisi Rumah</th>
                            <th class="px-6 py-4">Tingkat Ekonomi</th>
                            <th class="px-6 py-4">Bansos & Bantuan</th>
                            <th class="w-32 px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-700 divide-y divide-gray-100">
                        @if($profiles->isNotEmpty())
                        @php $no = $profiles->firstItem(); @endphp
                        @foreach($profiles as $item)
                        <tr class="transition-colors hover:bg-gray-50/70">
                            <td class="px-6 py-4 font-medium text-center text-gray-400">{{ $no++ }}</td>
                            <td class="px-6 py-4">
                                @if($item->citizen)
                                    <div class="font-semibold text-gray-900">{{ $item->citizen->full_name }}</div>
                                    <div class="text-xs text-gray-400">
                                        NIK: 
                                        <span x-show="openData">{{ $item->citizen->id_number }}</span>
                                        <span x-show="!openData"><x-vaadin-ellipsis-h class="size-4 text-slate-400 inline" /></span>
                                    </div>
                                @else
                                    <span class="text-xs text-gray-400 italic">Data Warga dihapus</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                <div class="font-medium text-gray-800">{{ $educationLabels[$item->education_level->value] ?? $item->education_level->value }}</div>
                                <div class="text-xs text-gray-400">Pekerjaan: {{ $item->occupation }}</div>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900">
                                <span x-show="openData">Rp. {{ number_format($item->monthly_income, 2, ',', '.') }}</span>
                                <span x-show="!openData"><x-vaadin-ellipsis-h class="size-5 text-slate-400 inline" /></span>
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full {{ $item->house_condition->value === 'proper' ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700' }}">
                                    {{ $houseLabels[$item->house_condition->value] ?? $item->house_condition->value }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $economicColorClasses = [
                                        'very_poor' => 'bg-red-100 text-red-800 border-red-200',
                                        'poor' => 'bg-orange-100 text-orange-800 border-orange-200',
                                        'near_poor' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                        'middle_income' => 'bg-blue-100 text-blue-800 border-blue-200',
                                        'high_income' => 'bg-green-100 text-green-800 border-green-200',
                                    ];
                                    $eClass = $economicColorClasses[$item->economic_status->value] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-1.5 text-xs font-semibold rounded-md border {{ $eClass }}">
                                    {{ $economicLabels[$item->economic_status->value] ?? $item->economic_status->value }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($item->is_welfare_recipient)
                                    <div class="flex flex-col gap-0.5">
                                        <span class="inline-flex items-center w-fit px-2 py-0.5 text-xs font-semibold rounded-full bg-amber-100 text-amber-800">
                                            Penerima Bansos
                                        </span>
                                        <span class="text-xs text-gray-500 font-medium">{{ $item->assistance_type }}</span>
                                    </div>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 text-xs font-semibold rounded-full bg-gray-100 text-gray-500">
                                        Bukan Penerima
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button @click='openModal(@json($item))' class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-md transition-colors" title="Edit Data">
                                        <x-heroicon-o-pencil-square class="w-4 h-4" />
                                    </button>
                                    <form action="{{ route('social-economics.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus profil sosial ekonomi ini?');">
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
                                    <p class="text-sm font-medium">Profil Sosial Ekonomi tidak ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="flex items-center justify-between px-6 py-4 text-xs text-gray-500 border-t border-gray-100 bg-gray-50/50">
                <p>Menampilkan {{ $profiles->firstItem() ?? 0 }} sampai {{ $profiles->lastItem() ?? 0 }} dari {{ $profiles->total() }} profil</p>
                <div class="inline-flex gap-1">
                    @if ($profiles->onFirstPage())
                    <button class="px-3 py-1.5 border border-gray-200 rounded bg-white opacity-50 text-gray-600" disabled>
                        Sebelumnya
                    </button>
                    @else
                    <a href="{{ $profiles->previousPageUrl() }}" class="px-3 py-1.5 border border-gray-200 rounded bg-white hover:bg-gray-50 text-gray-600">
                        Sebelumnya
                    </a>
                    @endif

                    @if ($profiles->hasMorePages())
                    <a href="{{ $profiles->nextPageUrl() }}" class="px-3 py-1.5 border border-gray-200 rounded bg-white hover:bg-gray-50 text-gray-600">
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
