<x-layouts.client>
    <div class="space-y-8 p-2 content-fade sm:space-y-10 sm:p-3 md:p-6 lg:p-8">
        @if (session('success'))
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700">
                {{ session('error') }}
            </div>
        @endif

        <section class="relative overflow-hidden rounded-[2rem] bg-gradient-to-r from-slate-900 via-primary to-emerald-500 p-6 text-white shadow-lg sm:p-10 lg:p-12">
            <div class="relative z-10 max-w-3xl space-y-5">
                <div class="flex flex-wrap gap-2 text-xs font-bold">
                    <span class="rounded-full bg-amber-400 px-4 py-2 text-slate-900">
                        <x-heroicon-o-check-badge class="mr-1 inline h-4 w-4" /> SOP RESMI DESA
                    </span>
                    <span class="rounded-full bg-white px-4 py-2 text-slate-900">
                        <x-heroicon-o-shield-check class="mr-1 inline h-4 w-4" /> LAYANAN DATA & INFORMASI
                    </span>
                    <span class="rounded-full bg-emerald-700 px-4 py-2 text-white">
                        <x-heroicon-o-circle-stack class="mr-1 inline h-4 w-4" /> SATU DATA DESA
                    </span>
                </div>
                <h1 class="text-3xl font-bold leading-tight tracking-tight sm:text-5xl">
                    <span class="block"><x-heroicon-o-chart-bar-square class="mr-2 inline h-9 w-9 text-amber-400 sm:h-11 sm:w-11" />Standard Operating Procedure (SOP)</span>
                    <span class="block">Permintaan Data</span>
                </h1>
                <p class="max-w-3xl text-sm leading-relaxed text-white/95 sm:text-lg">
                    Pedoman resmi alur pelayanan permohonan data dan informasi statistik di Desa
                    {{ $villageSettings->village_name ?? '-' }}. Memastikan akuntabilitas, transparansi, dan
                    perlindungan privasi data warga sesuai ketentuan perundang-undangan.
                </p>
            </div>
        </section>

        <section class="rounded-3xl border-l-4 border-primary bg-secondary p-6 shadow-sm sm:p-8">
            <div class="flex items-start gap-4">
                <div class="rounded-xl bg-teal-100 p-3 text-teal-700">
                    <x-heroicon-o-building-library class="h-7 w-7" />
                </div>
                <div class="min-w-0 flex-1">
                    <h2 class="text-xl font-bold text-textPrimary sm:text-2xl">Landasan Hukum & Dasar Regulasi SOP</h2>
                    <p class="mt-1 text-sm text-textSecondary sm:text-base">
                        Payung hukum resmi yang mendasari alur dan tata kelola pelayanan data di
                        {{ $villageSettings->village_name ?? '-' }}.
                    </p>
                </div>
            </div>
            <div class="mt-6 grid grid-cols-1 gap-4 lg:grid-cols-3">
                @foreach ([
                    ['title' => 'UU No. 16 Tahun 1997', 'subtitle' => 'Tentang Statistik', 'text' => 'Landasan penyelenggaraan kegiatan statistik dasar, sektoral, dan khusus secara tertib, terbuka, dan bertanggung jawab.', 'color' => 'text-blue-700', 'icon' => 'heroicon-o-document-text'],
                    ['title' => 'UU No. 27 Tahun 2022', 'subtitle' => 'Perlindungan Data Pribadi (PDP)', 'text' => 'Jaminan hukum perlindungan hak privasi warga serta kewajiban prosedur anonimisasi pada penyerahan data mikro.', 'color' => 'text-rose-600', 'icon' => 'heroicon-o-shield-exclamation'],
                    ['title' => 'Permendagri No. 12 Tahun 2007', 'subtitle' => 'Profil & Monografi Desa', 'text' => 'Pedoman resmi penyusunan, pengolahan, serta pendayagunaan data profil dan monografi desa/kelurahan.', 'color' => 'text-emerald-700', 'icon' => 'heroicon-o-document'],
                ] as $regulation)
                    <div class="rounded-xl border border-slate-200 bg-tertiary/50 p-5">
                        <h3 class="font-bold {{ $regulation['color'] }}">
                            <x-dynamic-component :component="$regulation['icon']" class="mr-1 inline h-5 w-5" />
                            {{ $regulation['title'] }}
                        </h3>
                        <h4 class="mt-2 text-base font-bold text-textPrimary">{{ $regulation['subtitle'] }}</h4>
                        <p class="mt-2 text-sm leading-relaxed text-textSecondary">{{ $regulation['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
            @foreach ([
                ['number' => '1', 'title' => 'Identifikasi Kebutuhan', 'text' => 'Pengguna menentukan jenis data: Data Aggregate (bebas diunduh di Pandawa) atau Data Mikro (memerlukan permohonan).', 'color' => 'border-blue-500', 'bubble' => 'bg-blue-700'],
                ['number' => '2', 'title' => 'Verifikasi Pemdes', 'text' => 'Pemerintah Desa melakukan pengecekan keabsahan permohonan, kesesuaian tujuan penggunaan, serta ketersediaan data.', 'color' => 'border-amber-500', 'bubble' => 'bg-amber-400 text-slate-900'],
                ['number' => '3', 'title' => 'Pengolahan & Anonimisasi', 'text' => 'Pengolahan data melalui sistem Pandawa dengan penghilangan Identitas Pribadi (PII) untuk menjamin privasi warga.', 'color' => 'border-violet-500', 'bubble' => 'bg-violet-500'],
                ['number' => '4', 'title' => 'Serah Terima & Arsip', 'text' => 'Verifikasi akhir sebelum penyerahan data resmi kepada pemohon beserta pengarsipan berkas surat permohonan.', 'color' => 'border-emerald-500', 'bubble' => 'bg-emerald-700'],
            ] as $step)
                <article class="rounded-2xl border-l-4 {{ $step['color'] }} bg-secondary p-6 shadow-sm">
                    <div class="flex items-center gap-4">
                        <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full text-xl font-bold text-white {{ $step['bubble'] }}">
                            {{ $step['number'] }}
                        </span>
                        <h3 class="text-lg font-bold leading-tight text-textPrimary">{{ $step['title'] }}</h3>
                    </div>
                    <p class="mt-4 text-sm leading-relaxed text-textSecondary">{{ $step['text'] }}</p>
                </article>
            @endforeach
        </section>

        <section class="grid grid-cols-1 gap-6 rounded-3xl bg-secondary p-6 shadow-sm sm:p-8 lg:grid-cols-2">
            <div>
                <h2 class="flex items-center gap-3 text-xl font-bold text-textPrimary">
                    <x-heroicon-o-shield-check class="h-7 w-7 text-emerald-600" />
                    Prinsip Utama Layanan Data
                </h2>
                <div class="mt-5 grid grid-cols-1 gap-3 sm:grid-cols-2">
                    @foreach ([
                        ['label' => 'Keamanan Data', 'icon' => 'heroicon-o-lock-closed', 'color' => 'text-blue-700'],
                        ['label' => 'Kepatuhan Regulasi', 'icon' => 'heroicon-o-check-badge', 'color' => 'text-emerald-700'],
                        ['label' => 'Akurat & Tepat Waktu', 'icon' => 'heroicon-o-clock', 'color' => 'text-amber-500'],
                        ['label' => 'Privasi Terjamin', 'icon' => 'heroicon-o-eye-slash', 'color' => 'text-rose-500'],
                    ] as $principle)
                        <div class="flex items-center gap-3 rounded-xl bg-tertiary/60 p-4 font-semibold text-textPrimary">
                            <x-dynamic-component :component="$principle['icon']" class="h-5 w-5 {{ $principle['color'] }}" />
                            {{ $principle['label'] }}
                        </div>
                    @endforeach
                </div>
            </div>
            <div>
                <h2 class="flex items-center gap-3 text-xl font-bold text-textPrimary">
                    <x-heroicon-o-information-circle class="h-7 w-7 text-blue-700" />
                    Ketentuan Permohonan Data
                </h2>
                <ul class="mt-4 list-disc space-y-2 pl-5 text-sm leading-relaxed text-textSecondary">
                    <li>Semua permintaan data wajib mencantumkan tujuan penggunaan yang sah dan jelas.</li>
                    <li>Data mikro hanya diberikan untuk keperluan resmi/penelitian dengan prosedur persetujuan Pemdes.</li>
                    <li>Seluruh data yang diserahkan telah melalui proses anonimisasi sesuai standar UU No. 27/2022 tentang PDP.</li>
                </ul>
            </div>
        </section>

        <section x-data="{ uploadOpen: false, preview: null }" class="relative overflow-visible rounded-3xl bg-slate-900 shadow-sm">
            <div class="flex flex-col justify-between gap-4 p-6 text-white sm:flex-row sm:items-center sm:px-8">
                <h2 class="flex items-center gap-3 text-lg font-bold sm:text-xl">
                    <x-heroicon-o-photo class="h-7 w-7 text-amber-400" />
                    Diagram Alur SOP Permintaan Data (Infografis Lengkap)
                </h2>
                @auth
                    @if (auth()->user()->role->value === \App\Enums\UserRole::ADMIN->value)
                        <div class="flex flex-wrap gap-2">
                            <button type="button" @click="uploadOpen = true"
                                class="inline-flex items-center justify-center gap-2 rounded-full border border-white/50 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-white/10">
                                <x-heroicon-o-arrow-up-tray class="h-5 w-5" />
                                Upload Diagram
                            </button>
                            @if (!empty($villageSettings->sop_diagram_path))
                                <form method="POST" action="{{ route('sop.diagram.destroy') }}"
                                    onsubmit="return confirm('Hapus diagram SOP?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center justify-center gap-2 rounded-full border border-red-300/70 px-5 py-2.5 text-sm font-semibold text-red-100 transition hover:bg-red-500/20">
                                        <x-heroicon-o-trash class="h-5 w-5" />
                                        Hapus Diagram
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endif
                @endauth
            </div>
            <div x-show="uploadOpen" x-cloak x-transition
                class="fixed inset-0 z-[9999] flex items-center justify-center bg-slate-950/60 p-4"
                @click.self="uploadOpen = false">
                <form method="POST" action="{{ route('sop.diagram.update') }}" enctype="multipart/form-data"
                    class="w-full max-w-md rounded-2xl bg-white p-5 text-left shadow-2xl sm:p-6">
                    @csrf
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-bold text-slate-900">Upload Diagram SOP</h3>
                            <p class="mt-1 text-xs text-slate-500">Pilih gambar JPG, PNG, atau WEBP maksimal 8 MB.</p>
                        </div>
                        <button type="button" @click="uploadOpen = false" class="text-2xl leading-none text-slate-400 hover:text-slate-700">&times;</button>
                    </div>
                    <label for="sop_diagram" class="mt-5 flex cursor-pointer items-center justify-center rounded-xl border-2 border-dashed border-slate-300 px-4 py-5 text-sm font-semibold text-slate-600 transition hover:border-primary hover:text-primary">
                        <x-heroicon-o-photo class="mr-2 h-5 w-5" />
                        Pilih file diagram
                    </label>
                    <input id="sop_diagram" name="sop_diagram" type="file" accept="image/jpeg,image/png,image/webp"
                        class="sr-only" required
                        @change="const file = $event.target.files[0]; if (file) { const reader = new FileReader(); reader.onload = event => preview = event.target.result; reader.readAsDataURL(file); }">
                    <div x-show="preview" x-cloak class="mt-4 rounded-xl border border-slate-200 bg-slate-50 p-3">
                        <p class="mb-2 text-xs font-semibold text-slate-500">Preview diagram</p>
                        <img :src="preview" alt="Preview diagram SOP" class="max-h-64 w-full rounded-lg object-contain">
                    </div>
                    <div class="mt-5 flex justify-end gap-2">
                        <button type="button" @click="uploadOpen = false"
                            class="rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50">
                            Batal
                        </button>
                        <button type="submit"
                            class="rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-secondary hover:opacity-90">
                            Simpan Diagram
                        </button>
                    </div>
                </form>
            </div>
            <div class="m-5 flex min-h-48 items-center justify-center rounded-2xl border border-dashed border-slate-300 bg-white/95 p-8 text-center sm:m-8">
                @if (!empty($villageSettings->sop_diagram_path))
                    <img src="{{ asset('storage/' . $villageSettings->sop_diagram_path) }}"
                        alt="Diagram Alur SOP Permintaan Data" class="max-h-[720px] w-full rounded-xl object-contain">
                @else
                    <div>
                        <x-heroicon-o-document-plus class="mx-auto h-10 w-10 text-slate-400" />
                        <p class="mt-3 text-sm font-semibold text-slate-600">Infografis SOP belum tersedia</p>
                        <p class="mt-1 text-xs text-slate-400">Diagram akan ditampilkan setelah dokumen resmi disiapkan.</p>
                    </div>
                @endif
            </div>
        </section>
    </div>
</x-layouts.client>
