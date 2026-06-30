<div class="flex flex-col gap-4 pb-6 border-b border-gray-200 sm:flex-row sm:items-center sm:justify-between"
    x-data="{ isSyncing: false }">
    <div>
        <h1 class="text-2xl font-bold tracking-tight text-gray-950">Pengaturan Sistem</h1>
        <p class="mt-1 text-sm text-gray-500">Konfigurasi identitas wilayah, media branding, akses koordinat GIS, dan
            integrasi sosial media.</p>
    </div>
    <div class="flex items-center gap-3">
        <button type="button" :disabled="isSyncing" @click="isSyncing = true; window.location.reload()"
            class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-3.5 py-2 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 transition disabled:opacity-60 disabled:cursor-not-allowed">

            <svg x-show="isSyncing" class="animate-spin w-4 h-4 text-gray-500" viewBox="0 0 24 24" fill="none"
                style="display: none;">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
            </svg>

            <span x-text="isSyncing ? 'Syncing...' : 'Sync Data'">Sync Data</span>
        </button>
    </div>
</div>
