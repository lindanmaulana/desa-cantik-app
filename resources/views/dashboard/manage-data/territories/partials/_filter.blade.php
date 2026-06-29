<form action="{{ route('dashboard.manage-data.territories') }}" method="GET"
    class="flex flex-col items-center justify-between gap-4 p-4 mb-6 border shadow-sm max-md:p-3 bg-secondary border-textTertiary/30 rounded-xl md:flex-row">
    <div class="relative w-full md:w-72">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <x-heroicon-o-magnifying-glass class="w-5 h-5 text-textSecondary" />
        </span>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama dusun atau wilayah..."
            class="w-full py-2 pl-10 pr-4 text-sm border rounded-lg max-md:text-xs bg-secondary border-textTertiary/40 text-textPrimary placeholder:text-textSecondary/60 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
    </div>

    <div class="flex items-center justify-end w-full gap-2 md:w-auto">
        <select name="sub_village" onchange="this.form.submit()"
            class="w-full px-3 py-2 text-sm border rounded-lg max-md:text-xs text-textPrimary bg-secondary border-textTertiary/40 md:w-44 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
            <option value="">Semua Dusun</option>

            @if($rwList->isNotEmpty())
                @foreach($rwList as $rw)
                    <option value="{{ $rw->sub_village }}" {{ request('sub_village') == $rw->sub_village ? 'selected' : '' }}>{{ $rw->sub_village }}</option>
                @endforeach
            @endif
        </select>

        @if (request()->hasAny(['search', 'sub_village', 'rt', 'rw']))
        <a href="{{ route('dashboard.manage-data.territories') }}"
            class="px-4 py-2 text-sm font-medium text-white bg-red-500 border border-transparent rounded-lg max-md:text-xs hover:bg-red-400">
            <span class="truncate">Reset Filter</span>
        </a>
        @endif

        <button type="submit"
            class="px-4 py-2 text-sm font-medium transition-colors rounded-lg shadow-sm max-md:text-xs text-secondary bg-primary hover:opacity-90">
            Filter
        </button>
    </div>
</form>
