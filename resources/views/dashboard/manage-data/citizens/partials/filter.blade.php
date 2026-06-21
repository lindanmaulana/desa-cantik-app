<form action="{{ route('dashboard.manage-data.citizens') }}" method="GET"
    class="p-4 max-md:p-3 mb-6 space-y-4 bg-secondary border border-textTertiary/30 shadow-sm rounded-xl">
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5">
        <div class="relative col-span-1 md:col-span-2">
            <label class="block mb-1 text-xs font-medium text-textSecondary">Cari NIK / Nama</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <x-heroicon-o-magnifying-glass class="w-5 h-5 text-textSecondary" />
                </span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari NIK atau Nama..."
                    class="w-full py-2 max-md:text-xs pl-10 pr-4 text-sm bg-secondary border border-textTertiary/40 rounded-lg text-textPrimary placeholder:text-textSecondary/60 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
            </div>
        </div>

        <div>
            <label class="block mb-1 text-xs font-medium text-textSecondary">Jenis Kelamin</label>
            <select name="gender" onchange="this.form.submit()"
                class="w-full px-3 py-2 max-md:text-xs text-sm text-textPrimary bg-secondary border border-textTertiary/40 rounded-lg focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                <option value="" class="max-md:text-xs">Semua Genders</option>
                @foreach ($gender::cases() as $val)
                    <option class="max-md:text-xs" value="{{ $val }}"
                        {{ request('gender') == $val->value ? 'selected' : '' }}>{{ $val->label() }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1 text-xs font-medium text-textSecondary">Agama</label>
            <select name="religion" onchange="this.form.submit()"
                class="w-full px-3 py-2 max-md:text-xs text-sm text-textPrimary bg-secondary border border-textTertiary/40 rounded-lg focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                <option value="">Semua Agama</option>
                @foreach ($religion::cases() as $val)
                    <option value="{{ $val->value }}" {{ request('religion') == $val->value ? 'selected' : '' }}>
                        {{ $val->label() }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1 text-xs font-medium text-textSecondary">Keluarga (No. KK)</label>
            <select name="family_id" onchange="this.form.submit()"
                class="w-full px-3 py-2 max-md:text-xs text-sm text-textPrimary bg-secondary border border-textTertiary/40 rounded-lg focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                <option value="">Semua Keluarga</option>
                @foreach ($families as $fam)
                    <option value="{{ $fam->id }}" {{ request('family_id') == $fam->id ? 'selected' : '' }}>
                        KK: {{ $fam->family_card_number }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="flex items-center justify-end gap-2 pt-2">
        <a href="{{ route('dashboard.manage-data.citizens') }}"
            class="px-4 py-2 text-sm max-md:text-xs font-medium text-textPrimary bg-secondary border border-textTertiary/40 rounded-lg hover:bg-tertiary transition-colors">
            Reset Filter
        </a>
        <button type="submit"
            class="px-4 py-2 text-sm max-md:text-xs font-medium text-secondary transition-colors bg-primary rounded-lg shadow-sm hover:opacity-90">
            Terapkan Filter
        </button>
    </div>
</form>
