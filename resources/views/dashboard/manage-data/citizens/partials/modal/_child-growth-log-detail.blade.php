<div x-show="childGrowthLog.detail.openView"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto transition-opacity duration-300 bg-textPrimary/50 backdrop-blur-sm"
    style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

    <div class="w-full max-w-2xl overflow-hidden transition-all duration-300 transform scale-95 bg-secondary border border-textTertiary/20 shadow-xl rounded-2xl"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="scale-95 opacity-0"
        x-transition:enter-end="scale-100 opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="scale-100 opacity-100" x-transition:leave-end="scale-95 opacity-0">

        <!-- Header Modal -->
        <div class="flex items-center justify-between px-6 py-4 border-b border-textTertiary/10 bg-tertiary">
            <div class="flex items-center gap-2">
                <div class="p-2 text-primary rounded-lg bg-primary/10">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-textPrimary">Detail Log Perkembangan Balita</h3>
                </div>
            </div>
            <button @click="childGrowthLog.detail.openView = false"
                class="p-1 text-textSecondary transition-colors rounded-lg hover:text-textPrimary hover:bg-textTertiary/20">
                <x-heroicon-o-x-mark class="w-5 h-5" />
            </button>
        </div>

        <!-- Konten Detail -->
        <div class="p-6 space-y-5 max-h-[70vh] overflow-y-auto text-left">

            <!-- Tanggal Pengukuran -->
            <div class="p-3.5 bg-tertiary border border-textTertiary/10 rounded-xl flex justify-between items-center">
                <span class="text-xs font-bold tracking-wider text-textSecondary uppercase">Tanggal Pengukuran</span>
                <span class="text-sm font-bold text-textPrimary"
                    x-text="childGrowthLog.detail.data.measured_at ? new Date(childGrowthLog.detail.data.measured_at).toLocaleDateString('id-ID', {day: '2-digit', month: 'short', year: 'numeric'}) : '-'">04
                    Jun 2026</span>
            </div>

            <!-- Grid Berat & Tinggi Badan -->
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <!-- Berat Badan -->
                <div
                    class="flex items-center justify-between p-4 bg-secondary border border-textTertiary/20 shadow-sm rounded-xl">
                    <div class="space-y-0.5">
                        <span class="text-xs font-bold tracking-wider text-textSecondary uppercase">Berat Badan
                            (BB)</span>
                        <div class="flex items-baseline gap-1">
                            <span class="text-2xl font-black text-textPrimary"
                                x-text="childGrowthLog.detail.data.weight || '0.00'">10.00</span>
                            <span class="text-xs font-bold text-textTertiary">Kg</span>
                        </div>
                    </div>
                    <div class="p-2.5 bg-primary/10 text-primary rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.003 5.003 0 01-6 0m6 0l3-9m0 0l6-2" />
                        </svg>
                    </div>
                </div>

                <!-- Tinggi Badan -->
                <div
                    class="flex items-center justify-between p-4 bg-secondary border border-textTertiary/20 shadow-sm rounded-xl">
                    <div class="space-y-0.5">
                        <span class="text-xs font-bold tracking-wider text-textSecondary uppercase">Tinggi / Panjang
                            (TB)</span>
                        <div class="flex items-baseline gap-1">
                            <span class="text-2xl font-black text-textPrimary"
                                x-text="childGrowthLog.detail.data.height || '0.00'">70.00</span>
                            <span class="text-xs font-bold text-textTertiary">Cm</span>
                        </div>
                    </div>
                    <div class="p-2.5 bg-primary/10 text-primary rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Metode Pengukuran -->
            <div>
                <span class="block mb-1.5 text-xs font-semibold tracking-wider text-textSecondary uppercase">Metode
                    Pengukuran</span>
                <div
                    class="flex items-center gap-2 p-3 text-sm font-medium text-textPrimary border border-textTertiary/10 bg-tertiary rounded-xl">
                    <template x-if="childGrowthLog.detail.data.measurement_method === 'recumber'">
                        <span>🛌 Telentang (Recumber)</span>
                    </template>
                    <template x-if="childGrowthLog.detail.data.measurement_method === 'standing'">
                        <span>🧍 Berdiri (Standing)</span>
                    </template>
                    <template x-if="!childGrowthLog.detail.data.measurement_method">
                        <span class="text-textTertiary">-</span>
                    </template>
                </div>
            </div>

            <!-- Grid Vitamin A & Hasil WHO -->
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <!-- Vitamin A Status -->
                <div>
                    <span
                        class="block mb-1.5 text-xs font-semibold tracking-wider text-textSecondary uppercase">Pemberian
                        Vitamin A</span>
                    <div class="h-[46px] flex items-center">
                        <template x-if="childGrowthLog.detail.data.vit_a_received == 1">
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-emerald-50 text-emerald-700 text-xs font-bold border border-emerald-100">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Menerima Vitamin A
                            </span>
                        </template>
                        <template x-if="childGrowthLog.detail.data.vit_a_received == 0">
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-rose-50 text-rose-600 text-xs font-bold border border-rose-100">
                                <span class="w-2 h-2 rounded-full bg-rose-400"></span> Tidak Menerima
                            </span>
                        </template>
                    </div>
                </div>

                <!-- Hasil WHO Status -->
                <div>
                    <span class="block mb-1.5 text-xs font-semibold tracking-wider text-textSecondary uppercase">Hasil
                        Status Stunting (WHO)</span>
                    <div class="h-[46px] flex items-center">
                        <!-- Kondisi Normal -->
                        <template x-if="childGrowthLog.detail.data.stunting_status === 'normal'">
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-emerald-50 text-emerald-700 text-xs font-bold border border-emerald-100">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Normal
                            </span>
                        </template>
                        <!-- Kondisi Stunted -->
                        <template x-if="childGrowthLog.detail.data.stunting_status === 'stunted'">
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-amber-50 text-amber-700 text-xs font-bold border border-amber-100">
                                <span class="w-2 h-2 rounded-full bg-amber-500"></span> Pendek / Stunting
                            </span>
                        </template>
                        <!-- Kondisi Severely Stunted -->
                        <template x-if="childGrowthLog.detail.data.stunting_status === 'severely_stunted'">
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-rose-50 text-rose-700 text-xs font-bold border border-rose-100">
                                <span class="w-2 h-2 rounded-full bg-rose-500"></span> Sangat Pendek / Stunting
                            </span>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Catatan Tambahan -->
            <div>
                <span class="block mb-1.5 text-xs font-semibold tracking-wider text-textSecondary uppercase">Catatan
                    Tambahan</span>
                <div class="p-4 bg-tertiary rounded-xl border border-textTertiary/20 text-sm text-textPrimary leading-relaxed font-medium min-h-[80px]"
                    x-text="childGrowthLog.detail.data.notes || 'Tidak ada catatan tambahan...'">
                </div>
            </div>
        </div>

        <!-- Footer Modal Actions -->
        <div class="flex items-center justify-end px-6 py-4 border-t border-textTertiary/10 bg-tertiary">
            <button type="button" @click="childGrowthLog.detail.openView = false"
                class="px-5 py-2 text-sm font-medium text-textPrimary transition-colors bg-secondary border border-textTertiary/40 rounded-lg hover:bg-tertiary focus:outline-none">
                Tutup Detail
            </button>
        </div>
    </div>
</div>
