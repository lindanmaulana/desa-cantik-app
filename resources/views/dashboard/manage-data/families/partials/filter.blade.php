<form action="{{ route('dashboard.manage-data.families') }}" method="GET" class="flex flex-col items-center justify-between gap-4 p-4 mb-6 bg-white border border-gray-100 shadow-sm max-md:p-3 rounded-xl md:flex-row">
    <div class="relative w-full md:w-72">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <x-heroicon-o-magnifying-glass class="w-5 h-5 text-gray-400" />
        </span>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari No KK atau alamat..." class="w-full py-2 pl-10 pr-4 text-sm border border-gray-200 rounded-lg max-md:text-xs focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
    </div>

    <div class="flex items-center justify-end w-full gap-2 md:w-auto">
        <select name="territory_id" onchange="this.form.submit()" class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg max-md:text-xs md:w-64 focus:outline-none focus:border-teal-500">
            <option value="">Semua Wilayah</option>
            @foreach($territories as $territory)
            <option value="{{ $territory->id }}" {{ request('territory_id') == $territory->id ? 'selected' : '' }}>
                Dusun {{ ucfirst($territory->sub_village) }} (RT {{ $territory->rt }} / RW {{ $territory->rw }})
            </option>
            @endforeach
        </select>
        <button type="submit" class="px-4 py-2 text-sm font-medium text-white transition-colors bg-teal-600 rounded-lg shadow-sm max-md:text-xs hover:bg-teal-700">
            Filter
        </button>
    </div>
</form>