<x-tables.aggregate-village-table
    id="table-village-demographics"
    :data-table="$tableAggregateVillageData"
    :req-type="request('type')" />

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
