<div
    x-data="infrastructureTerritoryTableComponent('table-rt-infrastructure', {{ Js::from($tableAggregateTerritoryData) }})"
    x-init="initTable()"
    class="p-4 space-y-4 bg-white border border-gray-100 shadow-sm sm:p-6 rounded-2xl sm:rounded-3xl">
    <div class="flex flex-col justify-between gap-3 pb-2 border-b sm:flex-row sm:items-center border-gray-50">
        <h3 class="text-[10px] sm:text-xs font-bold tracking-widest text-textSecondary uppercase">
            Agregat Wilayah Infrastruktur (RW / RT)
        </h3>

        <div class="flex flex-col w-full gap-2 sm:flex-row sm:w-auto">
            @if(request('rw') || request('rt'))
            <div class="flex justify-end w-full">
                <a href="{{ request()->fullUrlWithQuery(['rw' => null, 'rt' => null]) }}"
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-red-600 bg-red-50 hover:bg-red-100 rounded-lg border border-red-200 transition-all duration-200 shadow-sm">
                    <i class="text-sm ri-refresh-line"></i>
                    <span>Bersihkan Filter Wilayah</span>
                </a>
            </div>
            @endif
            <form action="{{ request()->url() }}" method="GET" class="flex flex-col w-full gap-2 sm:flex-row sm:w-auto" id="filter-territory-form">
                @foreach (request()->except(['rw', 'rt']) as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach

                <div class="relative w-full sm:w-48">
                    <select name="rw" onchange="this.form.submit()"
                        class="appearance-none w-full bg-secondary border cursor-pointer border-textTertiary/40 text-textPrimary text-xs sm:text-sm rounded-xl focus:ring-1 focus:ring-primary focus:border-primary block p-2.5 pr-10 outline-none transition-all duration-300">
                        <option value="all" class="cursor-pointer" {{ request('rw') === 'all' || !request('rw') ? 'selected' : '' }}>
                            -- Semua Dusun --
                        </option>

                        @foreach ($rwList as $item)
                        <option value="{{ $item->rw }}" class="cursor-pointer" {{ request('rw') == $item->rw ? 'selected' : '' }}>
                            {{ $item->sub_village }} (RW {{ $item->rw }})
                        </option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-textSecondary">
                        <i class="ri-arrow-down-s-line"></i>
                    </div>
                </div>

                @if(request('rw') && request('rw') !== 'all')
                <div class="relative w-full sm:w-32">
                    <select name="rt" onchange="this.form.submit()"
                        class="appearance-none w-full bg-secondary border cursor-pointer border-textTertiary/40 text-textPrimary text-xs sm:text-sm rounded-xl focus:ring-1 focus:ring-primary focus:border-primary block p-2.5 pr-10 outline-none transition-all duration-300">
                        <option value="all" {{ request('rt') === 'all' || !request('rt') ? 'selected' : '' }}>-- Semua RT --</option>

                        @foreach($rtList as $item)
                        <option value="{{ $item->rt }}" {{ request('rt') == $item->rt ? 'selected' : '' }}>
                            RT {{ $item->rt }}
                        </option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-textSecondary">
                        <i class="ri-arrow-down-s-line"></i>
                    </div>
                </div>
                @endif
            </form>
        </div>
    </div>

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
