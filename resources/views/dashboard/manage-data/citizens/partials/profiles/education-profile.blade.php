<div>
    @if($citizen->educationProfile)
    <div class="space-y-4">
        <dl class="flex flex-col gap-4 py-8 border-y rounded-xl">
            <div class="flex items-center justify-between">
                <dt class="text-xs font-medium text-slate-400">Tingkat Sekolah:</dt>
                <dd class="text-sm font-semibold">{{ $citizen->educationProfile->education_level->label() }}</dd>
            </div>
            <div class="flex items-center justify-between">
                <dt class="text-xs font-medium text-slate-400">Ijazah Terakhir:</dt>
                <dd class="text-sm font-semibold">{{ $citizen->educationProfile->highest_diploma->label() }}</dd>
            </div>
            <div class="flex items-center justify-between">
                <dt class="text-xs font-medium text-slate-400">Status Partisipasi:</dt>
                <dd class="px-2 py-1 text-sm font-semibold text-green-600 bg-green-100 rounded-xl">{{ $citizen->educationProfile->school_participation->label() }}</dd>
            </div>
        </dl>
        <div class="flex items-center justify-end">
            <button @click="educationProfile.openModal($event)" data-profile="{{ json_encode($citizen->educationProfile) }}" class="flex items-center gap-2 px-4 py-2 text-xs font-bold text-blue-500 bg-blue-100 rounded-xl"><x-heroicon-o-pencil-square class="w-4 h-4" /> Edit Profil Kesehatan</button>
        </div>
    </div>
    @else
    <div class="flex flex-col items-center justify-center gap-2 py-8">
        <x-solar-square-academic-cap-2-broken class="text-blue-500 size-6" />
        <h5 class="text-sm font-semibold">Profil Pendidikan Belum Tersedia</h5>
        <p class="text-xs text-slate-400">Warga ini belum memiliki riwayat pendidikan formal terdaftar.</p>
    </div>

    <div class="flex items-center justify-end">
        <button @click="educationProfile.openCreate = true" class="flex items-center gap-2 px-4 py-2 text-xs font-bold text-white bg-blue-500 rounded-xl"><x-vaadin-plus class="w-4 h-4" /> Lengkapi Profil Pendidikan</button>
    </div>
    @endif
</div>
