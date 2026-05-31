<div>
    @if($citizen->employmentProfile)
    <div>
        Ada Isi
    </div>
    @else
    <div class="flex flex-col items-center justify-center gap-2 py-8">
        <x-gmdi-work-history-o class="text-orange-500 size-6" />
        <h5 class="text-sm font-semibold">Profil Pekerjaan Belum Tersedia</h5>
        <p class="text-xs text-slate-400">Riwayat ekonomi, pendapatan, dan bantuan sosial (DTKS) warga belum dicatat..</p>
    </div>

    <div class="flex items-center justify-end">
        <button class="flex items-center gap-2 px-4 py-2 text-xs text-white bg-orange-500 rounded-xl"><x-vaadin-plus class="w-4 h-4" /> Lengkapi Profil Pekerjaan</button>
    </div>
    @endif
</div>