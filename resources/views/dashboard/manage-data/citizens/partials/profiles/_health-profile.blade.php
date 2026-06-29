<div>
    @if($citizen->healthProfile)
    <div class="space-y-4">
        <dl class="grid grid-cols-2 gap-4 py-8 border-y rounded-xl">
            <div>
                <dt class="text-xs font-medium text-slate-400">Jenis Disabilitas</dt>
                <dd class="text-sm font-semibold">{{ $citizen->healthProfile->disability_type->label() }}</dd>
            </div>
            <div>
                <dt class="text-xs font-medium text-slate-400">Status BPJS Jamsos</dt>
                <dd class="text-sm font-semibold">{{ $citizen->healthProfile->bpjs_status->label() }}</dd>
            </div>

            @if($citizen->gender === $gender::FEMALE->value)
            <div>
                <dt class="text-xs font-medium text-slate-400">Kondisi Kehamilan</dt>
                <dd class="text-sm font-semibold">{{ $citizen->healthProfile->is_pregnant ? 'Hamil' : 'Tidak Hamil' }}</dd>
            </div>
            @endif

            <div>
                <dt class="text-xs font-medium text-slate-400">Akseptor Keluarga Berencana</dt>
                <dd class="text-sm font-semibold">{{ $citizen->healthProfile->kb_method->label() }}</dd>
            </div>
        </dl>
        <div class="flex items-center justify-end">
            <button @click="healthProfile.openModal($event)" data-profile="{{ json_encode($citizen->healthProfile) }}" class="flex items-center gap-2 px-4 py-2 text-xs font-bold rounded-xl text-primary bg-primary/10"><x-heroicon-o-pencil-square class="w-4 h-4" /> Edit Profil Kesehatan</button>
        </div>
    </div>
    @else
    <div class="flex flex-col items-center justify-center gap-2 py-8">
        <x-vaadin-health-card class="size-6 text-primary" />
        <h5 class="text-sm font-semibold">Profil Kesehatan Individu Belum Tersedia</h5>
        <p class="text-xs text-slate-400">Riwayat Kesehatan warga belum di catat.</p>
    </div>

    <div class="flex items-center justify-end">
        <button @click="healthProfile.openCreate = true" class="flex items-center gap-2 px-4 py-2 text-xs font-bold rounded-xl text-primary bg-primary/10"><x-vaadin-plus class="w-4 h-4" /> Lengkapi Profil Kesehatan</button>
    </div>
    @endif
</div>
