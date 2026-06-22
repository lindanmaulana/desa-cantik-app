# 📊 Dokumentasi Sistem & Alur Data Modul Statistik Ekonomi

### Aplikasi Desa Cantik — Desa Sukaraja

Dokumen ini menjelaskan arsitektur terintegrasi, validasi data, logika bisnis agregasi, hingga mekanisme rendering UI pada modul Statistik Ekonomi.

---

## 🏗️ 1. Arsitektur Komponen (Architecture Overview)

Modul ini dibangun menggunakan prinsip **Modular Component-Based Architecture** dengan memisahkan tanggung jawab di setiap lapisannya (_Separation of Concerns_):

- **Request Layer** ➔ `App\Http\Requests\Statistics\EconomicRequest`
- **Controller Layer** ➔ `App\Http\Controllers\Dashboard\Statistics\EconomicController`
- **Business Logic** ➔ `App\Services\Statistics\EconomicService`
- **Domain Meta-Data** ➔ `App\Enums\EconomicType`
- **View Layer (Main)** ➔ `resources/views/dashboard/statistics/economic/index.blade.php`
- **View Partials** ➔ `partials/` (header, stats-card, filter-aggregate, chart, tables)

---

---

## 🔄 2. Alur Kerja Data End-to-End (Data Pipeline Lifecycle)

Proses pengolahan data terbagi menjadi 3 fase utama saat pengguna berinteraksi dengan dashboard:

### Kategori A: Gerbang Validasi HTTP (Request)

1. Pengguna membuka halaman atau mengubah filter wilayah (RW/RT) dan kategori ekonomi.
2. `EconomicRequest` mencegat request dan memastikan data aman:
    - Parameter `type` wajib selaras dengan opsi yang ada di `EconomicType` Enum via `Rule::enum()`.
    - Parameter `rw` disaring ketat (maksimal 5 karakter string).

### Kategori B: Agregasi Tingkat Database (Service Logic)

1. `EconomicController` menangkap request yang valid dan meneruskannya ke `EconomicService`.
2. Di dalam `EconomicService`, fungsi dinamis `queryEconomicData()` mendeteksi asal tabel melalui parameter `$tableAlias`:
    - **Profil Individu** (`employment_profiles`): Langsung di-_join_ menggunakan `citizen_id`.
    - **Profil Rumah Tangga** (`housing_profiles`): Di-_join_ bertahap melewati jembatan `family_id` pada model `Family` untuk **mencegah penggandaan hitung (_overcounting_)**.
3. Database mengeksekusi teknik **Cross-Tabulation Pivot** menggunakan ekspresi SQL mentah:
   $$\text{SUM(CASE WHEN citizens.gender = 'male' AND tabel.kolom = 'kunci' THEN 1 ELSE 0 END)}$$
4. Hasil query dikelompokkan berdasarkan wilayah (`groupBy('rw', 'rt')`) dan dikembalikan dalam bentuk struktur array matriks gender berpasangan.

### Kategori C: Distribusi & Transisi UI (Frontend Reactive)

1. Controller menerima data dari Service, lalu memformat data agregat desa (`tableAggregateVillageData`) dan data spasial (`tableAggregateTerritoryData`) lengkap dengan kalkulasi persentase dan penanda `is_first` untuk kebutuhan `rowspan`.
2. File utama `index.blade.php` mendeteksi parameter URL melalui Alpine.js:
    ```alpine
    x-data="{ isGenerated: new URLSearchParams(window.location.search).has('type') }"
    ```

### 🔄 Kondisi Perubahan State UI (Kategori C - Lanjutan)

- **Jika parameter `type` kosong (Awal Sesi)**:
    - `header.blade.php` menampilkan _Empty State_ dengan bingkai putus-putus (_dashed border_).
    - Seluruh komponen data otomatis disembunyikan menggunakan direktif `x-show="isGenerated"` dan dikunci oleh `x-cloak` untuk mencegah kedipan layar (_layout flashing_).

- **Jika parameter `type` tersedia (User klik Generate / Filter)**:
    - _Empty State_ menghilang ke arah atas secara halus dengan memanfaatkan transisi `x-transition:leave`.
    - Wadah data utama muncul dari bawah dengan efek _fade-in vertical push_ berdurasi 500ms (`duration-500 delay-200`).
    - Komponen `<x-cards.chart-card>` membaca variabel `$chartType` dari backend untuk memutuskan secara otomatis apakah akan memanggil fungsi `renderBarChart()` atau `renderDonutChart()`

## 🗃️ 3. Cetak Biru Komponen Parsial & Distribusi Variabel

Berikut adalah pemetaan variabel backend yang dikonsumsi oleh masing-masing komponen parsial di dalam folder `dashboard/statistics/economic/partials/`:
| File Parsial (Blade Component) | Variabel Backend Utama | Fungsi & Dampak Reactive UI |
| :--- | :--- | :--- |
| `header.blade.php` | Kontrol `!isGenerated` | Mengatur pemicu awal kalkulasi (_trigger aggregate button_) dan animasi transisi keluar (_leave transition_). |
| `stats-card.blade.php` | `$stats` (Object) | Menampilkan 4 indikator makro finansial desa dengan pengaman operator null-safe (`?->`). |
| `filter-aggregate.blade.php` | `$currentType` (Enum Case) | Menghasilkan tombol navigasi kategori secara dinamis lengkap dengan ikon RemixIcon terikat. |
| `chart.blade.php` | `$chartData`, `$chartLabels`, `$chartType` | Inisialisasi enkapsulasi `Alpine.data()` untuk me-render grafik Bar/Donut ApexCharts yang adaptif. |
| `table-aggregate-village.blade.php`| `$tableAggregateVillageData` | Merender rekapitulasi angka mutlak desa menggunakan teknik _safe casting_ `{{ Js::from() }}` ke Alpine. |
| `table-aggregate-territory.blade.php`| `$tableAggregateTerritoryData`, `$territories` | Memproduksi tabel rincian spasial ber-`rowspan` rapi dan dropdown filter RW/RT tanpa duplikasi (`unique`). |

---

## 📂 4. Kamus Matriks Indikator Domain (Domain Enum Cases Mapping)

Sub-bab ini mendefinisikan seluruh variasi data statistik yang didukung oleh sistem. AI Agent wajib merujuk pada daftar `Enum Cases` di bawah ini saat membuat query database, memetakan ikon filter, maupun menghasilkan label grafik pada masing-masing modul:

### 👥 A. Modul Statistik Demografi (`App\Enums\DemographicType`)
Digunakan untuk mengagregasikan data dasar kependudukan individu secara spasial:
* `AGE_GROUP` ➔ Kelompok Umur (Balita, Anak, Produktif, Lansia).
* `MARITAL_STATUS` ➔ Status Perkawinan (Belum Kawin, Kawin, Cerai Hidup, Cerai Mati).
* `RELIGION` ➔ Agama / Kepercayaan.
* `EDUCATION_LEVEL` ➔ Pendidikan Terakhir yang Ditempuh.
* `BLOOD_TYPE` ➔ Golongan Darah (A, B, AB, O).

### 📊 B. Modul Statistik Ekonomi (`App\Enums\EconomicType`)
Digunakan untuk mengukur indikator finansial, pekerjaan individu, serta kelayakan fasilitas rumah tangga:
* `OCCUPATION` ➔ Jenis Pekerjaan Utama Warga.
* `JOB_SECTOR` ➔ Sektor Bidang Usaha Pekerjaan.
* `EMPLOYMENT_STATUS` ➔ Status Hubungan Kerja (Tetap, Kontrak, Serabutan).
* `ECONOMIC_STATUS` ➔ Status Kesejahteraan / Tingkat Finansial.
* `HOUSE_OWNERSHIP` ➔ Status Kepemilikan Bangunan Tempat Tinggal.
* `FLOOR_MATERIAL` ➔ Bahan Utama Lantai Rumah.
* `WALL_MATERIAL` ➔ Bahan Utama Dinding Rumah.
* `ROOF_MATERIAL` ➔ Bahan Utama Atap Rumah.
* `COOKING_FUEL` ➔ Bahan Bakar Utama untuk Memasak.
* `ELECTRICITY_SOURCE` ➔ Sumber Penerangan Utama Rumah Tangga.
* `ELECTRICITY_CAPACITY` ➔ Daya Listrik Terpasang (VA).

### 🏪 C. Modul Statistik UMKM & Usaha Desa (`App\Enums\UmkmType`)
Digunakan untuk pemetaan potensi ekonomi, digitalisasi, serta klasterisasi usaha mikro di tingkat desa berdasarkan indikator pada UI:
* `BUSINESS_SECTOR` ➔ Sektor Usaha (Kuliner, Pertanian, Jasa, dll).
* `OWNER_AGE` ➔ Usia Pemilik Usaha.
* `OWNER_EDUCATION` ➔ Pendidikan Pemilik Usaha.
* `BUSINESS_LOCATION` ➔ Lokasi Tempat Usaha.
* `LEGAL_STATUS` ➔ Badan Hukum Usaha.
* `NIB_OWNERSHIP` ➔ Kepemilikan NIB (Nomor Induk Berusaha).
* `MONTHLY_TURNOVER` ➔ Omzet / Bulan.
* `DIGITAL_TRANSACTION` ➔ Transaksi Digital (QRIS, E-Wallet).
* `DIGITAL_PLATFORM` ➔ Penggunaan Platform Digital (E-Commerce, Sosmed).
* `CAPITAL_SOURCE` ➔ Sumber Modal Usaha.
* `ECO_FRIENDLY` ➔ Ramah Lingkungan (Sistem Pengelolaan Limbah Usaha).
* `BUMDES_PARTNERSHIP` ➔ Kemitraan dengan BUM Desa.

## ⚠️ 4. Regulasi Pemeliharaan Kode (Developer Guardrails)

- **Skema Penambahan Menu Baru**:  
  Jika di kemudian hari ada indikator ekonomi baru (misalnya: _Sumber Air Bersih_ atau _Kepemilikan Lahan_), pengembang cukup menambahkan kasus baru di dalam `App\Enums\EconomicType` dan memetakan ikonnya di `filter-aggregate.blade.php`. Lapisan JavaScript Grafik (`chart.blade.php`) **tidak perlu diubah sama sekali** karena sudah bersifat adaptif mendeteksi bentuk chart dari backend.

- **Keterikatan Urutan Array Data**:  
  Data kuantitatif di dalam array `male` dan `female` sangat bergantung pada urutan opsi kategori yang didefinisikan pada Enum. Dilarang melakukan manipulasi pengurutan acak (_sorting_) secara sepihak di JavaScript frontend karena dapat merusak validitas data grafik terhadap labelnya.

- **Penyelamatan State Filter Spasial**:  
  Form filter spasial di tingkat wilayah wajib mempertahankan parameter tipe ekonomi yang sedang aktif menggunakan loop input tersembunyi (`request()->except(...)`). Hal ini memastikan pengalaman eksplorasi data pengguna tidak terputus saat berganti lingkungan RW/RT.

- **Siklus Inisialisasi Script**:  
  Seluruh komponen JavaScript berbasis Alpine.js wajib dibungkus di dalam event listener `document.addEventListener("alpine:init", ...)` dan dilindungi oleh flag pengecekan window (misal: `window.economicTableComponentInitialized`). Ini mutlak diperlukan untuk mencegah eror _race condition_ atau registrasi ganda komponen saat terjadi pemuatan ulang parsial.

## 📑 5. Lampiran Contoh Kode Komponen (Code Blueprints) Backend

Bab ini menyediakan acuan struktur data (kontrak data) dan cuplikan inisialisasi kode bagi AI Agent untuk mempercepat replikasi modul.

### 📐 A. Kontrak Format Array Data (Tingkat Desa)

Gunakan struktur skema JSON/Array PHP berikut saat memberikan suplai data ke komponen `table-aggregate-village`:

```json
{
    "maleTotal": 1420,
    "femaleTotal": 1380,
    "total": 2800,
    "data": [
        {
            "category": "Karyawan Swasta",
            "male": 450,
            "female": 210,
            "total": 660,
            "percent": "23.57"
        }
    ]
}
```

### 🎛️ B. Cetak Biru Inisialisasi Alpine.js (Chart & Table)

Setiap kali membuat komponen tabel atau grafik baru yang berjalan di atas siklus hidup Alpine, gunakan pola enkapsulasi pelindung ganda di dalam event listener `alpine:init` untuk menjamin stabilitas performa:

```html
@push('scripts')
<script>
    document.addEventListener("alpine:init", () => {
        // Guardrail: Cegah registrasi ganda jika partial dimuat berulang
        if (!window.myComponentInitialized) {
            Alpine.data("myComponent", (id, rawData) => ({
                id: id,
                data: rawData,
                init() {
                    this.$nextTick(() => {
                        // Manipulasi DOM aman setelah elemen ter-render sempurna
                        console.log(`⚡ Component ${this.id} Ready`);
                    });
                },
            }));
            window.myComponentInitialized = true;
        }
    });
</script>
@endpush
```

### 🛡️ C. Cetak Biru Validasi HTTP (Request Blueprint)

Acuan bagi Agent saat membuat validasi form filter dinamis di tingkat HTTP Request:

```php
namespace App\Http\Requests\Statistics;

use App\Enums\EconomicType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EconomicRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['nullable', Rule::enum(EconomicType::class)],
            'rw'   => ['nullable', 'string', 'max:5'],
            'rt'   => ['nullable', 'string', 'max:5'],
        ];
    }
}
```

### 🧠 D. Cetak Biru Logika Agregasi Spasial (Service Query Blueprint)

Pola standardisasi query database menggunakan teknik _Cross-Tabulation SQL Pivot_ dan _Null-Safe formatting_ di lapisan Service:

```php
namespace App\Services\Statistics;

use Illuminate\Support\Facades\DB;

class EconomicService
{
    public function queryEconomicData(string $column, string $tableAlias, array $filters = []): array
    {
        $query = DB::table('citizens')
            ->join('territories', 'citizens.territory_id', '=', 'territories.id');

        // Proteksi Overcounting untuk Profil Rumah Tangga
        if ($tableAlias === 'housing_profiles') {
            $query->join('families', 'citizens.family_id', '=', 'families.id')
                  ->join('housing_profiles', 'families.id', '=', 'housing_profiles.family_id');
        } else {
            $query->join('employment_profiles', 'citizens.id', '=', 'employment_profiles.citizen_id');
        }

        // Eksekusi Pivot Matrix Gender
        return $query->select([
            'territories.rw',
            'territories.rt',
            DB::raw("SUM(CASE WHEN citizens.gender = 'male' THEN 1 ELSE 0 END) as male_count"),
            DB::raw("SUM(CASE WHEN citizens.gender = 'female' THEN 1 ELSE 0 END) as female_count")
        ])
        ->when($filters['rw'] ?? null, fn($q, $rw) => $q->where('territories.rw', $rw))
        ->groupBy('territories.rw', 'territories.rt')
        ->get()
        ->toArray();
    }
}
```

### 🧠 D. Cetak Biru Logika Agregasi Spasial (Service Query Blueprint)

Pola standardisasi query database menggunakan teknik _Cross-Tabulation SQL Pivot_ dan _Null-Safe formatting_ di lapisan Service:

```php
namespace App\Services\Statistics;

use Illuminate\Support\Facades\DB;

class EconomicService
{
    public function queryEconomicData(string $column, string $tableAlias, array $filters = []): array
    {
        $query = DB::table('citizens')
            ->join('territories', 'citizens.territory_id', '=', 'territories.id');

        // Proteksi Overcounting untuk Profil Rumah Tangga
        if ($tableAlias === 'housing_profiles') {
            $query->join('families', 'citizens.family_id', '=', 'families.id')
                  ->join('housing_profiles', 'families.id', '=', 'housing_profiles.family_id');
        } else {
            $query->join('employment_profiles', 'citizens.id', '=', 'employment_profiles.citizen_id');
        }

        // Eksekusi Pivot Matrix Gender
        return $query->select([
            'territories.rw',
            'territories.rt',
            DB::raw("SUM(CASE WHEN citizens.gender = 'male' THEN 1 ELSE 0 END) as male_count"),
            DB::raw("SUM(CASE WHEN citizens.gender = 'female' THEN 1 ELSE 0 END) as female_count")
        ])
        ->when($filters['rw'] ?? null, fn($q, $rw) => $q->where('territories.rw', $rw))
        ->groupBy('territories.rw', 'territories.rt')
        ->get()
        ->toArray();
    }
}
```

### 🎚️ E. Cetak Biru Orkestrasi Data (Controller Blueprint)

Pola interaksi Controller dalam menjembatani Service, Enum, dan memformat payload akhir sebelum diteruskan ke UI Blade:

```php
namespace App\Http\Controllers\Dashboard\Statistics;

use App\Http\Controllers\Controller;
use App\Http\Requests\Statistics\EconomicRequest;
use App\Enums\EconomicType;
use App\Services\Statistics\EconomicService;

class EconomicController extends Controller
{
    public function __invoke(EconomicRequest $request, EconomicService $service)
    {
        // 1. Resolve State dari Enum & Request
        $currentType = EconomicType::from($request->input('type', EconomicType::OCCUPATION->value));

        // 2. Tarik Data via Service
        $rawTerritoryData = $service->queryEconomicData($currentType->value, $currentType->table(), $request->validated());

        // 3. Format Payload untuk Blade Partials
        $tableAggregateTerritoryData = $service->formatSpasialRowspan($rawTerritoryData);
        $tableAggregateVillageData = $service->formatDesaAccumulation($rawTerritoryData);

        return view('dashboard.statistics.economic.index', [
            'currentType'                 => $currentType,
            'chartType'                   => $currentType->chartType(),
            'tableAggregateTerritoryData' => $tableAggregateTerritoryData,
            'tableAggregateVillageData'   => $tableAggregateVillageData,
            'stats'                       => $service->getEconomicStats(),
            'territories'                 => \App\Models\Territory::all(),
        ]);
    }
}
```

## 📑 6. Lampiran Contoh Kode Komponen (Code Blueprints) Frontend

Bab ini menyediakan acuan struktur data (kontrak data) dan cuplikan inisialisasi kode bagi AI Agent untuk mempercepat replikasi modul pada lapisan UI.

### 🎴 A. Cetak Biru Komposisi Blade Induk (Main Layout Blueprint)

Acuan pola tata letak (_layout grid_), urutan pemuatan komponen parsial, dan pengikatan (_binding_) state Alpine.js pada file utama halaman indeks statistik:

```html
{{-- resources/views/dashboard/statistics/economic/index.blade.php --}}
<x-layouts.dashboard-layout>
    {{-- Inisialisasi State Global Dashboard via URL Query Parameter --}}
    <div
        x-data="{ 
        isGenerated: new URLSearchParams(window.location.search).has('type'),
        currentType: '{{ request('type') }}'
    }"
        class="container px-4 py-6 mx-auto"
    >
        {{-- 1. Bagian Banner Header & Tombol Trigger Awal --}}
        @include('dashboard.statistics.economic.partials.header') {{-- Container
        Utama: Hanya Render Konten jika State isGenerated = True --}}
        <div
            x-show="isGenerated"
            x-cloak
            x-transition:enter="transition ease-out duration-500 delay-200"
            x-transition:enter-start="opacity-0 translate-y-8"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="space-y-6 sm:space-y-8"
        >
            {{-- 2. Baris Ringkasan Indikator Makro (Stat Cards) --}}
            @include('dashboard.statistics.economic.partials.stats-card') {{--
            3. Baris Filter Navigasi Kategori Ekonomi --}}
            @include('dashboard.statistics.economic.partials.filter-aggregate')
            {{-- 4. Layout Grid Split: Grafik (Kiri) & Tabel Desa (Kanan) --}}
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                <div class="lg:col-span-2">
                    @include('dashboard.statistics.economic.partials.chart')
                </div>
                <div class="lg:col-span-1">
                    @include('dashboard.statistics.economic.partials.table-aggregate-village')
                </div>
            </div>

            {{-- 5. Baris Tabel Break-down Spasial (Wilayah RW/RT) --}}
            <div class="w-full">
                @include('dashboard.statistics.economic.partials.table-aggregate-territory')
            </div>
        </div>
    </div>
</x-layouts.dashboard-layout>
```

### 📐 B. Kontrak Format Array Data (Tingkat Desa)

Acuan skema struktur data objek JSON / Array PHP yang wajib dipasok oleh Backend Controller agar bisa dikonsumsi secara aman oleh komponen reaktif seperti grafik dan tabel akumulasi:

```json
{
    "maleTotal": 1420,
    "femaleTotal": 1380,
    "total": 2800,
    "data": [
        {
            "category": "Karyawan Swasta",
            "male": 450,
            "female": 210,
            "total": 660,
            "percent": "23.57"
        },
        {
            "category": "Petani / Pekebun",
            "male": 620,
            "female": 180,
            "total": 800,
            "percent": "28.57"
        }
    ]
}
```

### 🎛️ C. Cetak Biru Inisialisasi Alpine.js (Reactive Script Pattern)

Setiap kali mereplikasi komponen grafik atau tabel interaktif baru yang berjalan di atas siklus hidup Alpine.js, gunakan pola enkapsulasi pelindung ganda di dalam event listener `alpine:init` untuk menjamin stabilitas performa dan mencegah kebocoran memori (_memory leak_):

```html
@push('scripts')
<script>
    document.addEventListener("alpine:init", () => {
        // Guardrail: Cegah registrasi ulang jika partial dimuat berkali-kali dalam satu siklus DOM
        if (!window.economicComponentInitialized) {
            Alpine.data("economicTableComponent", (id, rawData) => ({
                tableId: id,
                tableData: rawData,

                init() {
                    this.initTable();
                },

                initTable() {
                    this.$nextTick(() => {
                        // Memastikan manipulasi DOM dieksekusi setelah render HTML selesai sempurna
                        const element = document.querySelector(
                            `#${this.tableId}`,
                        );
                        if (!element) return;

                        console.log(
                            `⚡ Komponen UI [${this.tableId}] berhasil diinisialisasi.`,
                        );
                    });
                },
            }));
            window.economicComponentInitialized = true;
        }
    });
</script>
@endpush
```

### 🧱 D. Cetak Biru Komponen Parsial Utama (Partials Blueprints)

Acuan bagi Agent untuk memahami struktur internal komponen parsial mikro yang dipanggil oleh layout induk:

#### 1. Ringkasan Indikator Makro (`partials/stats-card.blade.php`)

Pola pembuatan kartu statistik yang adaptif menggunakan operator _null-safe_ PHP untuk mengamankan data makro finansial:

```html
<div
    class="grid grid-cols-1 gap-4 p-6 max-md:p-3 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 bg-gray-50"
>
    <x-cards.stat-card-second
        title="Warga Bekerja"
        :value="number_format($stats->total_employed, 0, ',', '.')"
        icon="ionicon-briefcase-sharp"
        color="bg-primary text-white"
    />

    <x-cards.stat-card-second
        title="Pengangguran Aktif"
        :value="number_format($stats->total_unemployed, 0, ',', '.')"
        icon="ionicon-alert-circle-sharp"
        color="bg-amber-500 text-white"
    />

    <x-cards.stat-card-second
        title="Keluarga Rumah Sendiri"
        :value="number_format($stats->total_self_owned_houses, 0, ',', '.')"
        icon="ionicon-home-sharp"
        color="bg-[#6366f1] text-white"
    />

    <x-cards.stat-card-second
        title="Penerima Bansos"
        :value="number_format($stats->total_welfare_recipients, 0, ',', '.')"
        icon="ionicon-gift-sharp"
        color="bg-emerald-600 text-white"
    />
</div>
```

#### 2. Tombol Navigasi Kategori (`partials/filter-aggregate.blade.php`)

Pola tombol filter dinamis yang otomatis menyesuaikan status aktif berdasarkan Enum Case yang dikirim dari backend:

```html
<div class="p-8 bg-white border border-gray-100 shadow-sm rounded-3xl">
    <h3 class="mb-6 text-xs font-bold tracking-widest text-gray-400 uppercase">
        Pilih Jenis Agregat Ekonomi
    </h3>

    <div class="flex flex-wrap gap-3">
        @foreach($economicType::cases() as $type) @php $icon = match($type) {
        $economicType::OCCUPATION => 'ri-briefcase-line',
        $economicType::JOB_SECTOR => 'ri-settings-3-line',
        $economicType::EMPLOYMENT_STATUS => 'ri-user-shared-line',
        $economicType::HOUSE_OWNERSHIP => 'ri-home-4-line',
        $economicType::FLOOR_MATERIAL => 'ri-grid-line',
        $economicType::WALL_MATERIAL => 'ri-building-line',
        $economicType::ROOF_MATERIAL => 'ri-home-gear-line',
        $economicType::COOKING_FUEL => 'ri-fire-line',
        $economicType::ELECTRICITY_SOURCE => 'ri-flashlight-line',
        $economicType::ELECTRICITY_CAPACITY => 'ri-flashlight-line',
        $economicType::ECONOMIC_STATUS => 'ri-line-chart-line', }; @endphp

        <a
            href="{{ route('dashboard.statistics.economic', ['type' => $type->value, 'rw' => request('rw'), 'rt' => request('rt')]) }}"
            class="max-md:w-full"
        >
            <x-buttons.filter-button
                :icon="$icon"
                :active="request('type') === $type->value || (!request('type') && $type === $economicType::OCCUPATION)"
                class="justify-center text-xs max-md:w-full sm:text-sm"
            >
                {{ $type->title() }}
            </x-buttons.filter-button>
        </a>
        @endforeach
    </div>
</div>
```

#### 3. Grafik Interaktif (`partials/chart.blade.php`)

Enkapsulasi ApexCharts di dalam siklus hidup Alpine.js yang otomatis mendeteksi konfigurasi grafik (Bar / Donut) langsung dari backend:

```html
<x-cards.chart-card
    id="chart-economic"
    :title="$currentType->labels() ? $currentType->title() : 'Statistik Ekonomi Tematik'"
    :subtitle="ucfirst(str_replace('_', ' ', $currentType->title())) . ' — Data Agregat Kelurahan'"
    :chart-data="$chartData"
    :chart-labels="$chartLabels"
    :chart-type="$chartType"
    :req-type="request('type')"
/>

@push('scripts')
<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data("chartComponent", (id, chartType, data, labels) => ({
            chartId: id,
            chartData: data,
            chartLabels: labels,

            reqType: "{{ request('type') }}",
            reqRw: "{{ request('rw') }}",

            initChart() {
                this.$nextTick(() => {
                    const element = document.querySelector(`#${this.chartId}`);
                    if (!element) return;

                    const economicType = window.economicType || {};
                    let options = {};

                    const isChartEmpty = this.chartData.every(
                        (val) => val === 0,
                    );

                    switch (this.reqType) {
                        // Kelompok Jenis Chart BAR (Kategori Berderet)
                        case economicType.employmentStatus:
                        case economicType.incomeRange:
                        case economicType.businessSector:
                        case economicType.msmeCategory:
                        case economicType.landOwnership:
                            options = {
                                series: [
                                    {
                                        name: "Total KK / Warga",
                                        data: this.chartData,
                                    },
                                ],
                                colors:
                                    window.AppColors.economicPalette ||
                                    window.AppColors.chartPalette,
                                xaxis: {
                                    categories: this.chartLabels,
                                },
                            };
                            break;

                        // Kelompok Jenis Chart DONUT / PIE (Proporsi Tunggal)
                        case economicType.productiveAgeEmployment:
                        case economicType.msmeLegality:
                        case economicType.welfareStatus:
                        case economicType.electricitySource:
                        case economicType.electricityCapacity:
                            options = {
                                series: this.chartData,
                                colors:
                                    window.AppColors.economicPalette ||
                                    window.AppColors.chartPalette,
                                xaxis: this.chartLabels,
                            };
                            break;

                        default:
                            options = {
                                series: [
                                    {
                                        name: "Total",
                                        data: this.chartData,
                                    },
                                ],
                                colors:
                                    window.AppColors.economicPalette ||
                                    window.AppColors.chartPalette,
                                xaxis: {
                                    categories: this.chartLabels,
                                },
                            };
                    }

                    window.ChartOptions = options;

                    switch (chartType) {
                        case "bar":
                            renderBarChart(element, window.ChartOptions);
                            break;
                        case "donut":
                            renderDonutChart(
                                element,
                                this.chartData,
                                window.ChartOptions,
                            );
                            break;
                    }
                });
            },
        }));
    });
</script>
@endpush
```

#### 4. Tabel Akumulasi Tingkat Desa (`partials/table-aggregate-village.blade.php`)

Pola komponen tabel rekapitulasi desa yang mengonsumsi data agregat mentah dari backend dengan teknik _safe casting_ `@js()` agar siap dipetakan secara dinamis menggunakan perulangan direktif `x-for` milik Alpine.js:

```html
@if(request('type'))
<div
    x-data="economicTableComponent('table-village-economic', {{ Js::from($tableAggregateVillageData) }})"
    x-init="initTable()"
    class="p-4 space-y-4 bg-white border border-gray-100 shadow-sm sm:p-6 rounded-2xl sm:rounded-3xl"
>
    <div class="pb-2 border-b border-gray-50">
        <h3
            class="text-[10px] sm:text-xs font-bold tracking-widest text-emerald-600 uppercase"
        >
            Agregat Ekonomi Tingkat Desa
        </h3>
    </div>

    <x-tables.aggregate-village-table
        id="table-village-economic"
        :data-table="$tableAggregateVillageData"
        :req-type="request('type')"
    />
</div>
@else {{-- Placeholder State saat User belum memilih jenis agregat ekonomi di
tombol atas --}}
<div
    class="w-full h-[400px] flex flex-col items-center justify-center text-gray-400 bg-white border border-gray-100 shadow-sm rounded-3xl italic gap-4"
>
    <x-tabler-chart-arcs class="size-20 text-emerald-500/40" />
    <div class="text-sm not-italic font-medium text-gray-500">
        Pilih Kategori Indikator Ekonomi di atas.
    </div>
</div>
@endif @push('scripts')
<script>
    if (!window.economicTableComponentInitialized) {
        document.addEventListener("alpine:init", () => {
            Alpine.data("economicTableComponent", (id, dataTable) => ({
                tableId: id,
                tableData: dataTable,

                initTable() {
                    this.$nextTick(() => {
                        const element = document.querySelector(
                            `#${this.tableId}`,
                        );
                        if (!element) return;

                        console.log(
                            `⚡ Tabel Ekonomi [${this.tableId}] berhasil diinisialisasi.`,
                        );
                    });
                },
            }));
        });
        window.economicTableComponentInitialized = true;
    }
</script>
@endpush
```

#### 5. Tabel Spasial Wilayah (`partials/table-aggregate-territory.blade.php`)

Pola integrasi form filter wilayah dinamis (RW/RT dropdown) yang mengunci state kategori agar pengalaman penelusuran pengguna tetap terjaga:

```html
<div class="p-4 space-y-4 bg-white border border-gray-100 shadow-sm sm:p-6 rounded-2xl sm:rounded-3xl">
    <div class="flex flex-col justify-between gap-3 pb-2 border-b sm:flex-row sm:items-center border-gray-50">
        <h3 class="text-[10px] sm:text-xs font-bold tracking-widest text-emerald-600 uppercase">
            Agregat Wilayah Ekonomi (RW / RT)
        </h3>

        <div class="flex flex-col w-full gap-2 sm:flex-row sm:w-auto">
            <div class="relative w-full sm:w-48">
                <form action="{{ request()->url() }}" method="GET" class="inline-block w-full" id="filter-economic-territory-form">
                    {{-- Pertahankan parameter type ekonomi yang sedang aktif --}}
                    @foreach(request()->except(['rw', 'rt']) as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach

                    <select name="rw" onchange="document.getElementById('filter-economic-territory-form').submit()"
                        class="appearance-none w-full bg-white border cursor-pointer border-emerald-200 text-emerald-900 text-xs sm:text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block p-2.5 pr-10 outline-none">

                        <option value="" {{ !request('rw') ? 'selected' : '' }}>
                            -- Pilih Dusun/RW --
                        </option>

                        @foreach($territories as $territory)
                        <option value="{{ $territory->rw }}" {{ request('rw') == $territory->rw ? 'selected' : '' }}>
                            {{ $territory->sub_village }} (RW {{ $territory->rw }})
                        </option>
                        @endforeach
                    </select>
                </form>
                <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-emerald-500">
                    <i class="ri-arrow-down-s-line"></i>
                </div>
            </div>

            {{-- Filter RT otomatis muncul jika RW sudah dipilih --}}
            @if(request('rw'))
            <div class="relative w-full sm:w-32">
                <select name="rt" form="filter-economic-territory-form" onchange="document.getElementById('filter-economic-territory-form').submit()"
                    class="appearance-none w-full bg-white border cursor-pointer border-emerald-200 text-emerald-900 text-xs sm:text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block p-2.5 pr-10 outline-none">
                    <option value="" {{ !request('rt') ? 'selected' : '' }}>-- Semua RT --</option>
                    @for($i = 1; $i <= 10; $i++)
                        @php $rtVal=str_pad($i, 3, '0' , STR_PAD_LEFT); @endphp
                        <option value="{{ $rtVal }}" {{ request('rt') == $rtVal ? 'selected' : '' }}>
                        RT {{ $rtVal }}
                        </option>
                        @endfor
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-emerald-500">
                    <i class="ri-arrow-down-s-line"></i>
                </div>
            </div>
            @endif
        </div>
    </div>

    {{-- Komponen Tabel Khusus Tematik/Ekonomi Wilayah --}}
    <x-tables.aggregate-territory-table
        id="table-rt-economic"
        :data-table="$tableAggregateTerritoryData" />
</div>

@push('scripts')
<script>
    if (!window.economicTerritoryComponentInitialized) {
        document.addEventListener("alpine:init", () => {
            Alpine.data("economicTerritoryTableComponent", (id, dataTable) => ({
                tableId: id,
                dataTable: dataTable,
                initTable() {
                    this.$nextTick(() => {
                        const element = document.querySelector(`#${this.tableId}`);
                        if (!element) return;
                        console.log(`⚡ Tabel Ekonomi Wilayah [${this.tableId}] siap.`);
                    });
                }
            }));
        });
        window.economicTerritoryComponentInitialized = true;
    }
</script>
@endpush
```
