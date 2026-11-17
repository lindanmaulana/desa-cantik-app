<div class="mb-4 flex flex-wrap justify-end gap-2 sm:mb-6">
    <a href="{{ route('dashboard.statistics.export.excel', array_filter([
        'module' => $module,
        'type' => $currentType->value,
        'rw' => request('rw'),
        'rt' => request('rt'),
    ])) }}"
        class="inline-flex items-center gap-2 rounded-xl border border-emerald-200 bg-emerald-50 px-3 py-2 text-xs font-semibold text-emerald-700 transition hover:bg-emerald-100">
        <x-tabler-file-spreadsheet class="size-4" />
        Download Excel
    </a>
    <a href="{{ route('dashboard.statistics.export.all-excel', [
        'rw' => request('rw'),
        'rt' => request('rt'),
    ]) }}"
        class="inline-flex items-center gap-2 rounded-xl border border-sky-200 bg-sky-50 px-3 py-2 text-xs font-semibold text-sky-700 transition hover:bg-sky-100">
        <x-tabler-table-export class="size-4" />
        Download Semua Tabel
    </a>
    <a href="{{ route('dashboard.statistics.export.pdf', array_filter([
        'module' => $module,
        'type' => $currentType->value,
        'rw' => request('rw'),
        'rt' => request('rt'),
    ])) }}"
        class="inline-flex items-center gap-2 rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-xs font-semibold text-red-700 transition hover:bg-red-100">
        <x-tabler-file-type-pdf class="size-4" />
        Download PDF
    </a>
    <a href="{{ route('dashboard.statistics.export.all-pdf', [
        'rw' => request('rw'),
        'rt' => request('rt'),
    ]) }}"
        class="inline-flex items-center gap-2 rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-xs font-semibold text-red-700 transition hover:bg-red-100">
        <x-tabler-files class="size-4" />
        Download Semua PDF
    </a>
</div>
