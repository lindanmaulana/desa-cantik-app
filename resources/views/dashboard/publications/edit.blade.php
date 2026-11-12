<x-layouts.dashboard>
    <div class="mx-auto max-w-4xl space-y-6 p-6 max-md:p-3">
        <div>
            <a href="{{ route('dashboard.publications.index') }}" class="text-sm font-semibold text-primary">← Kembali ke Publikasi</a>
            <h1 class="mt-3 text-2xl font-bold text-textPrimary">Edit Dokumen</h1>
        </div>
        @if ($errors->any())<x-alert type="error" :message="$errors->first()" />@endif
        <form action="{{ route('dashboard.publications.update', $publication) }}" method="POST" enctype="multipart/form-data" class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
            @csrf @method('PUT')
            <div class="grid gap-4 md:grid-cols-2">
                <label class="text-sm font-semibold text-gray-700">Judul<input name="title" value="{{ old('title', $publication->title) }}" required class="mt-1.5 w-full rounded-xl border-gray-200 bg-gray-50 text-sm"></label>
                <label class="text-sm font-semibold text-gray-700">Nomor Dokumen<input name="document_number" value="{{ old('document_number', $publication->document_number) }}" class="mt-1.5 w-full rounded-xl border-gray-200 bg-gray-50 text-sm"></label>
                <label class="text-sm font-semibold text-gray-700">Submenu<select name="category" required class="mt-1.5 w-full rounded-xl border-gray-200 bg-gray-50 text-sm">@foreach ($categories as $key => $label)<option value="{{ $key }}" @selected($publication->category === $key)>{{ $label }}</option>@endforeach</select></label>
                <label class="text-sm font-semibold text-gray-700">Tahun<input type="number" name="year" value="{{ old('year', $publication->year) }}" required class="mt-1.5 w-full rounded-xl border-gray-200 bg-gray-50 text-sm"></label>
                <label class="text-sm font-semibold text-gray-700">Status<select name="status" required class="mt-1.5 w-full rounded-xl border-gray-200 bg-gray-50 text-sm">@foreach (['draft' => 'Draft', 'published' => 'Terbit', 'archived' => 'Arsip'] as $key => $label)<option value="{{ $key }}" @selected($publication->status === $key)>{{ $label }}</option>@endforeach</select></label>
                <label class="text-sm font-semibold text-gray-700">Ganti File Dokumen<input type="file" name="file" accept=".pdf,.jpg,.jpeg,.png,.webp" class="mt-1.5 block w-full rounded-xl border border-gray-200 bg-gray-50 p-2 text-sm"><span class="text-xs font-normal text-gray-400">Kosongkan jika tidak diganti.</span></label>
                <label class="text-sm font-semibold text-gray-700">Ganti Thumbnail<input type="file" name="thumbnail" accept=".jpg,.jpeg,.png,.webp" class="mt-1.5 block w-full rounded-xl border border-gray-200 bg-gray-50 p-2 text-sm"></label>
                <label class="text-sm font-semibold text-gray-700 md:col-span-2">Deskripsi<textarea name="description" rows="4" class="mt-1.5 w-full rounded-xl border-gray-200 bg-gray-50 text-sm">{{ old('description', $publication->description) }}</textarea></label>
            </div>
            <button class="mt-5 rounded-xl bg-primary px-5 py-2.5 text-sm font-bold text-white hover:opacity-90">Simpan Perubahan</button>
        </form>
    </div>
</x-layouts.dashboard>
