<div x-show="healthProfile.openUpdate" class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto transition-opacity duration-300 bg-gray-900 bg-opacity-50 backdrop-blur-sm">

    <div class="w-full max-w-3xl overflow-hidden transition-all duration-300 transform scale-95 bg-white border border-gray-100 shadow-xl rounded-2xl">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gray-50">
            <div class="flex items-center gap-2">
                <div class="p-2 text-teal-600 rounded-lg bg-teal-50">
                    <x-heroicon-o-identification class="w-5 h-5" />
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Profile Kesehatan Individu</h3>
                </div>
            </div>
            <button @click="healthProfile.openUpdate = false" class="p-1 text-gray-400 transition-colors rounded-lg hover:text-gray-600 hover:bg-gray-100">
                <x-heroicon-o-x-mark class="w-5 h-5" />
            </button>
        </div>

        <form action="{{ route('health-profile.update', $citizen) }}" method="POST" class="p-6 space-y-4 max-h-[70vh] overflow-y-auto">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label for="update_disability_type" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Jenis Disabilitas <span class="text-red-500">*</span></label>
                    <select id="update_disability_type" name="disability_type" required x-model="healthProfile.data.disability_type"
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                        @foreach($disabilityType::cases() as $val)
                        <option value="{{ $val->value }}">{{ $val->label() }}</option>
                        @endforeach
                    </select>
                    @error('disability_type')
                    <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                @if($citizen->gender === $gender::FEMALE->value)
                <div>
                    <label for="update_is_pregnant" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Sedang Hamil? <span class="text-red-500">*</span></label>
                    <select id="update_is_pregnant" name="is_pregnant" required x-model="healthProfile.data.is_pregnant"
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                        <option value="0">Tidak</option>
                        <option value="1">Ya</option>
                    </select>
                    @error('is_pregnant')
                    <p id="error-is-pregnant" class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                @endif
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label for="update_bpjs_status" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Kepesertaan BPJS <span class="text-red-500">*</span></label>
                    <select id="update_bpjs_status" name="bpjs_status" required x-model="healthProfile.data.bpjs_status"
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                        @foreach($bpjsStatus::cases() as $val)
                        <option value="{{ $val->value }}">{{ $val->label() }}</option>
                        @endforeach
                    </select>
                    @error('bpjs_status')
                    <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="update_kb_method" class="block mb-1 text-xs font-semibold tracking-wider text-gray-600 uppercase">Metode KB Terpilih <span class="text-red-500">*</span></label>
                    <select id="update_kb_method" name="kb_method" required x-model="healthProfile.data.kb_method"
                        class="w-full px-3 py-2 text-sm transition-all border border-gray-200 rounded-lg bg-gray-50/50 focus:outline-none focus:bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                        @foreach($kbMethod::cases() as $val)
                        <option value="{{ $val->value }}">{{ $val->label() }}</option>
                        @endforeach
                    </select>
                    @error('kb_method')
                    <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center justify-end gap-2 pt-4 border-t border-gray-100">
                <button type="button" @click="healthProfile.openUpdate = false" class="px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-200 rounded-lg hover:bg-gray-50 focus:outline-none">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white transition-colors bg-teal-600 rounded-lg shadow-sm hover:bg-teal-700 focus:outline-none">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
