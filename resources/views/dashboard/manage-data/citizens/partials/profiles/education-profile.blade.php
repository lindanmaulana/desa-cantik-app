<div>
    @if($citizen->educationProfile)
    <div>
        Ada Isi
    </div>
    @else
    <div class="flex flex-col items-center justify-center gap-2 py-8">
        <x-solar-square-academic-cap-2-broken class="text-blue-500 size-6" />
        <h5 class="text-sm font-semibold">Profil Pendidikan Belum Tersedia</h5>
        <p class="text-xs text-slate-400">Warga ini belum memiliki riwayat pendidikan formal terdaftar.</p>
    </div>

    <div class="flex items-center justify-end">
        <button class="flex items-center gap-2 px-4 py-2 text-xs text-white bg-blue-500 rounded-xl"><x-vaadin-plus class="w-4 h-4" /> Lengkapi Profil Pendidikan</button>
    </div>
    @endif
</div>