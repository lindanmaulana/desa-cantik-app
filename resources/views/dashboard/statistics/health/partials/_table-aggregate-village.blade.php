@if(request('type'))
<div x-data="healthTableComponent('table-village-health', {{ Js::from($tableAggregateVillageData) }})"
    x-init="initTable()"
    class="p-4 space-y-4 bg-white border border-gray-100 shadow-sm sm:p-6 rounded-2xl sm:rounded-3xl">

    <div class="pb-2 border-b border-gray-50">
        <h3 class="text-[10px] sm:text-xs font-bold tracking-widest text-gray-400 uppercase">
            Agregat Tingkat Desa
        </h3>
    </div>

    {{-- Memanggil komponen tabel khusus untuk data kesehatan desa --}}
    <x-tables.aggregate-village-table
        id="table-village-health"
        :data-table="$tableAggregateVillageData"
        :req-type="request('type')" />
</div>
@else
{{-- Placeholder State saat User belum memilih jenis agregat kesehatan di tombol atas --}}
<div class="w-full h-[400px] flex flex-col items-center justify-center text-gray-400 bg-white border border-gray-100 shadow-sm rounded-3xl italic gap-4">
    <x-tabler-table-spark class="size-20" />
    <div>Pilih Kategori di atas.</div>
</div>
@endif

@push('scripts')
<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data("healthTableComponent", (id, dataTable) => ({
            tableId: id,
            tableData: dataTable,

            initTable() {
                const element = document.querySelector(`#${this.tableId}`);
                if (!element) return;

                console.log(`Tabel ${this.tableId} berhasil diinisialisasi.`);
            }
        }));
    });
</script>
@endpush