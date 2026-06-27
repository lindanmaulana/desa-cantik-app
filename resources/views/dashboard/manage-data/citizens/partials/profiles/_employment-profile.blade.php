<div>
    @if($citizen->employmentProfile)
    <div class="space-y-4">
        <div class="p-4 space-y-4 border rounded-xl">
            <dl class="flex flex-col gap-2 py-4 border-b">
                <div class="flex items-center justify-between">
                    <dt class="text-xs font-medium text-slate-400">Pekerjaan Utama:</dt>
                    <dd class="text-sm font-semibold">{{ $citizen->employmentProfile->occupation }}</dd>
                </div>
                <div class="flex items-center justify-between">
                    <dt class="text-xs font-medium text-slate-400">Sektor Kerja:</dt>
                    <dd class="text-sm font-semibold">{{ $citizen->employmentProfile->job_sector->label() }} / {{ $citizen->employmentProfile->employment_status->label() }}</dd>
                </div>
                <div class="flex items-center justify-between">
                    <dt class="text-xs font-medium text-slate-400">Penghasilan Bulanan:</dt>
                    <dd class="px-2 py-1 text-sm font-semibold text-green-800 rounded-xl">{{ Number::currency($citizen->employmentProfile->monthly_income, in: 'IDR', locale: 'id') }}</dd>
                </div>
                <div class="flex items-center justify-between">
                    <dt class="text-xs font-medium text-slate-400">Status DTKS Kemenkes:</dt>
                    <dd class="px-2 py-1 text-sm font-semibold rounded-xl">{{ $citizen->employmentProfile->economic_status->label() }}</dd>
                </div>
            </dl>

            @if($citizen->employmentProfile->is_welfare_recipient)
            <dl class="space-y-1">
                <dt class="text-xs font-semibold text-amber-600">BANTUAN SOSIAL AKTIF:</dt>
                <dd class="w-full py-1 text-xs text-center border rounded-lg bg-amber-50 border-amber-200 text-amber-800 ">{{ $citizen->employmentProfile->assistance_type ? $citizen->employmentProfile->assistance_type : '-' }}</dd>
            </dl>
            @endif
        </div>
        <div class="flex items-center justify-end">
            <button @click="employmentProfile.openModal($event)" data-profile="{{ json_encode($citizen->employmentProfile) }}" class="flex items-center gap-2 px-4 py-2 text-xs font-bold text-amber-500 bg-amber-100 rounded-xl"><x-heroicon-o-pencil-square class="w-4 h-4" /> Edit Profil Pekerjaan</button>
        </div>
    </div>
    @else
    <div class="flex flex-col items-center justify-center gap-2 py-8">
        <x-gmdi-work-history-o class="text-orange-500 size-6" />
        <h5 class="text-sm font-semibold">Profil Pekerjaan Belum Tersedia</h5>
        <p class="text-xs text-slate-400">Riwayat ekonomi, pendapatan, dan bantuan sosial (DTKS) warga belum dicatat..</p>
    </div>

    <div class="flex items-center justify-end">
        <button @click="employmentProfile.openCreate = true" class="flex items-center gap-2 px-4 py-2 text-xs text-white bg-orange-500 rounded-xl"><x-vaadin-plus class="w-4 h-4" /> Lengkapi Profil Pekerjaan</button>
    </div>
    @endif
</div>
