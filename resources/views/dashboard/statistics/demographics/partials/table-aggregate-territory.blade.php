<div class="p-4 space-y-4 bg-secondary border border-textTertiary/30 shadow-sm sm:p-6 rounded-2xl sm:rounded-3xl">
    <div class="flex flex-col justify-between gap-3 pb-2 border-b sm:flex-row sm:items-center border-textTertiary/20">
        <h3 class="text-[10px] sm:text-xs font-bold tracking-widest text-textSecondary uppercase">Agregat RT</h3>

        <div class="relative w-full sm:w-48">
            <form action="{{ request()->url() }}" method="GET" class="inline-block w-full">
                @foreach (request()->except('rw') as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach

                <select name="rw" onchange="this.form.submit()"
                    class="appearance-none w-full bg-secondary border cursor-pointer border-textTertiary/40 text-textPrimary text-xs sm:text-sm rounded-xl focus:ring-1 focus:ring-primary focus:border-primary block p-2.5 pr-10 outline-none transition-all duration-300">
                    <option value="" class="cursor-pointer" {{ !request('rw') ? 'selected' : '' }}>
                        -- Pilih Dusun --
                    </option>

                    @foreach ($territories as $territory)
                        <option value="{{ $territory->rw }}" class="cursor-pointer"
                            {{ request('rw') == $territory->rw ? 'selected' : '' }}>
                            {{ $territory->sub_village }}
                        </option>
                    @endforeach
                </select>
            </form>

            <div class="absolute inset-y-0 right-0 flex items-center px-3 text-textSecondary pointer-events-none">
                <i class="ri-arrow-down-s-line"></i>
            </div>
        </div>
    </div>

    <x-tables.aggregate-territory-table id="table-rt-demographics" :data-table="$tableAggregateTerritoryData" />
</div>

@push('scripts')
    <script>
        document.addEventListener("alpine:init", () => {
            if (!Alpine.store('tableComponentRegistered')) {
                Alpine.data("tableComponent", (id, dataTable) => ({
                    tableId: id,
                    dataTable: dataTable,
                    initTable() {
                        const element = document.querySelector(`#${this.tableId}`);
                        if (!element) return;
                    }
                }));
                Alpine.store('tableComponentRegistered', true);
            }
        });
    </script>
@endpush
