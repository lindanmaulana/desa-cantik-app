<section class="space-y-8">

    <!-- Heading -->
    <div class="max-w-2xl mx-auto space-y-2 text-center">
        <div
            class="inline-flex items-center gap-2 px-3 py-1 text-xs font-semibold border rounded-full border-primary/20 bg-primary/10 text-primary">
            Ringkasan Statistik
        </div>

        <h2 class="text-2xl font-bold text-textPrimary sm:text-3xl">
            Statistik Desa {{ $villageSettings->village_name ?? '-' }}
        </h2>

        <p class="text-sm text-textSecondary">
            Gambaran singkat kondisi desa berdasarkan data yang telah dihimpun dan diperbarui secara berkala.
        </p>
    </div>

    <div class="relative p-8 overflow-hidden text-white shadow-xl rounded-3xl bg-primary">
        <div
            class="absolute rounded-full -right-16 -top-16 h-52 w-52 bg-white/10 blur-3xl">
        </div>

        <div class="relative">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">

                    <div class="p-4 rounded-2xl bg-white/10">
                        <x-heroicon-o-users class="w-8 h-8" />
                    </div>

                    <div>
                        <p class="text-sm text-white/80">
                            Total Penduduk
                        </p>

                        <h3 class="mt-1 text-5xl font-bold tracking-tight">
                            {{ $stats['totalCitizens'] ?? '-' }}
                        </h3>

                        <p class="mt-2 text-sm text-white/70">
                            Jiwa
                        </p>
                    </div>

                </div>

                <span
                    class="hidden px-3 py-1 text-xs font-medium rounded-full bg-white/10 backdrop-blur md:block">
                    Data Terbaru
                </span>
            </div>

            <div class="grid gap-6 pt-6 mt-8 border-t border-white/10 md:grid-cols-3">
                <div>
                    <p class="text-xs tracking-wider uppercase text-white/60">
                        Laki-laki
                    </p>

                    <p class="mt-1 text-2xl font-semibold">
                        {{ $stats['totalMale'] ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs tracking-wider uppercase text-white/60">
                        Perempuan
                    </p>

                    <p class="mt-1 text-2xl font-semibold">
                        {{ $stats['totalFemale'] ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs tracking-wider uppercase text-white/60">
                        Kepala Keluarga
                    </p>

                    <p class="mt-1 text-2xl font-semibold">
                        {{ $stats['totalHeadOfFamily'] ?? '-' }}
                    </p>
                </div>

            </div>

        </div>

    </div>

    <div class="grid gap-5 md:grid-cols-3">
        <!-- Rumah -->
        <div
            class="p-6 transition-all duration-300 border shadow-sm rounded-2xl border-tertiary bg-secondary hover:-translate-y-1 hover:shadow-lg">

            <div class="flex items-center justify-between">

                <div class="p-3 rounded-xl bg-amber-50 text-amber-500">
                    <x-iconsax-out-buildings class="w-6 h-6" />
                </div>

                <span class="text-xs text-textSecondary">
                    Bangunan
                </span>

            </div>

            <h3 class="mt-6 text-3xl font-bold text-textPrimary">
                {{ $stats['totalHouses'] ?? '-' }}
            </h3>

            <p class="mt-1 font-medium text-textPrimary">
                Rumah Terdata
            </p>

            <p class="mt-2 text-sm text-textSecondary">
                Total bangunan hunian yang telah didata.
            </p>

        </div>

        <!-- Dusun -->
        <div
            class="p-6 transition-all duration-300 border shadow-sm rounded-2xl border-tertiary bg-secondary hover:-translate-y-1 hover:shadow-lg">

            <div class="flex items-center justify-between">

                <div class="p-3 rounded-xl bg-cyan-50 text-cyan-500">
                    <x-heroicon-o-map class="w-6 h-6" />
                </div>

                <span class="text-xs text-textSecondary">
                    Wilayah
                </span>
            </div>

            <h3 class="mt-6 text-3xl font-bold text-textPrimary">
                {{ $stats['totalHamles'] ?? '-' }}
            </h3>

            <p class="mt-1 font-medium text-textPrimary">
                Dusun Terdata
            </p>

            <p class="mt-2 text-sm text-textSecondary">
                Seluruh dusun telah masuk dalam sistem informasi desa.
            </p>
        </div>

        <!-- UMKM -->
        <div
            class="p-6 transition-all duration-300 border shadow-sm rounded-2xl border-tertiary bg-secondary hover:-translate-y-1 hover:shadow-lg">

            <div class="flex items-center justify-between">

                <div class="p-3 rounded-xl bg-emerald-50 text-emerald-500">
                    <x-iconsax-bro-shop class="w-6 h-6" />
                </div>

                <span class="text-xs text-textSecondary">
                    Ekonomi
                </span>

            </div>

            <h3 class="mt-6 text-3xl font-bold text-textPrimary">
                {{ $stats['totalMsme'] ?? '-' }}
            </h3>

            <p class="mt-1 font-medium text-textPrimary">
                UMKM Terdaftar
            </p>

            <p class="mt-2 text-sm text-textSecondary">
                Usaha mikro, kecil, dan menengah yang telah terdata.
            </p>

        </div>

    </div>

</section>
