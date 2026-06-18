@props(['id', 'title', 'subtitle', 'chartData' => [], 'chartLabels' => [], 'chartType', 'reqType'])

<div x-data="{...chartComponent('{{ $id }}', {!! Js::from($chartType) !!}, {!! Js::from($chartData) !!}, {!! Js::from($chartLabels) !!}),
            isEmpty() {
                    const values = Object.values({!! Js::from($chartData) !!});
                    return values.length === 0 || values.every(v => Number(v) === 0);
            }}"
    x-init="if(!isEmpty()) { initChart() }" class="p-6 bg-white border border-gray-100 shadow-sm max-md:p-3 rounded-3xl max-md:rounded-xl">

    @if($reqType)
    <div class="mb-6">
        <h3 class="text-xl font-bold max-md:text-base text-slate-800">{{ $title }}</h3>
        <p class="text-sm text-gray-400 max-md:text-xs">{{ $subtitle }}</p>
    </div>

    <div x-show="!isEmpty()">
        <div class="mb-4 text-center">
            <span class="block text-xs font-bold tracking-widest text-center uppercase text-slate-400">
                Distribusi Visual
            </span>
        </div>

        <div class="chart-container w-full min-h-[320px] max-md:min-h-[260px]">
            <div id="{{ $id }}"></div>
        </div>
    </div>

    <div x-show="isEmpty()">
        <div class="w-full h-[320px] max-md:h-[300px] flex flex-col items-center justify-center text-center text-gray-400 gap-2">
            <x-iconsax-bro-chart-1 class="text-gray-300 size-16" />
            <div class="mt-2 font-medium text-slate-500">Tidak Ada Data {{ $title }}</div>
            <div class="max-w-xs px-4 text-xs text-gray-400">
                Belum ada data atau hasil survei warga yang terisi untuk kategori ini di wilayah terpilih.
            </div>
        </div>
    </div>

    @else
    <div class="w-full h-[400px] flex flex-col items-center justify-center text-gray-400 italic gap-4">
        <x-iconsax-bro-chart-1 class="size-20" />
        <div>Pilih Kategori di atas.</div>
    </div>
    @endif
</div>

<style>
    .chart-container {
        display: flex !important;
        flex-direction: column !important;
        justify-content: space-between !important;
    }

    .chart-container .apexcharts-legend {
        position: relative !important;
        top: auto !important;
        left: auto !important;
        margin-top: 24px !important;
        padding-bottom: 16px !important;
    }

    .chart-container .apexcharts-canvas {
        margin: 0 auto !important;
        height: auto !important;
    }
</style>
