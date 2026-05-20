    @php
        $houseCondition = App\Enums\HouseCondition::cases();
        $economicStatus = App\Enums\EconomicStatus::cases();
    @endphp
    
    
    <form action="{{ route('dashboard.manage-data.social-economics') }}" method="GET" class="p-4 mb-6 space-y-4 bg-white border border-gray-100 shadow-sm rounded-xl">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-5">
            <div class="relative col-span-1 md:col-span-2">
                <label class="block mb-1 text-xs font-medium text-gray-500">Cari NIK / Nama Penduduk</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <x-heroicon-o-magnifying-glass class="w-5 h-5 text-gray-400" />
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari NIK atau Nama..." class="w-full py-2 pl-10 pr-4 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                </div>
            </div>

            <div>
                <label class="block mb-1 text-xs font-medium text-gray-500">Kelayakan Hunian</label>
                <select name="house_condition" onchange="this.form.submit()" class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg focus:outline-none focus:border-emerald-500">
                    <option value="">Semua Kondisi</option>
                    @foreach($houseCondition as $val)
                    <option value="{{ $val->value }}" {{ request('house_condition') == $val->value ? 'selected' : '' }}>{{ $val->label() }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 text-xs font-medium text-gray-500">Klasifikasi Ekonomi</label>
                <select name="economic_status" onchange="this.form.submit()" class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg focus:outline-none focus:border-emerald-500">
                    <option value="">Semua Status</option>
                    @foreach($economicStatus as $val)
                    <option value="{{ $val->value }}" {{ request('economic_status') == $val->value ? 'selected' : '' }}>{{ $val->label() }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 text-xs font-medium text-gray-500">Status Bansos</label>
                <select name="is_welfare_recipient" onchange="this.form.submit()" class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg focus:outline-none focus:border-emerald-500">
                    <option value="">Semua Status Bansos</option>
                    <option value="1" {{ request('is_welfare_recipient') === '1' ? 'selected' : '' }}>Penerima Bantuan</option>
                    <option value="0" {{ request('is_welfare_recipient') === '0' ? 'selected' : '' }}>Bukan Penerima</option>
                </select>
            </div>
        </div>

        <div class="flex items-center justify-end gap-2 pt-2">
            <a href="{{ route('dashboard.manage-data.social-economics') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50">
                Reset Filter
            </a>
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white transition-colors rounded-lg shadow-sm bg-emerald-600 hover:bg-emerald-700">
                Terapkan Filter
            </button>
        </div>
    </form>
