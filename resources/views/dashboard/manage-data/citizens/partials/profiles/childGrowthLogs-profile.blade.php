  <div>
      @if(!$citizen->isToddler)
      <div class="flex flex-col items-center justify-center gap-2 py-8">
          <x-solar-square-academic-cap-2-broken class="size-6 text-primary" />
          <h5 class="text-sm font-semibold">Bukan Usia Balita (0 - 5 Tahun)</h5>
          <p class="text-xs text-center text-slate-400 max-w-64">Pemantauan log tumbuh kembang stunting di Posyandu hanya berlaku bagi warga usia balita..</p>
      </div>
      @endif

      @if($citizen->employmentProfile)
      <div>
          Ada Isi
      </div>
      @endif
  </div>