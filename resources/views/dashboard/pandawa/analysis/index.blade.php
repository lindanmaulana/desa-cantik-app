<x-layouts.dashboard>
    <div class="space-y-6">
        <div class="flex items-center gap-4 pb-6 mb-10 border-b border-slate-200">
            <x-bi-shop class="p-3 rounded-md size-12 bg-primary/20 text-primary" />
            <div>
                <h3 class="text-xl font-bold">Pandawa Statistik - Analisis</h3>
                <p class="text-slate-600">Pusat Analisis dan Wawasan Data Statistik</p>
            </div>
        </div>

        <div class="flex flex-col w-full overflow-hidden shadow-lg rounded-2xl">
            <div class="relative p-6 border-b bg-gray-50">
                <div class="grid grid-cols-3 text-sm text-gray-600">
                    <div>
                        <span class="block mb-1 text-xs font-medium text-gray-400">Dipublish pada tanggal:</span>
                        <div class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 text-blue-600 rounded-full font-semibold text-xs">
                            <i class="ri-calendar-event-line"></i> 7 Mei 2026
                        </div>
                    </div>

                    <div>
                        <span class="block mb-1 text-xs font-medium text-gray-400">Jenis Analisis:</span>
                        <div class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-cyan-50 text-cyan-600 rounded-full font-semibold text-xs">
                            <i class="ri-lightbulb-line"></i> Analisis Eksploratif antar Variabel
                        </div>
                    </div>


                    <div>
                        <span class="block mb-1 text-xs font-medium text-gray-400">Variabel yang dianalisis:</span>
                        <div class="flex flex-wrap gap-1.5 max-w-xl">
                            <span class="px-2.5 py-1 bg-blue-50 text-blue-600 rounded-full font-medium text-xs">Jenis Kelamin</span>
                            <span class="px-2.5 py-1 bg-blue-50 text-blue-600 rounded-full font-medium text-xs">Kelompok Umur</span>
                            <span class="px-2.5 py-1 bg-blue-50 text-blue-600 rounded-full font-medium text-xs">Status Perkawinan</span>
                            <span class="px-2.5 py-1 bg-blue-50 text-blue-600 rounded-full font-medium text-xs">Agama</span>
                            <span class="px-2.5 py-1 bg-blue-50 text-blue-600 rounded-full font-medium text-xs">Partisipasi Sekolah</span>
                            <span class="px-2.5 py-1 bg-blue-50 text-blue-600 rounded-full font-medium text-xs">Jenis Pekerjaan</span>
                            <span class="px-2.5 py-1 bg-blue-50 text-blue-600 rounded-full font-medium text-xs">Lapangan Usaha</span>
                        </div>
                    </div>
                </div>

                <button class="absolute right-10 top-0 max-w-20 self-end text-center flex items-center gap-1.5 px-3 py-1.5 border border-red-400 rounded-lg bg-white text-red-600 hover:bg-red-50 text-xs font-semibold transition-all shrink-0">
                    <x-bi-file-pdf class="text-sm ri-file-pdf-2-line" /> PDF
                </button>
            </div>

            <div class="p-8 bg-white">

                <div class="mb-8">
                    <hr class="mt-0 mb-8 border-gray-100">
                    <h1 class="mb-8 text-4xl font-extrabold tracking-tight text-blue-600">
                        Laporan Analisis Data Statistik Desa Sukaraja
                    </h1>
                    <div class="mb-8">
                        <h2 class="mb-4 text-2xl font-bold text-blue-600">1. Gambaran Umum</h2>
                        <p class="text-base leading-relaxed text-gray-600">
                            Desa Sukaraja berdiri di atas fondasi demografi yang sangat muda dan produktif, namun saat ini sedang mengalami
                            <span class="font-bold text-gray-800">krisis visibilitas data</span> yang mengkhawatirkan. Dengan total
                            <span class="font-bold text-gray-800">8.087 jiwa</span> yang 100% memeluk agama Islam, desa ini memiliki potensi kohesi sosial yang tinggi, namun terancam oleh ketidaklengkapan administrasi yang menghalangi pemetaan ekonomi penduduk secara akurat.
                        </p>
                    </div>
                </div>

                <hr class="my-8 border-gray-100">

                <div class="mb-8">
                    <h2 class="mb-4 text-3xl font-bold text-blue-600">2. Analisis Per Variabel</h2>
                    <ul class="pl-0 space-y-4 text-base leading-relaxed text-gray-600 list-none">
                        <li class="flex items-start gap-2">
                            <span class="font-bold text-gray-800 shrink-0">•</span>
                            <span><span class="font-bold text-gray-800">Demografi:</span> Struktur penduduk didominasi oleh kelompok <span class="font-bold text-gray-800">Dewasa Produktif (25-54 tahun)</span> sebanyak <span class="font-bold text-gray-800">3.787 jiwa</span> (46,8%). Rasio ketergantungan terlihat moderat dengan jumlah lansia (65+) sebanyak <span class="font-bold text-gray-800">777 jiwa</span>.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="font-bold text-gray-800 shrink-0">•</span>
                            <span><span class="font-bold text-gray-800">Status Perkawinan:</span> Terdapat inkonsistensi input data (variasi penulisan "Kawin", "kawin", "KAWIN"). Secara agregat, penduduk <span class="font-bold text-gray-800">Kawin</span> mencapai <span class="font-bold text-gray-800">4.011 jiwa</span> (setelah dikoreksi dari variasi penulisan).</span>
                        </li>
                    </ul>
                </div>

                <hr class="my-8 border-gray-100">

                <div class="mb-8">
                    <h2 class="mb-4 text-3xl font-bold text-blue-600">3. Ringkasan Masalah Utama</h2>
                    <ul class="pl-0 space-y-4 text-base leading-relaxed text-gray-600 list-none">
                        <li class="flex items-start gap-2">
                            <span class="font-bold text-gray-800 shrink-0">•</span>
                            <span><span class="font-bold text-gray-800">Krisis Visibilitas Data:</span> Ditemukan banyaknya jumlah data yang tidak terisi pada kolom penting seperti "Jenis Pekerjaan", yang menyebabkan sulitnya memetakan kondisi ekonomi riil masyarakat secara akurat.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="font-bold text-gray-800 shrink-0">•</span>
                            <span><span class="font-bold text-gray-800">Inkonsistensi Standarisasi Input:</span> Adanya variasi penulisan teks pada database (seperti perbedaan huruf kapital dan kecil pada status pernikahan) yang berpotensi menimbulkan bias dan duplikasi data saat dianalisis oleh sistem.</span>
                        </li>
                    </ul>
                </div>

                <hr class="my-8 border-gray-100">

                <div class="mb-8">
                    <h2 class="mb-4 text-3xl font-bold text-blue-600">4. Temuan Penting</h2>
                    <ul class="pl-0 space-y-4 text-base leading-relaxed text-gray-600 list-none">
                        <li class="flex items-start gap-2">
                            <span class="font-bold text-gray-800 shrink-0">•</span>
                            <span><span class="font-bold text-gray-800">Dominasi Sektor Kuliner & Perdagangan:</span> Mayoritas pelaku usaha di wilayah RT 001/RW 001 bergerak di sektor penyediaan makanan minuman dan grosir/eceran, namun masih memiliki ketergantungan yang tinggi terhadap modal konvensional.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="font-bold text-gray-800 shrink-0">•</span>
                            <span><span class="font-bold text-gray-800">Tantangan Pendidikan Tenaga Kerja:</span> Sebagian besar pengelola usaha atau penduduk usia produktif memiliki latar belakang pendidikan formal yang berpusat pada tingkat dasar, sehingga memerlukan intervensi berupa pelatihan vokasi praktis untuk mendorong mereka masuk ke sektor pekerjaan formal yang lebih stabil.</span>
                        </li>
                    </ul>
                </div>

                <hr class="my-8 border-gray-100">

                <div class="mb-8">
                    <h2 class="mb-6 text-3xl font-bold text-blue-600">5. Recommendation Kebijakan</h2>
                    <ol class="pl-0 space-y-4 text-base leading-relaxed text-gray-600 list-none">
                        <li class="flex items-start gap-2">
                            <span class="font-bold text-gray-800 shrink-0">1.</span>
                            <span><span class="font-bold text-gray-800">Audit Data (Data Cleansing):</span> Pemerintah desa harus segera melakukan pemutahkiran data penduduk secara <span class="italic">door-to-door</span> untuk mengisi kekosongan variabel "Jenis Pekerjaan" dan menyeragamkan entri status perkawinan.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="font-bold text-gray-800 shrink-0">2.</span>
                            <span><span class="font-bold text-gray-800">Program Literasi & Keterampilan:</span> Mengingat tingginya jumlah penduduk tamat SD dan tidak sekolah, pemerintah desa perlu mengadakan pelatihan vokasi (keterampilan praktis) untuk meningkatkan nilai tawar tenaga kerja lokal.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="font-bold text-gray-800 shrink-0">3.</span>
                            <span><span class="font-bold text-gray-800">Pemberdayaan Ekonomi Perempuan:</span> Mengingat <span class="font-bold text-gray-800">1.534 perempuan</span> adalah pengurus rumah tangga, program UMKM berbasis rumah tangga (seperti kerajinan atau pengolahan pangan) sangat krusial untuk meningkatkan kemandirian ekonomi perempuan.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="font-bold text-gray-800 shrink-0">4.</span>
                            <span><span class="font-bold text-gray-800">Optimalisasi Wajib Belajar:</span> Menginisiasi program pendampingan bagi <span class="font-bold text-gray-800">1.223 jiwa</span> yang belum sekolah untuk masuk ke program Kejar Paket agar standar pendidikan desa meningkat.</span>
                        </li>
                    </ol>
                </div>

                <hr class="my-8 border-gray-100">

                <div class="mb-4">
                    <h2 class="mb-4 text-3xl font-bold text-blue-600">6. Prioritas Intervensi</h2>
                    <p class="mb-4 text-base font-bold text-gray-800">Prioritas Utama: Pemutahkiran Data (Data Cleaning)</p>

                    <ul class="pl-0 space-y-4 text-base leading-relaxed text-gray-600 list-none">
                        <li class="flex items-start gap-2">
                            <span class="font-bold text-gray-800 shrink-0">•</span>
                            <span><span class="font-bold text-gray-800">Alasan:</span> Anda tidak dapat mengelola apa yang tidak dapat Anda ukur. Tanpa data pekerjaan yang valid, setiap kebijakan ekonomi yang diambil akan bersifat asumtif dan berisiko salah sasaran (misal: pemberian bantuan sosial atau bantuan alat usaha). Pemutahkiran data ini harus diselesaikan dalam <span class="font-bold text-gray-800">3 bulan ke depan</span> sebagai fondasi bagi semua program strategis lainnya.</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>


    @push('scripts')
    <script>
    </script>
    @endpush
</x-layouts.dashboard>
