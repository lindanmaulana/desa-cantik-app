@props(['id', 'title', 'subtitle'])

<div class="bg-white p-6 max-md:p-3 rounded-3xl max-md:rounded-xl shadow-sm border border-gray-100">
    <div class="mb-6">
        <h3 class="text-xl max-md:text-base font-bold text-slate-800">{{ $title }}</h3>
        <p class="text-sm max-md:text-xs text-gray-400">{{ $subtitle }}</p>
    </div>

    <div class="text-center mb-4">
        <span class="text-xs font-bold text-slate-400 uppercase tracking-widest text-center block">
            Distribusi Visual
        </span>
    </div>

    <div class="chart-container w-full min-h-[320px] max-md:min-h-[260px]">
        <div id="{{ $id }}"></div>
    </div>
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
