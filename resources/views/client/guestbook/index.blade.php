<x-layouts.client>
    <div class="space-y-6" x-data="{ submitting: false }">
        <section class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-primary to-emerald-500 p-6 text-white shadow-lg sm:p-8">
            <div class="relative z-10 max-w-2xl">
                <div class="mb-3 flex items-center gap-3">
                    <x-heroicon-o-book-open class="size-9" />
                    <span class="text-xs font-bold uppercase tracking-[0.2em] text-white/70">Layanan Publik</span>
                </div>
                <h1 class="text-2xl font-bold tracking-tight text-white sm:text-3xl">Buku Tamu Desa</h1>
                <p class="mt-2 text-sm text-white/95 sm:text-base">Silakan isi formulir kunjungan Anda. Data akan diverifikasi oleh petugas desa.</p>
            </div>
            <div class="absolute -right-10 -top-16 size-56 rounded-full bg-white/10"></div>
            <div class="absolute -bottom-28 right-20 size-64 rounded-full bg-white/5"></div>
        </section>

        @if (session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif
        @if (session('error'))
            <x-alert type="error" :message="session('error')" />
        @endif

        <form method="POST" action="{{ route('guestbook.store') }}" class="rounded-3xl border border-gray-100 bg-white p-5 shadow-sm sm:p-8"
            x-data="guestbookSignature()" @submit="submitting = true">
            @csrf
            <input type="text" name="website" tabindex="-1" autocomplete="off" class="absolute -left-[9999px] opacity-0" aria-hidden="true">

            <div class="mb-8">
                <div class="mb-4 flex items-center gap-3">
                    <x-heroicon-o-calendar-days class="size-5 text-primary" />
                    <h2 class="text-xs font-bold uppercase tracking-[0.18em] text-textSecondary">Waktu Kunjungan</h2>
                    <div class="h-px flex-1 bg-gray-200"></div>
                </div>
                <label for="visit_date" class="mb-2 block text-sm font-medium text-textPrimary">Tanggal Kunjungan <span class="text-red-500">*</span></label>
                <input id="visit_date" type="date" name="visit_date" value="{{ old('visit_date', now()->format('Y-m-d')) }}"
                    min="{{ now()->format('Y-m-d') }}" required
                    class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-textPrimary outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10">
                @error('visit_date') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="mb-8">
                <div class="mb-4 flex items-center gap-3">
                    <x-heroicon-o-identification class="size-5 text-primary" />
                    <h2 class="text-xs font-bold uppercase tracking-[0.18em] text-textSecondary">Identitas Tamu</h2>
                    <div class="h-px flex-1 bg-gray-200"></div>
                </div>
                <div class="grid gap-5 md:grid-cols-2">
                    @foreach ([
                        ['full_name', 'Nama Lengkap', 'Ketik nama lengkap Anda', true],
                        ['address', 'Alamat', 'Alamat tempat tinggal', false],
                        ['occupation', 'Pekerjaan / Profesi', 'Pekerjaan atau profesi Anda', false],
                        ['institution', 'Instansi / Lembaga', 'Nama instansi atau lembaga', false],
                        ['phone', 'Nomor Telepon', 'Nomor yang dapat dihubungi', false],
                        ['email', 'Email', 'Alamat email (opsional)', false],
                    ] as [$name, $label, $placeholder, $required])
                        <div>
                            <label for="{{ $name }}" class="mb-2 block text-sm font-medium text-textPrimary">{{ $label }} @if($required)<span class="text-red-500">*</span>@endif</label>
                            <input id="{{ $name }}" type="{{ $name === 'email' ? 'email' : 'text' }}" name="{{ $name }}"
                                value="{{ old($name) }}" placeholder="{{ $placeholder }}" @required($required)
                                class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-textPrimary outline-none transition placeholder:text-gray-400 focus:border-primary focus:ring-2 focus:ring-primary/10">
                            @error($name) <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mb-8">
                <div class="mb-4 flex items-center gap-3">
                    <x-heroicon-o-chat-bubble-left-right class="size-5 text-primary" />
                    <h2 class="text-xs font-bold uppercase tracking-[0.18em] text-textSecondary">Keperluan Kunjungan</h2>
                    <div class="h-px flex-1 bg-gray-200"></div>
                </div>
                <label for="purpose" class="mb-2 block text-sm font-medium text-textPrimary">Maksud / Tujuan Kunjungan <span class="text-red-500">*</span></label>
                <input id="purpose" type="text" name="purpose" value="{{ old('purpose') }}" placeholder="Contoh: konsultasi data desa"
                    required class="mb-5 w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-textPrimary outline-none transition placeholder:text-gray-400 focus:border-primary focus:ring-2 focus:ring-primary/10">
                @error('purpose') <p class="-mt-4 mb-4 text-xs text-red-500">{{ $message }}</p> @enderror

                <label for="message" class="mb-2 block text-sm font-medium text-textPrimary">Pesan / Keterangan</label>
                <textarea id="message" name="message" rows="4" placeholder="Jelaskan keperluan kunjungan Anda..."
                    class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-textPrimary outline-none transition placeholder:text-gray-400 focus:border-primary focus:ring-2 focus:ring-primary/10">{{ old('message') }}</textarea>
                @error('message') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="mb-8">
                <div class="mb-4 flex items-center gap-3">
                    <x-heroicon-o-pencil class="size-5 text-primary" />
                    <h2 class="text-xs font-bold uppercase tracking-[0.18em] text-textSecondary">Tanda Tangan</h2>
                    <div class="h-px flex-1 bg-gray-200"></div>
                </div>
                <label class="mb-2 block text-sm font-medium text-textPrimary">Tanda Tangan <span class="text-red-500">*</span></label>
                <div class="overflow-hidden rounded-2xl border-2 border-dashed border-gray-300 bg-gray-50">
                    <canvas x-ref="canvas" class="h-48 w-full touch-none cursor-crosshair"></canvas>
                </div>
                <input type="hidden" name="signature" x-ref="signature">
                <div class="mt-2 flex items-center justify-between gap-3">
                    <p class="text-xs text-gray-400">Gunakan mouse atau layar sentuh untuk menandatangani.</p>
                    <button type="button" @click="clearSignature" class="rounded-lg border border-gray-200 px-3 py-1.5 text-xs font-medium text-gray-500 transition hover:bg-gray-50">Reset</button>
                </div>
                @error('signature') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <label class="mb-6 flex items-start gap-3 text-xs text-gray-500">
                <input type="checkbox" name="privacy_agreement" value="1" required class="mt-0.5 rounded border-gray-300 text-primary focus:ring-primary">
                <span>Saya menyetujui data ini digunakan untuk pencatatan layanan kunjungan desa.</span>
            </label>
            @error('privacy_agreement') <p class="-mt-5 mb-5 text-xs text-red-500">{{ $message }}</p> @enderror

            <div class="flex flex-col-reverse justify-end gap-3 sm:flex-row">
                <button type="button" @click="clearForm" class="rounded-xl border border-gray-200 px-5 py-3 text-sm font-medium text-gray-600 transition hover:bg-gray-50">Reset Form</button>
                <button type="submit" :disabled="submitting" class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:opacity-90 disabled:cursor-not-allowed disabled:opacity-60">
                    <x-heroicon-o-paper-airplane class="size-4" />
                    <span x-text="submitting ? 'Mengirim...' : 'Kirim Data'"></span>
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('guestbookSignature', () => ({
                    drawing: false,
                    context: null,
                    init() {
                        const canvas = this.$refs.canvas;
                        const ratio = Math.max(window.devicePixelRatio || 1, 1);
                        canvas.width = canvas.offsetWidth * ratio;
                        canvas.height = canvas.offsetHeight * ratio;
                        this.context = canvas.getContext('2d');
                        this.context.scale(ratio, ratio);
                        this.context.strokeStyle = '#334155';
                        this.context.lineWidth = 2;
                        this.context.lineCap = 'round';
                        canvas.addEventListener('pointerdown', (event) => {
                            this.drawing = true;
                            canvas.setPointerCapture(event.pointerId);
                            this.context.beginPath();
                            this.context.moveTo(event.offsetX, event.offsetY);
                        });
                        canvas.addEventListener('pointermove', (event) => {
                            if (!this.drawing) return;
                            this.context.lineTo(event.offsetX, event.offsetY);
                            this.context.stroke();
                        });
                        ['pointerup', 'pointerleave'].forEach((eventName) => canvas.addEventListener(eventName, () => {
                            this.drawing = false;
                            this.$refs.signature.value = canvas.toDataURL('image/png');
                        }));
                    },
                    clearSignature() {
                        const canvas = this.$refs.canvas;
                        this.context.clearRect(0, 0, canvas.offsetWidth, canvas.offsetHeight);
                        this.$refs.signature.value = '';
                    },
                    clearForm() {
                        this.$root.reset();
                        this.clearSignature();
                    }
                }));
            });
        </script>
    @endpush
</x-layouts.client>
