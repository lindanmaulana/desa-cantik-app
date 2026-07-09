@if (session('success'))
<x-alert type="success" :message="session('success')" />
@endif

@if (session('error'))
<x-alert type="error" :message="session('error')" />
@endif

@if ($errors->any())
<div class="p-4 mb-4 space-y-1 text-sm text-red-600 border rounded-xl border-red-500/20 bg-red-500/10">
    <div class="flex items-center gap-2 mb-1 font-bold">
        <x-heroicon-o-exclamation-triangle class="w-5 h-5" />
        <span>Gagal Memproses Data:</span>
    </div>
    <ul class="list-disc list-inside space-y-0.5 text-xs opacity-90 pl-1">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif