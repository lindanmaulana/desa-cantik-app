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
                                    {{ App\Enums\Gender::tryFrom($item->gender->value)?->label() ?? '-' }}
                                </span>
                                @else
                                -
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                {{ App\Enums\FamilyRole::tryFrom($item->family_role->value)?->label() ?? '-' }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-600">
                                @if($item->family)
                                <span x-show="openData" class="font-mono text-xs">{{ $item->family->family_card_number }}</span>
                                <span x-show="!openData"><x-vaadin-ellipsis-h class="size-4 text-slate-400" /></span>
                                @else
                                <span class="text-xs italic text-gray-400">Tidak terikat</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-xs text-gray-500">
                                <div class="font-medium text-gray-700">{{ App\Enums\MaritalStatus::tryFrom($item->marital_status->value)?->label() ?? '-' }}</div>
                                <div>{{ App\Enums\Religion::tryFrom($item->religion->value)?->label() ?? '-' }}</div>
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
                                    <x-heroicon-o-folder-open class="text-gray-300 size-8" />
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