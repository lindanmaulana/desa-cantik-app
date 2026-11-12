<x-layouts.dashboard>
    <div class="space-y-6 p-6 max-md:p-3">
        <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">
            <div>
                <h1 class="text-2xl font-bold text-textPrimary max-md:text-lg">Publikasi & Dokumen</h1>
                <p class="mt-1 text-sm text-gray-500">Kelola dokumen yang ditampilkan pada katalog publik Desa.</p>
            </div>
            <a href="{{ route('publications.index') }}" target="_blank" class="rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">Lihat Katalog Publik</a>
        </div>

        @if (session('success'))<x-alert type="success" :message="session('success')" />@endif
        @if (session('error'))<x-alert type="error" :message="session('error')" />@endif
        @if ($errors->any())<x-alert type="error" :message="$errors->first()" />@endif

        <form action="{{ route('dashboard.publications.store') }}" method="POST" enctype="multipart/form-data" class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
            @csrf
            <h2 class="text-lg font-bold text-textPrimary">Tambah Dokumen</h2>
            <div class="mt-5 grid gap-4 md:grid-cols-2">
                <label class="text-sm font-semibold text-gray-700">Judul
                    <input name="title" value="{{ old('title') }}" required class="mt-1.5 w-full rounded-xl border-gray-200 bg-gray-50 text-sm">
                </label>
                <label class="text-sm font-semibold text-gray-700">Nomor Dokumen
                    <input name="document_number" value="{{ old('document_number') }}" class="mt-1.5 w-full rounded-xl border-gray-200 bg-gray-50 text-sm">
                </label>
                <label class="text-sm font-semibold text-gray-700">Submenu
                    <select name="category" required class="mt-1.5 w-full rounded-xl border-gray-200 bg-gray-50 text-sm">
                        @foreach ($categories as $key => $label)<option value="{{ $key }}" @selected(old('category') === $key)>{{ $label }}</option>@endforeach
                    </select>
                </label>
                <label class="text-sm font-semibold text-gray-700">Tahun
                    <input type="number" name="year" value="{{ old('year', date('Y')) }}" min="1900" max="{{ date('Y') + 1 }}" required class="mt-1.5 w-full rounded-xl border-gray-200 bg-gray-50 text-sm">
                </label>
                <label class="text-sm font-semibold text-gray-700">Status
                    <select name="status" required class="mt-1.5 w-full rounded-xl border-gray-200 bg-gray-50 text-sm">
                        <option value="draft">Draft</option><option value="published">Terbit</option><option value="archived">Arsip</option>
                    </select>
                </label>
                <label class="text-sm font-semibold text-gray-700">File Dokumen
                    <input type="file" name="file" required accept=".pdf,.jpg,.jpeg,.png,.webp" class="mt-1.5 block w-full rounded-xl border border-gray-200 bg-gray-50 p-2 text-sm">
                    <span class="text-xs font-normal text-gray-400">PDF atau gambar, maksimal 20 MB.</span>
                </label>
                <label class="text-sm font-semibold text-gray-700">Thumbnail
                    <input type="file" name="thumbnail" accept=".jpg,.jpeg,.png,.webp" class="mt-1.5 block w-full rounded-xl border border-gray-200 bg-gray-50 p-2 text-sm">
                    <span class="text-xs font-normal text-gray-400">Opsional, maksimal 4 MB.</span>
                </label>
                <label class="text-sm font-semibold text-gray-700 md:col-span-2">Deskripsi
                    <textarea name="description" rows="3" class="mt-1.5 w-full rounded-xl border-gray-200 bg-gray-50 text-sm">{{ old('description') }}</textarea>
                </label>
            </div>
            <button class="mt-5 rounded-xl bg-primary px-5 py-2.5 text-sm font-bold text-white hover:opacity-90">Simpan Dokumen</button>
        </form>

        <form method="GET" class="flex flex-col gap-3 rounded-2xl border border-gray-100 bg-white p-4 shadow-sm md:flex-row">
            <input name="search" value="{{ request('search') }}" placeholder="Cari judul dokumen..." class="flex-1 rounded-xl border-gray-200 bg-gray-50 text-sm">
            <select name="category" class="rounded-xl border-gray-200 bg-gray-50 text-sm"><option value="">Semua Submenu</option>@foreach ($categories as $key => $label)<option value="{{ $key }}" @selected(request('category') === $key)>{{ $label }}</option>@endforeach</select>
            <select name="status" class="rounded-xl border-gray-200 bg-gray-50 text-sm"><option value="">Semua Status</option><option value="draft">Draft</option><option value="published">Terbit</option><option value="archived">Arsip</option></select>
            <button class="rounded-xl bg-primary px-5 py-2 text-sm font-bold text-white">Filter</button>
        </form>

        <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[900px] text-left text-sm">
                    <thead class="border-b border-gray-100 bg-gray-50 text-xs uppercase text-gray-500"><tr><th class="px-5 py-4">Dokumen</th><th class="px-5 py-4">Submenu</th><th class="px-5 py-4">Status</th><th class="px-5 py-4">Download</th><th class="px-5 py-4 text-right">Aksi</th></tr></thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($publications as $publication)
                            <tr><td class="px-5 py-4"><div class="font-semibold text-gray-900">{{ $publication->title }}</div><div class="text-xs text-gray-400">{{ $publication->file_original_name }} · {{ number_format($publication->file_size / 1048576, 2) }} MB</div></td><td class="px-5 py-4">{{ $categories[$publication->category] }}</td><td class="px-5 py-4"><span class="rounded-full bg-gray-100 px-2.5 py-1 text-xs font-semibold">{{ ucfirst($publication->status) }}</span></td><td class="px-5 py-4">{{ $publication->download_count }}</td><td class="px-5 py-4 text-right"><a href="{{ route('dashboard.publications.edit', $publication) }}" class="mr-2 text-xs font-semibold text-primary">Edit</a><a href="{{ route('publications.preview', $publication) }}" target="_blank" class="mr-2 text-xs font-semibold text-primary">Preview</a><form class="inline" method="POST" action="{{ route('dashboard.publications.destroy', $publication) }}" onsubmit="return confirm('Hapus dokumen ini?')">@csrf @method('DELETE')<button class="text-xs font-semibold text-red-500">Hapus</button></form></td></tr>
                        @empty
                            <tr><td colspan="5" class="px-5 py-12 text-center text-gray-400">Belum ada dokumen.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($publications->hasPages())<div class="border-t border-gray-100 p-4">{{ $publications->links() }}</div>@endif
        </div>
    </div>
</x-layouts.dashboard>
