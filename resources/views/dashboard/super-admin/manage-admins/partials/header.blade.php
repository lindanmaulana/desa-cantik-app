<div class="flex flex-col items-start justify-between gap-4 mb-6 md:flex-row md:items-center">
    <div>
        <h1 class="flex items-center gap-2 text-2xl font-bold text-textPrimary max-md:text-lg">
            <x-heroicon-o-shield-check class="w-6 h-6 text-primary" />
            Kelola Akun Admin
        </h1>
        <p class="mt-1 text-sm text-textSecondary max-md:text-xs">
            Manajemen hak akses administrator sistem, pembuatan kredensial baru, dan penonaktifkan akun pengelola desa.
        </p>
    </div>

    <div class="flex items-center gap-2">
        <button @click="openCreate = true"
            class="inline-flex items-center px-4 py-2 text-sm font-medium transition-colors rounded-lg shadow-sm text-secondary bg-primary hover:opacity-90">
            <x-heroicon-o-user-plus class="w-4 h-4 mr-2 max-xl:mr-0" />
            <span class="max-xl:hidden">Tambah Admin Baru</span>
        </button>
    </div>
</div>
