@if (session('success') || session('error'))
<div class="mt-6">
    @if (session('success'))
    <div class="flex items-center p-4 text-sm text-white rounded-lg shadow-sm bg-emerald-600">
        <svg class="w-5 h-5 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span class="font-medium">{{ session('success') }}</span>
    </div>
    @endif
    @if (session('error'))
    <div class="flex items-center p-4 text-sm text-white rounded-lg shadow-sm bg-rose-600">
        <svg class="w-5 h-5 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span class="font-medium">{{ session('error') }}</span>
    </div>
    @endif
</div>
@endif

@if (session('error_upload'))
<div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
    {{ session('error_upload') }}
</div>
@endif

@if ($errors->any())
    <div class="p-4 mb-6 text-sm border rounded-lg text-rose-800 bg-rose-50 border-rose-200" role="alert">
        <div class="mb-2 text-base font-semibold text-rose-900">Periksa Kembali Isian Anda:</div>
        <ul class="space-y-1 list-disc list-inside text-rose-700">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
