<div class="p-8 mt-6 bg-white border rounded-[32px] border-borderPrimary shadow-sm">
    <div class="flex flex-col items-start justify-between gap-4 pb-6 border-b md:flex-row md:items-center border-borderPrimary">
        <div>
            <h3 class="flex items-center gap-2 text-xl font-bold text-textPrimary">
                <x-heroicon-o-users class="size-6 text-primary" />
                Daftar Anggota Keluarga
            </h3>

            <p class="mt-1 text-sm text-textSecondary">
                Seluruh anggota yang terdaftar pada kartu keluarga ini.
            </p>
        </div>


        <div class="flex items-center gap-3">
            <div class="px-5 py-3 text-center border rounded-xl border-borderPrimary bg-backgroundSecondary">
                <p class="text-xs font-medium tracking-wide uppercase text-textTertiary">
                    Total Anggota
                </p>

                <p class="mt-1 text-2xl font-bold text-primary">
                    {{ $family['citizens']->count() ?? '-' }}
                </p>
            </div>
        </div>
    </div>

    <div class="mt-6 overflow-hidden border rounded-2xl border-borderPrimary">
        <div class="overflow-y-auto max-h-[420px]">
            <table class="min-w-full">
                {{-- Header --}}
                <thead class="sticky top-0 z-10 bg-white">
                    <tr class="text-xs font-semibold tracking-wider uppercase text-textTertiary">
                        <th class="px-6 py-4 text-left">
                            Anggota
                        </th>
                        <th class="px-4 py-4 text-left">
                            Hubungan
                        </th>
                        <th class="px-4 py-4 text-left">
                            Jenis Kelamin
                        </th>
                        <th class="px-4 py-4 text-left">
                            Umur
                        </th>
                        <th class="px-6 py-4 text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-borderPrimary">
                    @if($family['citizens']->isNotEmpty())
                    @foreach($family['citizens'] as $citizen)
                    @php
                    $words = explode(' ', $citizen['full_name']);
                    $initials = isset($words[1]) ? substr($words[0], 0, 1) . substr($words[1], 0, 1) : substr($words[0], 0, 2);
                    @endphp
                    <tr class="transition hover:bg-backgroundSecondary">
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-4">
                                <div class="flex items-center justify-center font-semibold uppercase rounded-full size-12 bg-primary/10 text-primary">
                                    {{ $initials }}
                                </div>
                                <div>
                                    <p class="font-semibold text-textPrimary">
                                        {{ $citizen['full_name'] }}
                                    </p>
                                    <p class="text-sm text-textSecondary">
                                        NIK •••••••••••••{{ substr($citizen['id_number'], -3) }}
                                    </p>
                                </div>
                            </div>
                        </td>

                        <td class="px-4 py-5 text-textPrimary">
                            {{ $citizen['family_role']->label() }}
                        </td>

                        <td class="px-4 py-5 text-textPrimary">
                            {{ $citizen['gender']->label() }}
                        </td>

                        <td class="px-4 py-5 text-textPrimary">
                            @if(!empty($citizen['birth_date']))
                            {{ $citizen['birth_date']->age }} Tahun
                            @else
                            -
                            @endif
                        </td>

                        <td class="px-6 py-5">
                            <div class="flex items-center justify-center">
                                <a href="{{ route('dashboard.manage-data.citizens.detail', $citizen) }}"
                                    class="p-1.5 text-primary hover:bg-primary/10 rounded-md transition-colors inline-flex items-center justify-center"
                                    title="Lihat Detail">
                                    <x-heroicon-o-eye class="w-4 h-4" />
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="6" class="py-10 text-center text-textSecondary">
                            <div class="flex flex-col items-center justify-center gap-2 py-4">
                                <x-heroicon-o-folder-open class="text-textTertiary/60 size-8" />
                                <p class="text-sm font-medium"> Belum ada data anggota keluarga.</p>
                            </div>
                        </td>
                    </tr>

                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
