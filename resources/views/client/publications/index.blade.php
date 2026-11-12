<x-layouts.app>
    <div class="min-h-screen bg-tertiary">
        <x-layouts.partials.navbar />

        @php
            $content = [
                'profil-desa' => ['title' => 'Profil Desa', 'subtitle' => 'Dokumen profil resmi desa yang memuat gambaran umum potensi dan kondisi desa.', 'eyebrow' => 'PROFIL RESMI WILAYAH', 'tag' => 'Potensi & Gambaran Desa', 'hero' => 'Profil Desa & Potensi Wilayah', 'description' => 'Dokumen profil resmi desa yang memuat gambaran umum wilayah, sejarah, peta lokasi, batas administratif, struktur pemerintahan, dan potensi keunggulan desa.', 'button' => 'Eksplorasi Profil', 'icon' => 'building'],
                'monografi-desa' => ['title' => 'Monografi Desa', 'subtitle' => 'Monografi desa yang memuat data statistik dan kependudukan secara komprehensif.', 'eyebrow' => 'DOKUMEN RESMI TERPUBLIKASI', 'tag' => 'Data Kependudukan Desa', 'hero' => 'Monografi Desa', 'description' => 'Kumpulan dokumen monografi desa yang merangkum identitas wilayah, demografi, pendidikan, pekerjaan, ekonomi, dan prasarana desa.', 'button' => 'Lihat Monografi', 'icon' => 'document'],
                'infografis' => ['title' => 'Infografis', 'subtitle' => 'Bentuk visualisasi data statistik desa yang disajikan dengan ilustrasi, grafik, dan teks.', 'eyebrow' => 'VISUALISASI DATA', 'tag' => 'Galeri Infografis Publik', 'hero' => 'Galeri Infografis Statistik Desa', 'description' => 'Bentuk visualisasi data statistik desa yang disajikan dengan ilustrasi visual, peta spasial, diagram interaktif, dan gambar poster informatif.', 'button' => 'Lihat Galeri', 'icon' => 'chart'],
                'publikasi' => ['title' => 'Publikasi', 'subtitle' => 'Kumpulan publikasi statistik dan kajian yang diterbitkan oleh Desa.', 'eyebrow' => 'RILIS STATISTIK DESA', 'tag' => 'Laporan & Buku Saku', 'hero' => 'Kumpulan Publikasi & Laporan Resmi', 'description' => 'Kumpulan publikasi statistik, rilis ilmiah berkala, majalah desa, buku saku indikator, dan laporan hasil kajian pembangunan desa.', 'button' => 'Unduh Publikasi', 'icon' => 'book'],
                'metadata-statistik' => ['title' => 'Metadata Statistik', 'subtitle' => 'Dokumentasi metadata kegiatan statistik, variabel, dan indikator yang digunakan dalam pengumpulan data desa.', 'eyebrow' => 'STANDAR METADATA', 'tag' => 'MSK / MSV / MSI', 'hero' => 'Dokumentasi Metadata Statistik Desa', 'description' => 'Dokumentasi baku metadata kegiatan statistik, variabel pendataan, dan indikator pembangunan sesuai standar data desa.', 'button' => 'Telusuri Metadata', 'icon' => 'database'],
            ];
            $active = $content[$category ?? 'profil-desa'];
        @endphp

        <main class="mx-auto max-w-7xl px-4 pb-14 pt-2 sm:px-6 lg:px-8">
            <section class="mb-8 flex items-start gap-5">
                <div class="flex size-20 shrink-0 items-center justify-center rounded-3xl bg-blue-100 text-primary">
                    <svg class="size-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="1.8" d="M4 20V5a1 1 0 011-1h14a1 1 0 011 1v15M8 8h2m-2 4h2m4-4h2m-2 4h2M8 20v-3h8v3" /></svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold tracking-tight text-slate-950">{{ $active['title'] }}</h1>
                    <p class="mt-1 text-lg text-slate-600">{{ $active['subtitle'] }}</p>
                </div>
            </section>

            <section id="documents" class="scroll-mt-8 rounded-[2rem] bg-gradient-to-r from-[#075985] via-[#087f72] to-[#10b981] p-8 text-white shadow-lg sm:p-10">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                    <div class="max-w-3xl">
                        <div class="flex flex-wrap gap-2 text-xs font-bold tracking-wide">
                            <span class="rounded-full bg-white px-4 py-2 text-slate-900">{{ $active['eyebrow'] }}</span>
                            <span class="rounded-full bg-white/70 px-4 py-2 text-slate-800">{{ $active['tag'] }}</span>
                        </div>
                        <h2 class="mt-5 text-3xl font-bold">{{ $active['hero'] }}</h2>
                        <p class="mt-2 text-base leading-7 text-white/75">{{ $active['description'] }}</p>
                    </div>
                    <a href="#document-list" class="inline-flex shrink-0 items-center justify-center rounded-full bg-white px-6 py-3 text-sm font-bold text-slate-900 shadow-sm transition hover:bg-slate-50">{{ $active['button'] }}</a>
                </div>
            </section>

            <form method="GET" action="{{ route('publications.index', ['category' => $category]) }}" class="mt-8 grid gap-4 rounded-3xl bg-white p-6 shadow-sm md:grid-cols-[1fr_260px_140px] md:items-end">
                <label class="block text-sm font-semibold text-slate-700">Kata Kunci
                    <input type="search" name="search" value="{{ request('search') }}" placeholder="Cari judul atau sinopsis..." class="mt-2 w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-primary">
                </label>
                <label class="block text-sm font-semibold text-slate-700">Tahun
                    <select name="year" class="mt-2 w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-primary">
                        <option value="">Semua Tahun</option>
                        @foreach ($years as $year)<option value="{{ $year }}" @selected((string) request('year') === (string) $year)>{{ $year }}</option>@endforeach
                    </select>
                </label>
                <button class="rounded-xl bg-primary px-4 py-3 text-sm font-bold text-white transition hover:opacity-90">Filter</button>
            </form>

            <div id="document-list" class="mt-8 scroll-mt-8 flex items-center justify-between">
                <p class="text-lg text-slate-600">Menampilkan {{ $publications->total() }} dokumen</p>
            </div>
            <div class="mt-4 space-y-4">
                @forelse ($publications as $publication)
                    <article class="flex min-h-[280px] flex-col overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-slate-100 sm:flex-row">
                        <div class="aspect-square flex w-full shrink-0 items-center justify-center overflow-hidden bg-slate-100 sm:aspect-auto sm:min-h-0 sm:w-52 sm:self-stretch">
                            @if ($publication->thumbnail_path)
                                <img src="{{ asset('storage/' . $publication->thumbnail_path) }}" alt="" class="block h-full w-full object-cover">
                            @else
                                <svg class="size-14 text-primary/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="1.5" d="M7 3h7l4 4v14H7a2 2 0 01-2-2V5a2 2 0 012-2zM14 3v5h5" /></svg>
                            @endif
                        </div>
                        <div class="flex flex-1 flex-col justify-between p-6">
                            <div>
                                <div class="flex flex-wrap items-center gap-2 text-xs text-slate-500">
                                    <span>{{ $publication->published_at?->format('d/m/Y H:i') }}</span>
                                    @if ($publication->document_number)<span class="rounded-md bg-slate-100 px-2 py-1 font-semibold">{{ $publication->document_number }}</span>@endif
                                </div>
                                <h3 class="mt-2 text-xl font-bold text-primary">{{ $publication->title }}</h3>
                                <p class="mt-2 line-clamp-2 text-sm leading-6 text-slate-600">{{ $publication->description ?: 'Dokumen resmi Desa yang tersedia untuk dibaca dan diunduh oleh masyarakat.' }}</p>
                            </div>
                            <div class="mt-5 flex flex-wrap gap-2">
                                <a href="{{ route('publications.preview', $publication) }}" target="_blank" class="rounded-lg border border-slate-200 px-4 py-2 text-xs font-bold text-slate-700 hover:bg-slate-50">Baca / Preview</a>
                                <a href="{{ route('publications.download', $publication) }}" class="rounded-lg bg-primary px-4 py-2 text-xs font-bold text-white hover:opacity-90">Download</a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="rounded-3xl bg-white px-6 py-16 text-center shadow-sm"><p class="text-lg font-semibold text-slate-700">Belum ada dokumen pada kategori ini.</p><p class="mt-1 text-sm text-slate-500">Dokumen yang sudah diterbitkan admin akan tampil di sini.</p></div>
                @endforelse
            </div>
            @if ($publications->hasPages())<div class="mt-6">{{ $publications->links() }}</div>@endif
        </main>
        <x-layouts.partials.footer />
    </div>
</x-layouts.app>
