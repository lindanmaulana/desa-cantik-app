<iframe name="statistics-download-frame" class="hidden" title="Unduhan laporan statistik"></iframe>

<div class="mb-4 flex flex-wrap justify-end gap-2 sm:mb-6">
    <a href="{{ route('dashboard.statistics.export.excel', array_filter([
        'module' => $module,
        'type' => $currentType->value,
        'rw' => request('rw'),
        'rt' => request('rt'),
    ])) }}" target="statistics-download-frame"
        class="inline-flex items-center gap-2 rounded-xl border border-emerald-200 bg-emerald-50 px-3 py-2 text-xs font-semibold text-emerald-700 transition hover:bg-emerald-100">
        <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M4 20h16V4H4v16z" />
        </svg>
        Download Excel
    </a>
    <a href="{{ route('dashboard.statistics.export.all-excel', [
        'rw' => request('rw'),
        'rt' => request('rt'),
    ]) }}" target="statistics-download-frame"
        class="inline-flex items-center gap-2 rounded-xl border border-sky-200 bg-sky-50 px-3 py-2 text-xs font-semibold text-sky-700 transition hover:bg-sky-100">
        <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h16v16H4V4zm4 0v16M4 9h16M4 14h16" />
        </svg>
        Download Semua Tabel
    </a>
    <a href="{{ route('dashboard.statistics.export.pdf', array_filter([
        'module' => $module,
        'type' => $currentType->value,
        'rw' => request('rw'),
        'rt' => request('rt'),
    ])) }}" target="statistics-download-frame"
        class="inline-flex items-center gap-2 rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-xs font-semibold text-red-700 transition hover:bg-red-100">
        <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M6 3h9l3 3v15H6V3zm9 0v4h4" />
        </svg>
        Download PDF
    </a>
    <a href="{{ route('dashboard.statistics.export.all-pdf', [
        'rw' => request('rw'),
        'rt' => request('rt'),
    ]) }}" target="statistics-download-frame"
        class="inline-flex items-center gap-2 rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-xs font-semibold text-red-700 transition hover:bg-red-100">
        <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 3h8l4 4v14H7V3zm8 0v5h4M4 7h4M4 12h4M4 17h4" />
        </svg>
        Download Semua PDF
    </a>
</div>
