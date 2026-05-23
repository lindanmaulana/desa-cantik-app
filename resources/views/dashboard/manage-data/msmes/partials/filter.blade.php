    <form action="{{ route('dashboard.manage-data.msmes') }}" method="GET" class="p-4 mb-6 space-y-4 bg-white border border-gray-100 shadow-sm rounded-xl">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
            <div class="relative col-span-1 md:col-span-2">
                <label class="block mb-1 text-xs font-medium text-gray-500">Cari NIB / Nama Toko / Nama Pemilik</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <x-heroicon-o-magnifying-glass class="w-5 h-5 text-gray-400" />
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari NIB, Nama Toko, atau Nama Pemilik..." class="w-full py-2 pl-10 pr-4 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                </div>
            </div>

            <div>
                <label class="block mb-1 text-xs font-medium text-gray-500">Kategori Usaha</label>
                <select name="business_category" onchange="this.form.submit()" class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg focus:outline-none focus:border-emerald-500">
                    <option value="">Semua Kategori</option>
                    @foreach($businessCategory::cases() as $val)
                    <option value="{{ $val->value }}" {{ request('business_category') == $val->value ? 'selected' : '' }}>{{ $val->label() }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-end self-end justify-end gap-2">
                <a href="{{ route('dashboard.manage-data.msmes') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50">
                    Reset Filter
                </a>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white transition-colors rounded-lg shadow-sm bg-primary hover:bg-secondary">
                    Cari
                </button>
            </div>
        </div>
    </form>
