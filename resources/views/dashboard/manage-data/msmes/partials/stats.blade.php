<div class="grid grid-cols-1 gap-4 mb-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3">
    <x-cards.stat-card-second title="Total Unit Usaha" value="{{ $counts->total_Msmes }}" icon="bi-shop"
        color="text-emerald-600 bg-emerald-50" />

    <x-cards.stat-card-second title="Total Tenaga Kerja"
        value="{{ number_format($counts->total_Employees, 0, ',', '.') }}" icon="heroicon-o-users"
        color="text-amber-600 bg-amber-50" />

    <x-cards.stat-card-second class="sm:col-span-2 md:col-span-2 lg:col-span-2 xl:col-span-1" title="Total Omser Bulanan"
        value="Rp. {{ number_format($counts->total_Revenue, 2, ',', '.') }}" icon="vaadin-ellipsis-h"
        color="text-blue-600 bg-blue-50" />
</div>
