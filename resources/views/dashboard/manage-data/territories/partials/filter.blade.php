<form action="{{ route('dashboard.manage-data.territories') }}" method="GET" class="flex flex-col items-center justify-between gap-4 p-4 max-md:p-3 mb-6 bg-white border border-gray-100 shadow-sm rounded-xl md:flex-row">
    <div class="relative w-full md:w-72">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <x-heroicon-o-magnifying-glass class="w-5 h-5 text-gray-400" />
        </span>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama dusun atau wilayah..." class="w-full py-2 pl-10 pr-4 text-sm max-md:text-xs border border-gray-200 rounded-lg focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
    </div>

    <div class="flex items-center justify-end w-full gap-2 md:w-auto">
        <select name="sub_village" onchange="this.form.submit()" class="w-full px-3 py-2 text-sm max-md:text-xs text-gray-700 bg-white border border-gray-200 rounded-lg md:w-44 focus:outline-none focus:border-teal-500">
            <option value="">Semua Dusun</option>
            <option value="pahing" {{ request('sub_village') == 'pahing' ? 'selected' : '' }}>Pahing</option>
            <option value="pon" {{ request('sub_village') == 'pon' ? 'selected' : '' }}>Pon</option>
            <option value="wage" {{ request('sub_village') == 'wage' ? 'selected' : '' }}>Wage</option>
        </select>

        @if(request()->anyFilled(['search', 'sub_village', 'rt', 'rw']))
        <a href="{{ route('dashboard.manage-data.territories') }}" class="px-4 py-2 text-sm max-md:text-xs font-medium text-white bg-red-500 border border-gray-200 rounded-lg hover:bg-red-400">
            <span class="truncate">Reset Filter</span>
        </a>
        @endif

        <button type="submit" class="px-4 py-2 text-sm max-md:text-xs font-medium text-white transition-colors bg-teal-600 rounded-lg shadow-sm hover:bg-teal-700">
            Filter
        </button>
    </div>
</form>