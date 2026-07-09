<div class="p-5 space-y-3 border shadow-sm rounded-2xl border-textTertiary/20 bg-secondary">
    <h4 class="text-xs font-bold tracking-wider uppercase text-textSecondary">Log Sistem Terkini</h4>
    <div class="space-y-2.5 text-xs text-textSecondary">
        <div class="flex justify-between">
            <span>Terdaftar Pada:</span>
            <span class="font-medium text-textPrimary">{{ $user->created_at?->translatedFormat('d F Y') ?? '-' }}</span>
        </div>
        <div class="flex justify-between">
            <span>Pembaruan Data:</span>
            <span class="font-medium text-textPrimary">{{ $user->updated_at?->diffForHumans() ?? '-' }}</span>
        </div>
        <div class="flex justify-between">
            <span>Sesi Login:</span>
            <span class="font-medium text-textPrimary">{{ now()->format('H:i') }} WIB</span>
        </div>
    </div>
</div>