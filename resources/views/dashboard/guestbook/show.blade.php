<x-layouts.dashboard>
    <div class="space-y-6 p-6 max-md:p-3">
        <div class="flex items-center justify-between gap-4">
            <div>
                <a href="{{ route('dashboard.guestbook') }}" class="text-sm font-medium text-primary hover:underline">← Kembali ke Buku Tamu</a>
                <h1 class="mt-2 text-2xl font-bold text-textPrimary max-md:text-lg">Detail Kunjungan</h1>
            </div>
            <span class="rounded-full border px-3 py-1.5 text-xs font-semibold {{ match($guestbookEntry->status) {
                'pending' => 'border-amber-100 bg-amber-50 text-amber-600',
                'approved' => 'border-emerald-100 bg-emerald-50 text-emerald-600',
                'rejected' => 'border-red-100 bg-red-50 text-red-600',
                default => 'border-sky-100 bg-sky-50 text-sky-600',
            } }}">{{ ['pending' => 'Menunggu', 'approved' => 'Diterima', 'rejected' => 'Ditolak', 'completed' => 'Selesai'][$guestbookEntry->status] }}</span>
        </div>

        <div class="grid gap-6 lg:grid-cols-[1fr_320px]">
            <div class="space-y-6 rounded-2xl border border-gray-100 bg-white p-5 shadow-sm sm:p-7">
                <section>
                    <h2 class="mb-4 text-xs font-bold uppercase tracking-[0.18em] text-textSecondary">Waktu Kunjungan</h2>
                    <p class="text-lg font-semibold text-gray-900">{{ $guestbookEntry->visit_date->translatedFormat('l, d F Y') }}</p>
                </section>
                <section>
                    <h2 class="mb-4 text-xs font-bold uppercase tracking-[0.18em] text-textSecondary">Identitas Tamu</h2>
                    <dl class="grid gap-4 sm:grid-cols-2">
                        @foreach ([
                            'Nama Lengkap' => $guestbookEntry->full_name,
                            'Alamat' => $guestbookEntry->address ?: '-',
                            'Pekerjaan' => $guestbookEntry->occupation ?: '-',
                            'Instansi / Lembaga' => $guestbookEntry->institution ?: '-',
                            'Nomor Telepon' => $guestbookEntry->phone ?: '-',
                            'Email' => $guestbookEntry->email ?: '-',
                        ] as $label => $value)
                            <div>
                                <dt class="text-xs text-gray-400">{{ $label }}</dt>
                                <dd class="mt-1 text-sm font-medium text-gray-800">{{ $value }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </section>
                <section>
                    <h2 class="mb-2 text-xs font-bold uppercase tracking-[0.18em] text-textSecondary">Keperluan</h2>
                    <p class="font-medium text-gray-900">{{ $guestbookEntry->purpose }}</p>
                    <p class="mt-3 whitespace-pre-line text-sm text-gray-600">{{ $guestbookEntry->message ?: 'Tidak ada keterangan tambahan.' }}</p>
                </section>
            </div>

            <aside class="space-y-5">
                <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
                    <h2 class="mb-4 text-xs font-bold uppercase tracking-[0.18em] text-textSecondary">Tanda Tangan</h2>
                    <div class="rounded-xl border border-gray-200 bg-gray-50 p-2">
                        <img src="{{ $guestbookEntry->signature }}" alt="Tanda tangan {{ $guestbookEntry->full_name }}" class="w-full">
                    </div>
                </div>
                <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
                    <h2 class="mb-3 text-xs font-bold uppercase tracking-[0.18em] text-textSecondary">Ubah Status</h2>
                    <form method="POST" action="{{ route('dashboard.guestbook.status', $guestbookEntry) }}">
                        @csrf @method('PUT')
                        <select name="status" class="mb-3 w-full rounded-xl border border-gray-200 bg-gray-50 px-3 py-2.5 text-sm">
                            @foreach (['pending' => 'Menunggu', 'approved' => 'Diterima', 'rejected' => 'Ditolak', 'completed' => 'Selesai'] as $value => $label)
                                <option value="{{ $value }}" @selected($guestbookEntry->status === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                        <button class="w-full rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white transition hover:opacity-90">Simpan Status</button>
                    </form>
                </div>
            </aside>
        </div>
    </div>
</x-layouts.dashboard>
