<div x-show="childGrowthLog.openCreate"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto transition-opacity duration-300 bg-textPrimary/50 backdrop-blur-sm"
    style="display: none;">

    <div
        class="w-full max-w-3xl overflow-hidden transition-all duration-300 transform scale-95 bg-secondary border border-textTertiary/20 shadow-xl rounded-2xl">

        <!-- Header Modal -->
        <div class="flex items-center justify-between px-6 py-4 border-b border-textTertiary/10 bg-tertiary">
            <div class="flex items-center gap-2">
                <div class="p-2 text-primary rounded-lg bg-primary/10">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-textPrimary">Input Log Perkembangan Balita (Posyandu)</h3>
                </div>
            </div>
            <button @click="childGrowthLog.openCreate = false"
                class="p-1 text-textSecondary transition-colors rounded-lg hover:text-textPrimary hover:bg-textTertiary/20">
                <x-heroicon-o-x-mark class="w-5 h-5" />
            </button>
        </div>

        <!-- Form Input Data -->
        <form action="{{ route('child-growth-logs.store', $citizen) }}" method="POST"
            class="p-6 space-y-4 max-h-[70vh] overflow-y-auto text-left">
            @csrf
            @method('POST')

            <!-- Tanggal Pengukuran -->
            <div>
                <label class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">
                    Tanggal Pengukuran <span class="text-red-500">*</span>
                </label>
                <input type="date" name="measured_at" required x-model="childGrowthLog.data.measured_at"
                    class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
            </div>

            <!-- Baris Berat Badan & Tinggi Badan -->
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">
                        Berat Badan (BB) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative flex items-center">
                        <input type="number" step="0.01" name="weight" required placeholder="Contoh: 9.20"
                            x-model="childGrowthLog.data.weight"
                            class="w-full py-2 pl-3 pr-12 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary placeholder:text-textTertiary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        <span class="absolute text-xs font-bold text-textTertiary right-3">Kg</span>
                    </div>
                </div>

                <div>
                    <label class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">
                        Tinggi / Panjang Badan (TB) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative flex items-center">
                        <input type="number" step="0.01" name="height" required placeholder="Contoh: 76.50"
                            x-model="childGrowthLog.data.height"
                            class="w-full py-2 pl-3 pr-12 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary placeholder:text-textTertiary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        <span class="absolute text-xs font-bold text-textTertiary right-3">Cm</span>
                    </div>
                </div>
            </div>

            <!-- Metode Pengukuran -->
            <div>
                <label class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">
                    Metode Pengukuran <span class="text-red-500">*</span>
                </label>
                <div class="grid grid-cols-2 gap-3 mt-1">
                    <label
                        class="flex items-center gap-2 p-3 border border-textTertiary/30 rounded-lg cursor-pointer bg-tertiary hover:bg-textTertiary/10 transition-colors">
                        <input type="radio" name="measurement_method" value="recumber"
                            x-model="childGrowthLog.data.measurement_method"
                            class="w-4 h-4 text-primary focus:ring-primary accent-primary">
                        <span class="text-sm font-medium text-textPrimary">🛌 Telentang (Recumber)</span>
                    </label>
                    <label
                        class="flex items-center gap-2 p-3 border border-textTertiary/30 rounded-lg cursor-pointer bg-tertiary hover:bg-textTertiary/10 transition-colors">
                        <input type="radio" name="measurement_method" value="standing"
                            x-model="childGrowthLog.data.measurement_method"
                            class="w-4 h-4 text-primary focus:ring-primary accent-primary">
                        <span class="text-sm font-medium text-textPrimary">🧍 Berdiri (Standing)</span>
                    </label>
                </div>
            </div>

            <!-- Kotak Informasi Vitamin A -->
            <div class="flex items-center justify-between p-4 border bg-primary/5 border-primary/20 rounded-xl">
                <div class="space-y-0.5">
                    <label class="text-sm font-bold text-primary">Pemberian Vitamin A</label>
                    <span class="block text-xs text-textSecondary">Beri centang jika balita mendapatkan kapsul vitamin A
                        bulan ini</span>
                </div>
                <input type="hidden" name="vit_a_received" value="0">
                <input type="checkbox" name="vit_a_received" value="1" x-model="childGrowthLog.data.vit_a_received"
                    class="w-5 h-5 border-textTertiary/40 rounded cursor-pointer focus:ring-primary accent-primary">
            </div>

            <!-- Hasil Status Stunting -->
            <div>
                <label for="stunting_status"
                    class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">
                    Hasil Status Stunting (WHO) <span class="text-red-500">*</span>
                </label>
                <select id="stunting_status" name="stunting_status" required
                    x-model="childGrowthLog.data.stunting_status"
                    class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                    <option value="normal" class="bg-secondary">Normal</option>
                    <option value="stunted" class="bg-secondary">⚠️ Pendek (Stunted)</option>
                    <option value="severely_stunted" class="bg-secondary">🚨 Sangat Pendek (Severely Stunted)</option>
                </select>
            </div>

            <!-- Catatan Tambahan -->
            <div>
                <label class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Catatan
                    Tambahan (Opsional)</label>
                <textarea name="notes" rows="3" placeholder="Contoh: Asupan gizi tambahan terus dipantau oleh bidan desa..."
                    x-model="childGrowthLog.data.notes"
                    class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg resize-none bg-tertiary text-textPrimary placeholder:text-textTertiary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary"></textarea>
            </div>

            <!-- Footer Modal Actions -->
            <div class="flex items-center justify-end gap-2 pt-4 border-t border-textTertiary/10">
                <button type="button" @click="childGrowthLog.openCreate = false"
                    class="px-4 py-2 text-sm font-medium text-textPrimary transition-colors bg-secondary border border-textTertiary/40 rounded-lg hover:bg-tertiary focus:outline-none">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium text-secondary transition-colors bg-primary rounded-lg shadow-sm hover:opacity-90 focus:outline-none">
                    Simpan Data Timbangan
                </button>
            </div>
        </form>
    </div>
</div>
