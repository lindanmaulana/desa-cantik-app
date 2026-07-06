<form :action="isEdit ? '{{ route('settings.update') }}' : '{{ route('settings.store') }}'" method="POST" class="mt-8 space-y-10">
    @csrf
    <input type="hidden" name="_method" :value="isEdit ? 'PUT' : 'POST'">

    <div class="grid grid-cols-1 pb-10 border-b gap-x-8 gap-y-6 border-gray-900/10 md:grid-cols-3">
        <div>
            <h2 class="text-base font-semibold leading-7 text-gray-950">Identitas Wilayah Utama</h2>
            <p class="mt-1 text-sm leading-6 text-gray-500">Data legalitas wilayah desa sesuai dengan kodifikasi Kementerian Dalam Negeri.</p>
        </div>
        <div class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-6 md:col-span-2">
            <div class="sm:col-span-4">
                <label class="block text-sm font-medium leading-6 text-gray-900">Nama Desa <span class="text-rose-500">*</span></label>
                <input type="text" name="village_name" value="{{ old('village_name', $settings->village_name ?? '') }}" class="block w-full mt-1 text-sm border-gray-300 rounded-lg shadow-sm focus:border-indigo-600 focus:ring-indigo-600">
                @error('village_name') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm font-medium leading-6 text-gray-900">Kode Wilayah <span class="text-rose-500">*</span></label>
                <input type="text" name="village_code" value="{{ old('village_code', $settings->village_code ?? '') }}" placeholder="XX.XX.XX.XXXX" class="block w-full mt-1 text-sm border-gray-300 rounded-lg shadow-sm focus:border-indigo-600 focus:ring-indigo-600">
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm font-medium leading-6 text-gray-900">Kecamatan <span class="text-rose-500">*</span></label>
                <input type="text" name="subdistrict_name" value="{{ old('subdistrict_name', $settings->subdistrict_name ?? '') }}" class="block w-full mt-1 text-sm border-gray-300 rounded-lg shadow-sm">
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm font-medium leading-6 text-gray-900">Kabupaten / Kota <span class="text-rose-500">*</span></label>
                <input type="text" name="regency_name" value="{{ old('regency_name', $settings->regency_name ?? '') }}" class="block w-full mt-1 text-sm border-gray-300 rounded-lg shadow-sm">
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm font-medium leading-6 text-gray-900">Provinsi <span class="text-rose-500">*</span></label>
                <input type="text" name="province_name" value="{{ old('province_name', $settings->province_name ?? '') }}" class="block w-full mt-1 text-sm border-gray-300 rounded-lg shadow-sm">
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 pb-10 border-b gap-x-8 gap-y-6 border-gray-900/10 md:grid-cols-3">
        <div>
            <h2 class="text-base font-semibold leading-7 text-gray-950">Aparatur & Branding</h2>
            <p class="mt-1 text-sm leading-6 text-gray-500">Penanggung jawab struktural lembaga pemerintah desa dan judul meta aplikasi.</p>
        </div>
        <div class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-6 md:col-span-2">
            <div class="sm:col-span-3">
                <label class="block text-sm font-medium leading-6 text-gray-900">Nama Kepala Desa</label>
                <input type="text" name="village_head_name" value="{{ old('village_head_name', $settings->village_head_name ?? '') }}" class="block w-full mt-1 text-sm border-gray-300 rounded-lg shadow-sm">
            </div>
            <div class="sm:col-span-3">
                <label class="block text-sm font-medium leading-6 text-gray-900">NIP Kepala Desa (Jika PNS)</label>
                <input type="text" name="village_head_nip" value="{{ old('village_head_nip', $settings->village_head_nip ?? '') }}" class="block w-full mt-1 text-sm border-gray-300 rounded-lg shadow-sm">
            </div>
            <div class="sm:col-span-6">
                <label class="block text-sm font-medium leading-6 text-gray-900">Judul Aplikasi / Sistem <span class="text-rose-500">*</span></label>
                <input type="text" name="app_title" value="{{ old('app_title', $settings->app_title ?? '') }}" class="block w-full mt-1 text-sm border-gray-300 rounded-lg shadow-sm">
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 pb-10 border-b gap-x-8 gap-y-6 border-gray-900/10 md:grid-cols-3">
        <div>
            <h2 class="text-base font-semibold leading-7 text-gray-950">Kontak & Pemetaan GIS</h2>
            <p class="mt-1 text-sm leading-6 text-gray-500">Alamat korespondensi instansi resmi dan titik koordinat peta kantor desa.</p>
        </div>
        <div class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-6 md:col-span-2">
            <div class="sm:col-span-6">
                <label class="block text-sm font-medium leading-6 text-gray-900">Alamat Lengkap Kantor Desa</label>
                <textarea name="office_address" rows="2" class="block w-full mt-1 text-sm border-gray-300 rounded-lg shadow-sm">{{ old('office_address', $settings->office_address ?? '') }}</textarea>
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm font-medium leading-6 text-gray-900">Kode Pos</label>
                <input type="text" name="postal_code" value="{{ old('postal_code', $settings->postal_code ?? '') }}" class="block w-full mt-1 text-sm border-gray-300 rounded-lg shadow-sm">
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm font-medium leading-6 text-gray-900">Email Instansi</label>
                <input type="email" name="official_email" value="{{ old('official_email', $settings->official_email ?? '') }}" class="block w-full mt-1 text-sm border-gray-300 rounded-lg shadow-sm">
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm font-medium leading-6 text-gray-900">Nomor Telepon/WA</label>
                <input type="text" name="phone_number" value="{{ old('phone_number', $settings->phone_number ?? '') }}" class="block w-full mt-1 text-sm border-gray-300 rounded-lg shadow-sm">
            </div>
            <div class="sm:col-span-3">
                <label class="block text-sm font-medium leading-6 text-gray-900">Garis Lintang (Latitude)</label>
                <input type="text" name="latitude" value="{{ old('latitude', $settings->latitude ?? '') }}" placeholder="-6.123456" class="block w-full mt-1 text-sm border-gray-300 rounded-lg shadow-sm">
            </div>
            <div class="sm:col-span-3">
                <label class="block text-sm font-medium leading-6 text-gray-900">Garis Bujur (Longitude)</label>
                <input type="text" name="longitude" value="{{ old('longitude', $settings->longitude ?? '') }}" placeholder="106.123456" class="block w-full mt-1 text-sm border-gray-300 rounded-lg shadow-sm">
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-x-8 gap-y-6 md:grid-cols-3">
        <div>
            <h2 class="text-base font-semibold leading-7 text-gray-950">Tautan Sosial Media</h2>
            <p class="mt-1 text-sm leading-6 text-gray-500">Hubungkan halaman publik website dengan platform media sosial eksternal resmi.</p>
        </div>
        <div class="space-y-4 md:col-span-2">
            <div>
                <label class="block text-sm font-medium leading-6 text-gray-900">Facebook URL</label>
                <input type="url" name="facebook_url" value="{{ old('facebook_url', $settings->facebook_url ?? '') }}" placeholder="https://facebook.com/..." class="block w-full mt-1 text-sm border-gray-300 rounded-lg shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium leading-6 text-gray-900">YouTube Channel URL</label>
                <input type="url" name="youtube_url" value="{{ old('youtube_url', $settings->youtube_url ?? '') }}" placeholder="https://youtube.com/..." class="block w-full mt-1 text-sm border-gray-300 rounded-lg shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium leading-6 text-gray-900">Instagram URL</label>
                <input type="url" name="instagram_url" value="{{ old('instagram_url', $settings->instagram_url ?? '') }}" placeholder="https://instagram.com/..." class="block w-full mt-1 text-sm border-gray-300 rounded-lg shadow-sm">
            </div>
        </div>
    </div>

    <div class="flex items-center justify-end pt-6 border-t gap-x-6 border-gray-900/10">
        <button type="submit" class="rounded-lg bg-primary px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-primary/90 transition focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            <span x-text="isEdit ? 'Simpan Perubahan Data' : 'Inisialisasi Pengaturan'"></span>
        </button>
    </div>
</form>