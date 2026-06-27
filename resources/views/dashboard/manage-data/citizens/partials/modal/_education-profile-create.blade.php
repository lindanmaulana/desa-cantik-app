<div x-show="educationProfile.openCreate"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto transition-opacity duration-300 bg-textPrimary/50 backdrop-blur-sm">
    <div
        class="w-full max-w-3xl overflow-hidden transition-all duration-300 transform scale-95 bg-secondary border border-textTertiary/20 shadow-xl rounded-2xl">

        <!-- Header Modal -->
        <div class="flex items-center justify-between px-6 py-4 border-b border-textTertiary/10 bg-tertiary">
            <div class="flex items-center gap-2">
                <div class="p-2 text-primary rounded-lg bg-primary/10">
                    <x-heroicon-o-identification class="w-5 h-5" />
                </div>
                <div>
                    <h3 class="text-lg font-bold text-textPrimary">Profile Kualifikasi Pendidikan</h3>
                </div>
            </div>
            <button @click="educationProfile.openCreate = false"
                class="p-1 text-textSecondary transition-colors rounded-lg hover:text-textPrimary hover:bg-textTertiary/20">
                <x-heroicon-o-x-mark class="w-5 h-5" />
            </button>
        </div>

        <!-- Form Input Data Pendidikan -->
        <form action="{{ route('education-profile.store', $citizen) }}" method="POST"
            class="p-6 space-y-4 max-h-[70vh] overflow-y-auto">
            @csrf

            <!-- Jenjang Pendidikan -->
            <div>
                <label for="education_level"
                    class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Jenjang
                    Pendidikan <span class="text-red-500">*</span></label>
                <select id="education_level" name="education_level" required
                    class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                    @foreach ($educationLevel::cases() as $val)
                        <option value="{{ $val->value }}" class="bg-secondary">{{ $val->label() }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Ijazah Tertinggi -->
            <div>
                <label for="highest_diploma"
                    class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Ijazah
                    Tertinggi Yang Dimiliki <span class="text-red-500">*</span></label>
                <select id="highest_diploma" name="highest_diploma" required
                    class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                    @foreach ($educationLevel::cases() as $val)
                        <option value="{{ $val->value }}" class="bg-secondary">{{ $val->label() }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Status Partisipasi Sekolah -->
            <div>
                <label for="school_participation"
                    class="block mb-1 text-xs font-semibold tracking-wider text-textSecondary uppercase">Status
                    Partisipasi Sekolah <span class="text-red-500">*</span></label>
                <select id="school_participation" name="school_participation" required
                    class="w-full px-3 py-2 text-sm transition-all border border-textTertiary/40 rounded-lg bg-tertiary text-textPrimary focus:outline-none focus:bg-secondary focus:border-primary focus:ring-1 focus:ring-primary">
                    @foreach ($schoolParticipation::cases() as $val)
                        <option value="{{ $val->value }}" class="bg-secondary">{{ $val->label() }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Footer Modal Actions -->
            <div class="flex items-center justify-end gap-2 pt-4 border-t border-textTertiary/10">
                <button type="button" @click="educationProfile.openCreate = false"
                    class="px-4 py-2 text-sm font-medium text-textPrimary transition-colors bg-secondary border border-textTertiary/40 rounded-lg hover:bg-tertiary focus:outline-none">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium text-secondary transition-colors bg-primary rounded-lg shadow-sm hover:opacity-90 focus:outline-none">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
