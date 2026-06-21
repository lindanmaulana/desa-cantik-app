@if (request('type'))
    <div x-data="tableComponent('table-village-demographics', {{ Js::from($tableAggregateVillageData) }})" x-init="initTable()"
        class="p-4 space-y-4 bg-white border border-gray-100 shadow-sm sm:p-6 rounded-2xl sm:rounded-3xl">
        <div class="pb-2 border-b border-gray-50">
            <h3 class="text-[10px] sm:text-xs font-bold tracking-widest text-gray-400 uppercase">Agregat Desa
            </h3>
        </div>

        <x-tables.aggregate-village-table id="table-village-demographics" :data-table="$tableAggregateVillageData" :req-type="request('type')" />
    </div>
@else
    <div
        class="w-full h-[400px] flex flex-col items-center justify-center text-gray-400 bg-white border border-gray-100 shadow-sm rounded-3xl italic gap-4">
        <x-tabler-table-spark class="size-20" />
        <div>Pilih Kategori di atas.</div>
    </div>
@endif

@push('scripts')
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("tableComponent", (id, dataTable) => ({
                tableId: id,
                dataTable: dataTable,

                initTable() {
                    const elemen = document.querySelector(`#${this.tableId}`);
                    if (!elemen) return;
                }
            }))
        })
    </script>
@endpush
