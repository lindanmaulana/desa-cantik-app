@props(['type' => 'success', 'message'])

@php
// Menentukan class warna berdasarkan tipe alert
$classes = [
'success' => 'text-green-800 bg-green-50',
'error' => 'text-red-800 bg-red-50',
'warning' => 'text-yellow-800 bg-yellow-50',
'info' => 'text-blue-800 bg-blue-50',
][$type] ?? 'text-green-800 bg-green-50';
@endphp

<div class="p-4 mb-4 text-sm rounded-lg {{ $classes }}" role="alert">
    <span class="font-medium">{{ ucfirst($type) }}!</span> {{ $message }}
</div>