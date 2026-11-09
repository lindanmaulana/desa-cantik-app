<x-layouts.dashboard>
    <div class="space-y-6 p-6 max-md:p-3">
        <div class="flex flex-col items-start justify-between gap-4 md:flex-row md:items-center">
            <div>
                <h1 class="flex items-center gap-2 text-2xl font-bold text-textPrimary max-md:text-lg">
                    <x-heroicon-o-book-open class="size-6 text-primary" />
                    Buku Tamu Desa
                </h1>
                <p class="mt-1 text-sm text-gray-500">Kelola dan verifikasi data kunjungan yang dikirim dari halaman publik.</p>
            </div>
        </div>

        @if (session('success')) <x-alert type="success" :message="session('success')" /> @endif
        @if (session('error')) <x-alert type="error" :message="session('error')" /> @endif

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ([['Total Kunjungan', $stats->total, 'text-primary'], ['Menunggu', $stats->pending, 'text-amber-500'], ['Diterima', $stats->approved, 'text-emerald-500'], ['Selesai', $stats->completed, 'text-sky-500']] as [$label, $value, $color])
                <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">{{ $label }}</p>
                    <p class="mt-2 text-3xl font-bold {{ $color }}">{{ $value }}</p>
                </div>
            @endforeach
        </div>

        <form method="GET" class="flex flex-col gap-3 rounded-2xl border border-gray-100 bg-white p-4 shadow-sm md:flex-row">
            <input type="search" name="search" value="{{ request('search') }}" placeholder="Cari nama, instansi, atau tujuan..."
                class="flex-1 rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/10">
            <select name="status" class="rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm outline-none focus:border-primary">
                <option value="">Semua Status</option>
                @foreach (['pending' => 'Menunggu', 'approved' => 'Diterima', 'rejected' => 'Ditolak', 'completed' => 'Selesai'] as $value => $label)
                    <option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>
                @endforeach
            </select>
            <input type="date" name="visit_date" value="{{ request('visit_date') }}" class="rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm outline-none focus:border-primary">
            <button class="rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white transition hover:opacity-90">Filter</button>
        </form>

        <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[900px] text-left">
                    <thead class="border-b border-gray-100 bg-gray-50 text-xs uppercase tracking-wider text-gray-500">
                        <tr>
                            <th class="px-5 py-4">Tanggal</th>
                            <th class="px-5 py-4">Tamu</th>
                            <th class="px-5 py-4">Instansi / Kontak</th>
                            <th class="px-5 py-4">Tujuan</th>
                            <th class="px-5 py-4">Status</th>
                            <th class="px-5 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                        @forelse ($entries as $entry)
                            @php
                                $statusLabels = ['pending' => 'Menunggu', 'approved' => 'Diterima', 'rejected' => 'Ditolak', 'completed' => 'Selesai'];
                                $statusClasses = ['pending' => 'bg-amber-50 text-amber-600 border-amber-100', 'approved' => 'bg-emerald-50 text-emerald-600 border-emerald-100', 'rejected' => 'bg-red-50 text-red-600 border-red-100', 'completed' => 'bg-sky-50 text-sky-600 border-sky-100'];
                            @endphp
                            <tr class="transition hover:bg-gray-50/70">
                                <td class="whitespace-nowrap px-5 py-4">{{ $entry->visit_date->format('d/m/Y') }}</td>
                                <td class="px-5 py-4">
                                    <div class="font-semibold text-gray-900">{{ $entry->full_name }}</div>
                                    <div class="text-xs text-gray-400">{{ $entry->occupation ?: 'Pekerjaan tidak diisi' }}</div>
                                </td>
                                <td class="px-5 py-4">
                                    <div>{{ $entry->institution ?: '-' }}</div>
                                    <div class="text-xs text-gray-400">{{ $entry->phone ?: ($entry->email ?: 'Kontak tidak diisi') }}</div>
                                </td>
                                <td class="max-w-xs px-5 py-4">{{ $entry->purpose }}</td>
                                <td class="px-5 py-4">
                                    <span class="inline-flex rounded-full border px-2.5 py-1 text-xs font-semibold {{ $statusClasses[$entry->status] }}">{{ $statusLabels[$entry->status] }}</span>
                                </td>
                                <td class="px-5 py-4">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('dashboard.guestbook.show', $entry) }}" class="rounded-lg border border-gray-200 px-2.5 py-1.5 text-xs font-semibold text-gray-600 transition hover:bg-gray-50">Detail</a>
                                        <form method="POST" action="{{ route('dashboard.guestbook.status', $entry) }}">
                                            @csrf @method('PUT')
                                            <select name="status" onchange="this.form.submit()" class="rounded-lg border border-gray-200 bg-white px-2 py-1.5 text-xs">
                                                @foreach ($statusLabels as $value => $label)
                                                    <option value="{{ $value }}" @selected($entry->status === $value)>{{ $label }}</option>
                                                @endforeach
                                            </select>
                                        </form>
                                        <form method="POST" action="{{ route('dashboard.guestbook.destroy', $entry) }}" onsubmit="return confirm('Hapus data buku tamu ini?')">
                                            @csrf @method('DELETE')
                                            <button class="rounded-lg border border-red-100 px-2.5 py-1.5 text-xs font-semibold text-red-500 transition hover:bg-red-50">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="px-5 py-12 text-center text-sm text-gray-400">Belum ada data buku tamu.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($entries->hasPages())
                <div class="border-t border-gray-100 p-4">{{ $entries->links() }}</div>
            @endif
        </div>
    </div>
</x-layouts.dashboard>
