    <div class="grid grid-cols-1 gap-4 mb-6 sm:grid-cols-3">
        <x-cards.stat-card-second title="Total Profile Warga" value="{{ $counts->total_Profiles }}" icon="heroicon-o-folder-open" color="text-emerald-600 bg-emerald-50" />
        <x-cards.stat-card-second title="Penerima Bansos" value="{{ $counts->total_Recipients }}" icon="heroicon-o-gift" color="text-amber-600 bg-amber-50" />
        <x-cards.stat-card-second title="Rata-Rata Pendapatan" value="Rp {{ number_format($counts->average_Income, 2, ',', '.') }}" icon="phosphor-money" color="text-blue-600 bg-blue-50" :isSecret="true" />
    </div>