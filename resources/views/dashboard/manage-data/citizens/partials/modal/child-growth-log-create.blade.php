    <div x-show="childGrowthLog.openCreate"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto transition-opacity duration-300 bg-gray-900 bg-opacity-50 backdrop-blur-sm"
        style="display: none;">

        <div class="w-full max-w-3xl overflow-hidden transition-all duration-300 transform scale-95 bg-white border border-gray-100 shadow-xl rounded-2xl">

            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gray-50">
                <div class="flex items-center gap-2">
                    <div class="p-2 text-teal-600 rounded-lg bg-teal-50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Input Log Perkembangan Balita (Posyandu)</h3>
                    </div>
                </div>
                <button @click="childGrowthLog.openCreate = false" class="p-1 text-gray-400 transition-colors rounded-lg hover:text-gray-600 hover:bg-gray-100">
                    <x-heroicon-o-x-mark class="w-5 h-5" />
                </button>
            </div>

            <form action="{{ route('child-growth-logs.store', $citizen)}}" method="POST" class="p-6 space-y-4 max-h-[70vh] overflow-y-auto text-left">
                @csrf
                @method('POST')

                <div>
                    <label class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">
                        Tanggal Pengukuran <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="measured_at" required x-model="childGrowthLog.data.measured_at"
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">
                            Berat Badan (BB) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative flex items-center">
                            <input type="number" step="0.01" name="weight" required placeholder="Contoh: 9.20" x-model="childGrowthLog.data.weight"
                                class="w-full py-2 pl-3 pr-12 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            <span class="absolute text-xs font-bold text-gray-400 right-3">Kg</span>
                        </div>
                    </div>

                    <div>
                        <label class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">
                            Tinggi / Panjang Badan (TB) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative flex items-center">
                            <input type="number" step="0.01" name="height" required placeholder="Contoh: 76.50" x-model="childGrowthLog.data.height"
                                class="w-full py-2 pl-3 pr-12 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            <span class="absolute text-xs font-bold text-gray-400 right-3">Cm</span>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">
                        Metode Pengukuran <span class="text-red-500">*</span>
                    </label>
                    <div class="grid grid-cols-2 gap-3 mt-1">
                        <label class="flex items-center gap-2 p-3 border border-gray-200 rounded-lg cursor-pointer bg-gray-50/30 hover:bg-gray-50">
                            <input type="radio" name="measurement_method" value="recumber" x-model="childGrowthLog.data.measurement_method" class="w-4 h-4 text-teal-600 focus:ring-teal-500">
                            <span class="text-sm font-medium text-gray-700">🛌 Telentang (Recumber)</span>
                        </label>
                        <label class="flex items-center gap-2 p-3 border border-gray-200 rounded-lg cursor-pointer bg-gray-50/30 hover:bg-gray-50">
                            <input type="radio" name="measurement_method" value="standing" x-model="childGrowthLog.data.measurement_method" class="w-4 h-4 text-teal-600 focus:ring-teal-500">
                            <span class="text-sm font-medium text-gray-700">🧍 Berdiri (Standing)</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-between p-4 border bg-teal-50/50 border-teal-100/70 rounded-xl">
                    <div class="space-y-0.5">
                        <label class="text-sm font-bold text-teal-900">Pemberian Vitamin A</label>
                        <span class="block text-xs text-teal-600">Beri centang jika balita mendapatkan kapsul vitamin A bulan ini</span>
                    </div>
                    <input type="hidden" name="vit_a_received" value="0">
                    <input type="checkbox" name="vit_a_received" value="1" x-model="childGrowthLog.data.vit_a_received"
                        class="w-5 h-5 text-teal-600 border-gray-300 rounded cursor-pointer focus:ring-teal-500 accent-teal-600">
                </div>

                <div>
                    <label for="stunting_status" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">
                        Hasil Status Stunting (WHO) <span class="text-red-500">*</span>
                    </label>
                    <select id="stunting_status" name="stunting_status" required x-model="childGrowthLog.data.stunting_status"
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                        <option value="normal">Normal</option>
                        <option value="stunted">⚠️ Pendek (Stunted)</option>
                        <option value="severely_stunted">🚨 Sangat Pendek (Severely Stunted)</option>
                    </select>
                </div>

                <div>
                    <label class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Catatan Tambahan (Opsional)</label>
                    <textarea name="notes" rows="3" placeholder="Contoh: Asupan gizi tambahan terus dipantau oleh bidan desa..." x-model="childGrowthLog.data.notes"
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg resize-none bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500"></textarea>
                </div>

                <div class="flex items-center justify-end gap-2 pt-4 border-t border-gray-100">
                    <button type="button" @click="childGrowthLog.openCreate = false"
                        class="px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-200 rounded-lg hover:bg-gray-50 focus:outline-none">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white transition-colors bg-teal-600 rounded-lg shadow-sm hover:bg-teal-700 focus:outline-none">
                        Simpan Data Timbangan
                    </button>
                </div>
            </form>
        </div>
    </div>
