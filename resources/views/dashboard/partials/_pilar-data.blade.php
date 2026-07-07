<div id="pelajari-lebih" class="py-8 space-y-8 sm:space-y-12">
    <div class="flex flex-col items-center max-w-2xl px-4 mx-auto space-y-3 text-center">
        <div class="px-3 py-1.5 text-[11px] font-bold tracking-widest uppercase rounded-full bg-primary/10 text-primary border border-primary/20 backdrop-blur-sm">
            Wawasan Publik
        </div>
        <h2 class="text-2xl font-extrabold tracking-tight sm:text-3xl md:text-4xl text-textPrimary">
            5 Pilar Data {{ $villageSettings->village_name ?? '-' }}
        </h2>
        <p class="max-w-xl text-xs font-medium leading-relaxed sm:text-sm text-textSecondary">
            Setiap pilar dirancang untuk memberikan gambaran komprehensif, terstruktur, dan transparan bagi tata kelola wilayah dan masyarakat luas.
        </p>
    </div>

    <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3 sm:gap-6">
        <div class="group bg-secondary p-6 sm:p-8 rounded-2xl border border-tertiary shadow-sm hover:shadow-md hover:border-primary/40 transition-all duration-300 flex flex-col justify-between min-h-[220px]">
            <div class="space-y-4">
                <div class="p-3 transition-transform shadow-inner bg-primary/10 text-primary rounded-xl w-fit group-hover:scale-105">
                    <x-heroicon-o-users class="w-5 h-5" />
                </div>
                <div class="space-y-1.5">
                    <h4 class="text-base font-bold tracking-tight text-textPrimary sm:text-lg">Data Demografi</h4>
                    <p class="text-xs antialiased font-normal leading-relaxed text-textSecondary">
                        Rekap menyeluruh jumlah penduduk, struktur usia, jenis kelamin, dan distribusi per dusun/RT/RW. Fondasi utama perencanaan pembangunan desa.
                    </p>
                </div>
            </div>
        </div>

        <div class="group bg-secondary p-6 sm:p-8 rounded-2xl border border-tertiary shadow-sm hover:shadow-md hover:border-emerald-500/40 transition-all duration-300 flex flex-col justify-between min-h-[220px]">
            <div class="space-y-4">
                <div class="p-3 transition-transform shadow-inner bg-emerald-500/10 text-emerald-500 rounded-xl w-fit group-hover:scale-105">
                    <x-iconsax-bul-chart-1 class="w-5 h-5" />
                </div>
                <div class="space-y-1.5">
                    <h4 class="text-base font-bold tracking-tight text-textPrimary sm:text-lg">Data Sosial & Ekonomi</h4>
                    <p class="text-xs antialiased font-normal leading-relaxed text-textSecondary">
                        Potret kondisi sosial-ekonomi warga meliputi tingkat pendidikan, mata pencaharian, penetapan kategori kesejahteraan keluarga, dan ketepatan penerima bantuan sosial.
                    </p>
                </div> 
            </div>
        </div>

        <div class="group bg-secondary p-6 sm:p-8 rounded-2xl border border-tertiary shadow-sm hover:shadow-md hover:border-amber-500/40 transition-all duration-300 flex flex-col justify-between min-h-[220px]">
            <div class="space-y-4">
                <div class="p-3 transition-transform shadow-inner bg-amber-500/10 text-amber-500 rounded-xl w-fit group-hover:scale-105">
                    <x-iconsax-bro-shop class="w-5 h-5" />
                </div>
                <div class="space-y-1.5">
                    <h4 class="text-base font-bold tracking-tight text-textPrimary sm:text-lg">Data UMKM</h4>
                    <p class="text-xs antialiased font-normal leading-relaxed text-textSecondary">
                        Direktori komprehensif usaha mikro, kecil, dan menengah lokal di {{ $villageSettings->village_name ?? '-' }} guna mendorong akselerasi dan pemetaan ekonomi kreatif masyarakat.
                    </p>
                </div>
            </div>
        </div>

        <div class="group bg-secondary p-6 sm:p-8 rounded-2xl border border-tertiary shadow-sm hover:shadow-md hover:border-cyan-500/40 transition-all duration-300 flex flex-col justify-between min-h-[220px]">
            <div class="space-y-4">
                <div class="p-3 transition-transform shadow-inner bg-cyan-500/10 text-cyan-500 rounded-xl w-fit group-hover:scale-105">
                    <x-iconsax-lin-buildings class="w-5 h-5" />
                </div>
                <div class="space-y-1.5">
                    <h4 class="text-base font-bold tracking-tight text-textPrimary sm:text-lg">Data Infrastruktur Desa</h4>
                    <p class="text-xs antialiased font-normal leading-relaxed text-textSecondary">
                        Inventarisasi aset fisik desa dan fasilitas publik mulai dari akses jalan, jembatan, sarana pendidikan, fasilitas kesehatan, hingga tempat peribadatan umum.
                    </p>
                </div>
            </div>
        </div>

        <div class="group bg-secondary p-6 sm:p-8 rounded-2xl border border-tertiary shadow-sm hover:shadow-md hover:border-rose-500/40 transition-all duration-300 flex flex-col justify-between min-h-[220px]">
            <div class="space-y-4">
                <div class="p-3 transition-transform shadow-inner bg-rose-500/10 text-rose-500 rounded-xl w-fit group-hover:scale-105">
                    <x-heroicon-o-map-pin class="w-5 h-5" />
                </div>
                <div class="space-y-1.5">
                    <h4 class="text-base font-bold tracking-tight text-textPrimary sm:text-lg">Data Spasial</h4>
                    <p class="text-xs antialiased font-normal leading-relaxed text-textSecondary">
                        Pemetaan berbasis koordinat geografis (GPS) untuk zonasi rumah tangga, batas wilayah administrasi, serta visualisasi pemetaan keruangan desa secara interaktif.
                    </p>
                </div>
            </div>
        </div>

        @guest
        <div class="relative bg-primary p-6 sm:p-8 rounded-2xl shadow-xl shadow-primary/10 flex flex-col justify-between min-h-[220px] md:col-span-2 lg:col-span-1 overflow-hidden group">
            <div class="absolute w-32 h-32 transition-transform duration-500 rounded-full -top-12 -right-12 bg-white/10 blur-2xl group-hover:scale-125"></div>

            <div class="space-y-2.5 relative z-10">
                <h4 class="text-lg font-extrabold tracking-tight text-secondary">Akses Data Lengkap</h4>
                <p class="text-xs antialiased font-medium leading-relaxed text-secondary/85">
                    Masuk menggunakan akun petugas terverifikasi untuk membuka dasbor manajemen, mengelola entitas instansi, serta mengekspor berkas analisis statistik.
                </p>
            </div>

            <div class="relative z-10 w-full pt-4">
                <x-button variant="secondary" size="md" class="w-full font-bold shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2 text-primary bg-secondary">
                    <x-iconsax-bro-arrow-square-right class="w-4 h-4" />
                    @auth
                    <span>Dashboard Petugas</span>
                    @else
                    <span>Login Sekarang</span>
                    @endauth
                </x-button>
            </div>
        </div>
        @endguest

    </div>
</div>
