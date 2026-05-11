<x-layouts.app>
    <div class="flex h-screen bg-gray-100">
        <aside class="w-64 bg-white shadow-md">
            <div class="p-4 font-bold text-lg border-b">
                Magang App
            </div>
            <nav class="p-4">
                <ul class="space-y-2">
                    <li><a href="/" class="block p-2 hover:bg-gray-200 rounded">Beranda</a></li>
                    <li><a href="/statistics/demographics" class="block p-2 hover:bg-gray-200 rounded">Statistics</a></li>
                    <li><a href="/pandawa/analysis" class="block p-2 hover:bg-gray-200 rounded">Pandawa</a></li>
                </ul>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col">
            <header class="bg-white shadow-sm p-4 flex justify-between">
                <span class="font-semibold">Dashboard Admin</span>
                <button class="text-red-500">Logout</button>
            </header>

            <main class="p-6">
                {{ $slot }}
                </main>
        </div>
    </div>
</x-layouts.app>
