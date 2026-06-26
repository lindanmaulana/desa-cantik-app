@if(request('type'))
<div x-data="economicTableComponent('table-village-economic', {{ Js::from($tableAggregateVillageData) }})"
    x-init="initTable()"
    class="p-4 space-y-4 bg-white border border-gray-100 shadow-sm sm:p-6 rounded-2xl sm:rounded-3xl">

    <div class="pb-2 border-b border-gray-50">
        <h3 class="text-[10px] sm:text-xs font-bold tracking-widest text-textSecondary uppercase">
            Agregat Ekonomi Tingkat Desa
        </h3>
    </div>

    <x-tables.aggregate-village-table
        id="table-village-economic"
        :data-table="$tableAggregateVillageData"
        :req-type="request('type')" />
</div>
@else
{{-- Placeholder State saat User belum memilih jenis agregat ekonomi di tombol atas --}}
<div class="w-full h-[400px] flex flex-col items-center justify-center text-gray-400 bg-white border border-gray-100 shadow-sm rounded-3xl italic gap-4">
    <x-tabler-chart-arcs class="size-20 text-emerald-500/40" />
    <div class="text-sm not-italic font-medium text-gray-500">Pilih Kategori Indikator Ekonomi di atas.</div>
</div>
@endif

@push('scripts')
<script>
    if (!window.economicTableComponentInitialized) {
        document.addEventListener("alpine:init", () => {
            Alpine.data("economicTableComponent", (id, dataTable) => ({
                tableId: id,
                tableData: dataTable,

                initTable() {
                    this.$nextTick(() => {
                        const element = document.querySelector(`#${this.tableId}`);
                        if (!element) return;

                        console.log(`⚡ Tabel Ekonomi [${this.tableId}] berhasil diinisialisasi.`);
                    });
                }
            }));
        });
        window.economicTableComponentInitialized = true;
    }
</script>
@endpush
