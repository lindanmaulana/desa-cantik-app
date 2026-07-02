<div x-show="healthProfile.openUpdate"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto transition-opacity duration-300 bg-textPrimary/50 backdrop-blur-sm">

    <div
        class="w-full max-w-3xl overflow-hidden transition-all duration-300 transform scale-95 border shadow-xl bg-secondary border-textTertiary/20 rounded-2xl">

        <!-- Header Modal -->
        <div class="flex items-center justify-between px-6 py-4 border-b border-textTertiary/10 bg-tertiary">
            <div class="flex items-center gap-2">
                <div class="p-2 rounded-lg text-primary bg-primary/10">
                    <x-heroicon-o-identification class="w-5 h-5" />
                </div>
                <div>
                    <h3 class="text-lg font-bold text-textPrimary">Profile Kesehatan Individu</h3>
                </div>
            </div>
            <button @click="healthProfile.openUpdate = false"
                class="p-1 transition-colors rounded-lg text-textSecondary hover:text-textPrimary hover:bg-textTertiary/20">
                <x-heroicon-o-x-mark class="w-5 h-5" />
            </button>
        </div>

        <!-- Form Update Data -->
        <form action="{{ route('health-profile.update', $citizen) }}" method="POST"
            class="p-6 space-y-4 max-h-[70vh] overflow-y-auto">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label for="update_disability_type"
                        class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">Jenis
                        Disabilitas <span class="text-red-500">*</span></label>
                    <select id="update_disability_type" name="disability_type" required
                        x-model="healthProfile.data.disability_type"
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        @foreach ($disabilityType::cases() as $val)
                            <option value="{{ $val->value }}" class="bg-secondary">{{ $val->label() }}</option>
                        @endforeach
                    </select>
                    @error('disability_type')
                        <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                @if ($citizen->gender === $gender::FEMALE)
                    <div>
                        <label for="update_is_pregnant"
                            class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">Sedang
                            Hamil? <span class="text-red-500">*</span></label>
                        <select id="update_is_pregnant" name="is_pregnant" required
                            x-model="healthProfile.data.is_pregnant"
                            class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                            <option value="0" class="bg-secondary">Tidak</option>
                            <option value="1" class="bg-secondary">Ya</option>
                        </select>
                        @error('is_pregnant')
                            <p id="error-is-pregnant" class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                @endif
            </div>

            <!-- Baris 2: Kepesertaan BPJS & Metode KB -->
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label for="update_bpjs_status"
                        class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">Kepesertaan
                        BPJS <span class="text-red-500">*</span></label>
                    <select id="update_bpjs_status" name="bpjs_status" required x-model="healthProfile.data.bpjs_status"
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        @foreach ($bpjsStatus::cases() as $val)
                            <option value="{{ $val->value }}" class="bg-secondary">{{ $val->label() }}</option>
                        @endforeach
                    </select>
                    @error('bpjs_status')
                        <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="update_kb_method"
                        class="block mb-1 text-xs font-semibold tracking-wider uppercase text-textSecondary">Metode KB
                        Terpilih <span class="text-red-500">*</span></label>
                    <select id="update_kb_method" name="kb_method" required x-model="healthProfile.data.kb_method"
                        class="w-full px-3 py-2 text-sm transition-all border rounded-lg border-textTertiary/40 bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                        @foreach ($kbMethod::cases() as $val)
                            <option value="{{ $val->value }}" class="bg-secondary">{{ $val->label() }}</option>
                        @endforeach
                    </select>
                    @error('kb_method')
                        <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="flex items-center justify-end gap-2 pt-4 border-t border-textTertiary/10">
                <button type="button" @click="healthProfile.openUpdate = false"
                    class="px-4 py-2 text-sm font-medium transition-colors border rounded-lg text-textPrimary bg-secondary border-textTertiary/40 hover:bg-tertiary focus:outline-none">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium transition-colors rounded-lg shadow-sm text-secondary bg-primary hover:opacity-90 focus:outline-none">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
