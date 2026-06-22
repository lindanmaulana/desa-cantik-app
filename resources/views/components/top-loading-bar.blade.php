<div x-data x-show="$store.navLoading.activeKey !== null" x-cloak x-transition:enter="transition-opacity duration-150"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity duration-200" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" class="fixed top-0 left-0 right-0 z-[100] h-1 bg-transparent">
    <div class="h-full bg-primary origin-left animate-top-loading-bar"></div>
</div>
