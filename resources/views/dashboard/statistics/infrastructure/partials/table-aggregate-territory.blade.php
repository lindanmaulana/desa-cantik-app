<div
    x-data="infrastructureTerritoryTableComponent('table-rt-infrastructure', {{ Js::from($tableAggregateTerritoryData) }})"
    x-init="initTable()"
    class="p-4 space-y-4 bg-white border border-gray-100 shadow-sm sm:p-6 rounded-2xl sm:rounded-3xl">
    <div class="flex flex-col justify-between gap-3 pb-2 border-b sm:flex-row sm:items-center border-gray-50">
        <h3 class="text-[10px] sm:text-xs font-bold tracking-widest text-blue-600 uppercase">
            Agregat Wilayah Infrastruktur (RW / RT)
        </h3>

        <div class="flex flex-col w-full gap-2 sm:flex-row sm:w-auto">
            <div class="relative w-full sm:w-48">
                <form action="{{ request()->url() }}" method="GET" class="inline-block w-full" id="filter-infrastructure-territory-form">
                    {{-- Pertahankan parameter type indikator Infrastruktur yang sedang aktif[cite: 1] --}}
                    @foreach(request()->except(['rw', 'rt']) as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach

                    <select name="rw" onchange="document.getElementById('filter-infrastructure-territory-form').submit()"
                        class="appearance-none w-full bg-white border cursor-pointer border-blue-200 text-blue-900 text-xs sm:text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-2.5 pr-10 outline-none">

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
                <div class="absolute inset-y-0 right-0 flex items-center px-3 text-blue-500 pointer-events-none">
                    <i class="ri-arrow-down-s-line"></i>
                </div>
            </div>

            {{-- Filter RT otomatis muncul jika RW sudah dipilih[cite: 1] --}}
            @if(request('rw'))
            <div class="relative w-full sm:w-32">
                <select name="rt" form="filter-infrastructure-territory-form" onchange="document.getElementById('filter-infrastructure-territory-form').submit()"
                    class="appearance-none w-full bg-white border cursor-pointer border-blue-200 text-blue-900 text-xs sm:text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-2.5 pr-10 outline-none">
                    <option value="" {{ !request('rt') ? 'selected' : '' }}>-- Semua RT --</option>
                    @for($i = 1; $i <= 12; $i++)
                        @php $rtVal=str_pad($i, 3, '0' , STR_PAD_LEFT); @endphp
                        <option value="{{ $rtVal }}" {{ request('rt') == $rtVal ? 'selected' : '' }}>
                        RT {{ $rtVal }}
                        </option>
                        @endfor
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center px-3 text-blue-500 pointer-events-none">
                    <i class="ri-arrow-down-s-line"></i>
                </div>
            </div>
            @endif
        </div>
    </div>

    {{-- Komponen Tabel Khusus Klasterisasi Spasial Infrastruktur Wilayah --}}
    <x-tables.aggregate-territory-table
        id="table-rt-infrastructure"
        :data-table="$tableAggregateTerritoryData" />
</div>

@push('scripts')
<script>
    if (!window.infrastructureTerritoryComponentInitialized) {
        document.addEventListener("alpine:init", () => {
            Alpine.data("infrastructureTerritoryTableComponent", (id, dataTable) => ({
                tableId: id,
                dataTable: dataTable,
                initTable() {
                    this.$nextTick(() => {
                        const element = document.querySelector(`#${this.tableId}`);
                        if (!element) return;
                        console.log(`⚡ Tabel Distribusi Spasial Infrastruktur Wilayah [${this.tableId}] siap.`);
                    });
                }
            }));
        });

        window.infrastructureTerritoryComponentInitialized = true;
    }
</script>
@endpush