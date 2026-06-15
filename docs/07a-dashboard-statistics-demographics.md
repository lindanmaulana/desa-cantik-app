# Alur Pemetaan Statistik Demografi — Kelompok Umur (AGE_GROUP)

Dokumen ini menjelaskan spesifikasi teknis, arsitektur logika, alur eksekusi data, serta mekanisme rendering visual untuk statistik demografi tipe `AGE_GROUP` pada aplikasi **Desa Cantik**.

---

## 1. Arsitektur Alur Data

Proses dimulai dari permintaan pengguna di antarmuka web, dieksekusi melalui optimasi query database, ditransformasikan di controller, dan dirender menggunakan kombinasi Alpine.js serta ApexCharts.

```
[User Interface / Browser]
        │
        └──( Request ?type=ageGroup )──► [DemographController @index]
                                                    │
                                                    ▼
                        [DemographService @getAgeGroup]
                                    │
                                    └──( Query SQL Agregasi )──► [DB: citizens & families]
                                                                            │
                                                                            ▼
                                                    [DemographController @formatDemographicsData]
                                                                │
                                                ┌───────────────┼───────────────────┐
                                                ▼               ▼                   ▼
                                    resolveChartData()  resolveTableVillageData()  resolveTableTerritoryData()
                                    [Grafik L + P]      [Agregat Desa + Proporsi]  [Agregat RT/RW + Rowspan]
                                                │
                                                ▼
                                [Blade View: index.blade.php]
                                        │
                                        └──► [Hasil Visualisasi Dashboard]
```

---

## 2. Lapisan Basis Data & Layanan (`DemographService.php`)

Pola pengambilan data kelompok umur berfokus pada **efisiensi memori server** dengan memindahkan kalkulasi umur dan agregasi langsung ke mesin database MySQL menggunakan `SUM(CASE WHEN...)` dan `TIMESTAMPDIFF`.

### A. Parameter Kondisional Wilayah

Query mendukung penyaringan dinamis tingkat teritorial melalui `leftJoin` antara tabel `citizens`, `families`, dan `territories`. Jika parameter `rw` dikirimkan, data akan difilter khusus untuk wilayah RW tersebut.

### B. Aturan Segmentasi Umur

Umur dihitung secara real-time berdasarkan `CURDATE()` dikurangi kolom `birth_date`. Kategori dikelompokkan ke dalam 7 klaster:

| # | Kategori | Rentang Umur | Contoh SQL |
|---|----------|--------------|------------|
| 1 | Balita | 0 – 4 Tahun | `TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 0 AND 4` |
| 2 | Anak-Anak | 5 – 14 Tahun | `BETWEEN 5 AND 14` |
| 3 | Remaja | 15 – 24 Tahun | `BETWEEN 15 AND 24` |
| 4 | Dewasa Produktif | 25 – 54 Tahun | `BETWEEN 25 AND 54` |
| 5 | Pra Lansia | 55 – 64 Tahun | `BETWEEN 55 AND 64` |
| 6 | Lansia | 65+ Tahun | `>= 65` |
| 7 | Tidak Terpetakan | — | Fallback jika `birth_date` `NULL` atau gender tidak valid |

Setiap kondisi dipisah per gender dengan menambahkan `AND gender = '...'` pada klausa `CASE WHEN`.

### C. Format Output Struktur Array Service

```php
[
    'male'         => [366, 400, ...],  // Array per kategori umur (indeks 0–6), total desa
    'female'       => [353, 380, ...],  // Array per kategori umur (indeks 0–6), total desa
    'by_territory' => [
        [
            'label'     => 'RW 01 / RT 01',
            'territory' => ['rw' => '01', 'rt' => '01'],
            'male'      => [10, 15, ...],
            'female'    => [12, 14, ...],
        ],
        // ... record RT/RW berikutnya
    ],
]
```

---

## 3. Lapisan Pengendali (`DemographController.php`)

Controller mentransformasikan hasil query mentah dari Service menjadi tiga entitas fungsional: **Grafik**, **Tabel Desa**, dan **Tabel Teritorial**.

### A. Transformasi Data Grafik (`resolveChartData`)

Menghasilkan nilai gabungan absolut (agregat uniseks) untuk grafik batang.

- **Helper:** `combineGenderData($maleData, $femaleData)`
- **Mekanisme:** Iterasi berbasis indeks via `array_map`, menjumlahkan `(int)$maleCount + (int)$femaleCount`
- **Output:** Array linear satu dimensi, contoh: `[719, 780, 1200, 2500, 719, 777, 0]`

### B. Transformasi Tabel Tingkat Desa (`resolveTableVillageData`)

Menghitung proporsi dan sebaran penduduk makro di seluruh wilayah desa.

```php
$tableAggregateVillageData = [
    'maleTotal'   => (int) $totalSeluruhLakiLaki,
    'femaleTotal' => (int) $totalSeluruhPerempuan,
    'total'       => (int) $grandTotalJiwaDesa,
    'data'        => [
        [
            'category' => 'Pra Lansia (55-64)',
            'male'     => 366,
            'female'   => 353,
            'total'    => 719,
            'percent'  => 16.9, // round(($total / $grandTotal) * 100, 1)
        ],
        // ... baris kategori berikutnya
    ],
];
```

Persentase dihitung dengan `round(($totalKategori / $grandTotalDesa) * 100, 1)`.

### C. Transformasi Tabel Tingkat Teritorial (`resolveTableTerritoryData`)

Mengonversi data hierarkis dari Service menjadi flat array menggunakan nested looping.

**Alur proses:**

1. **Outer Loop** — Iterasi tiap blok wilayah di `by_territory`
2. **Kalkulasi Basis Wilayah** — `$totalWilayah = array_sum($territory['male']) + array_sum($territory['female'])`
3. **Inner Loop** — Iterasi per indeks kategori umur dari `$type->labels()`
4. **Flag `is_first`** — `true` hanya pada `$index === 0` setiap pergantian blok RT/RW, untuk mengontrol rowspan di HTML

```php
$tableAggregateTerritoryData = [
    [
        'rw'       => '01',
        'rt'       => '01',
        'category' => 'Balita (0-4)',
        'male'     => 10,
        'female'   => 12,
        'total'    => 22,
        'percent'  => 8.5,    // Proporsi terhadap total RT/RW tersebut
        'is_first' => true,   // Memicu pembukaan <td rowspan="7">
    ],
    [
        'rw'       => '01',
        'rt'       => '01',
        'category' => 'Anak-Anak (5-14)',
        // ...
        'is_first' => false,  // Blade melewati kolom RW & RT
    ],
    // ... baris berikutnya
];
```

---

## 4. Lapisan Antarmuka & Reaktivitas (Blade Views & Script)

Frontend memanfaatkan **Tailwind CSS** untuk visual, **Alpine.js** untuk state management, dan **ApexCharts** sebagai mesin grafik interaktif.

### A. State Management & Lazy Loading

State awal dikontrol via Alpine.js:

```js
x-data="{ isGenerated: new URLSearchParams(window.location.search).has('type') }"
```

Area grafik dan tabel menggunakan `x-show="isGenerated" x-cloak` dengan transisi:

```
x-transition:enter="transition ease-out duration-500 delay-200"
```

Hal ini mencegah area kosong atau flickering sebelum pengguna menekan tombol **Generate Aggregate**.

Filter navigasi mengirimkan rute statis:

```php
route('dashboard.statistics.demograph', ['type' => 'ageGroup'])
```

### B. Injeksi Token JavaScript

Controller menyuntikkan nilai Enum ke JavaScript via `@push('scripts')` untuk menghindari hardcoded strings:

```js
window.demographicsType = {
    ageGroup: "{!! \App\Enums\DemographicsType::AGE_GROUP->value !!}",
    gender:   "{!! \App\Enums\DemographicsType::GENDER->value !!}",
    // ... tipe lainnya
};
```

### C. Rendering Grafik (`chart.blade.php`)

Komponen grafik diinisialisasi via `Alpine.data('chartComponent', ...)`. Ketika tipe aktif cocok dengan `demographicsType.ageGroup`:

```js
options = {
    series: [{
        name: "Jumlah Total",
        data: this.chartData,       // Array linear gabungan L + P
    }],
    colors: window.AppColors.chartPalette,
    xaxis: {
        categories: this.chartLabels, // Label dinamis dari Enum labels()
    }
};
```

Grafik ditampilkan sebagai **bar chart vertikal** via `renderBarChart(element, window.ChartOptions)`.

### D. Rendering Tabel HTML

**Tabel Desa** (`table-aggregate-village.blade.php`):

```blade
<x-tables.aggregate-village-table :data-table="$tableAggregateVillageData" />
```

Progress bar proporsi dirender via Tailwind inline style:

```html
<div class="w-24 h-2 bg-gray-100 rounded-full">
    <div class="h-2 rounded-full bg-amber-400" style="width: {{ $row['percent'] }}%"></div>
</div>
```

**Tabel Teritorial** (`table-aggregate-territory.blade.php`):

Menyediakan filter dusun dinamis (`<select name="rw" onchange="this.form.submit()">`), dikirim ke:

```blade
<x-tables.aggregate-territory-table :data-table="$tableAggregateTerritoryData" />
```

Logika rowspan dikontrol via flag `is_first`:

```blade
@if($row['is_first'])
    <td class="px-6 py-4 font-bold text-center text-gray-700" rowspan="7">
        RW {{ $row['rw'] }}
    </td>
    <td class="px-6 py-4 font-bold text-center text-gray-700" rowspan="7">
        RT {{ $row['rt'] }}
    </td>
@endif
<td class="px-6 py-4">{{ $row['category'] }}</td>
<td class="px-6 py-4 text-center">{{ $row['male'] }}</td>
<td class="px-6 py-4 text-center">{{ $row['female'] }}</td>
<td class="px-6 py-4 font-bold text-center">{{ $row['total'] }}</td>
```

> **Catatan:** Nilai `rowspan="7"` disesuaikan absolut dengan jumlah item dari `Enum labels()`, memastikan sel tabel tergabung sempurna tanpa merusak baris di sebelahnya.
