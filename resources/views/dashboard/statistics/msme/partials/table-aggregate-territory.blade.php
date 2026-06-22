<div
    x-data="umkmTerritoryTableComponent('table-rt-umkm', {{ Js::from($tableAggregateTerritoryData) }})"
    x-init="initTable()"
    class="p-4 space-y-4 bg-white border border-gray-100 shadow-sm sm:p-6 rounded-2xl sm:rounded-3xl">
    <div class="flex flex-col justify-between gap-3 pb-2 border-b sm:flex-row sm:items-center border-gray-50">
        <h3 class="text-[10px] sm:text-xs font-bold tracking-widest text-emerald-600 uppercase">
            Agregat Wilayah UMKM (RW / RT)
        </h3>

        <div class="flex flex-col w-full gap-2 sm:flex-row sm:w-auto">
            <div class="relative w-full sm:w-48">
                <form action="{{ request()->url() }}" method="GET" class="inline-block w-full" id="filter-umkm-territory-form">
                    {{-- Pertahankan parameter type indikator UMKM yang sedang aktif --}}
                    @foreach(request()->except(['rw', 'rt']) as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach

                    <select name="rw" onchange="document.getElementById('filter-umkm-territory-form').submit()"
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
                <select name="rt" form="filter-umkm-territory-form" onchange="document.getElementById('filter-umkm-territory-form').submit()"
                    class="appearance-none w-full bg-white border cursor-pointer border-emerald-200 text-emerald-900 text-xs sm:text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block p-2.5 pr-10 outline-none">
                    <option value="" {{ !request('rt') ? 'selected' : '' }}>-- Semua RT --</option>
                    @for($i = 1; $i <= 12; $i++)
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

    {{-- Komponen Tabel Khusus Klasterisasi Spasial UMKM Wilayah --}}
    <x-tables.aggregate-territory-table
        id="table-rt-umkm"
        :data-table="$tableAggregateTerritoryData" />
</div>

@push('scripts')
<script>
    if (!window.msmeTerritoryComponentInitialized) {
        document.addEventListener("alpine:init", () => {
            Alpine.data("umkmTerritoryTableComponent", (id, dataTable) => ({
                tableId: id,
                dataTable: dataTable,
                initTable() {
                    this.$nextTick(() => {
                        const element = document.querySelector(`#${this.tableId}`);
                        if (!element) return;
                        console.log(`⚡ Tabel Distribusi Spasial UMKM Wilayah [${this.tableId}] siap.`);
                    });
                }
            }));
        });


        window.msmeTerritoryComponentInitialized = true;
    }
</script>
@endpush