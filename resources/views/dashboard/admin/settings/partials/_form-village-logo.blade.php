<div class="grid grid-cols-1 gap-x-8 gap-y-6 md:grid-cols-3">
    <div>
        <h2 class="text-base font-semibold leading-7 text-gray-950">Logo Identitas Resmi</h2>
        <p class="mt-1 text-sm leading-6 text-gray-500">Aset gambar visual transparan lambang desa. Disarankan berformat PNG atau SVG.</p>
    </div>
    <div class="md:col-span-2">
        <form id="logo-update-form" action="{{ route('settings.update-logo') }}" method="POST" enctype="multipart/form-data"
            class="relative overflow-hidden bg-white border border-gray-200 shadow-sm rounded-xl"
            x-data="{
                submitting: false,
                previewOpen: false,
                preview: null,
                imageWidth: 0,
                imageHeight: 0,
                cropX: 0,
                cropY: 0,
                dragging: false,
                dragStartX: 0,
                dragStartY: 0,
                startCropX: 0,
                startCropY: 0,
                cancelPreview() {
                    this.preview = null;
                    this.previewOpen = false;
                    this.$refs.file.value = null;
                },
                loadPreview(event) {
                    const file = event.target.files[0];
                    if (!file) return;
                    const reader = new FileReader();
                    reader.onload = loadEvent => {
                        this.preview = loadEvent.target.result;
                        const image = new Image();
                        image.onload = () => {
                            this.imageWidth = image.naturalWidth;
                            this.imageHeight = image.naturalHeight;
                            this.cropX = 0;
                            this.cropY = 0;
                            this.previewOpen = true;
                        };
                        image.src = this.preview;
                    };
                    reader.readAsDataURL(file);
                },
                imageStyle() {
                    const scale = Math.max(256 / this.imageWidth, 256 / this.imageHeight);
                    return `width: ${this.imageWidth * scale}px; height: ${this.imageHeight * scale}px; transform: translate(${this.cropX}px, ${this.cropY}px);`;
                },
                startDrag(event) {
                    this.dragging = true;
                    this.dragStartX = event.clientX;
                    this.dragStartY = event.clientY;
                    this.startCropX = this.cropX;
                    this.startCropY = this.cropY;
                },
                moveDrag(event) {
                    if (!this.dragging) return;
                    const scale = Math.max(256 / this.imageWidth, 256 / this.imageHeight);
                    const width = this.imageWidth * scale;
                    const height = this.imageHeight * scale;
                    this.cropX = Math.min(0, Math.max(256 - width, this.startCropX + event.clientX - this.dragStartX));
                    this.cropY = Math.min(0, Math.max(256 - height, this.startCropY + event.clientY - this.dragStartY));
                },
                stopDrag() {
                    this.dragging = false;
                },
                openPreview() {
                    if (this.preview && !this.submitting) {
                        this.previewOpen = true;
                    }
                },
                async confirmUpdate() {
                    const image = new Image();
                    image.src = this.preview;
                    await image.decode();
                    const scale = Math.max(256 / image.naturalWidth, 256 / image.naturalHeight);
                    const canvas = document.createElement('canvas');
                    canvas.width = 512;
                    canvas.height = 512;
                    const context = canvas.getContext('2d');
                    context.drawImage(image, this.cropX * 2, this.cropY * 2, image.naturalWidth * scale * 2, image.naturalHeight * scale * 2);
                    const blob = await new Promise(resolve => canvas.toBlob(resolve, 'image/png'));
                    const croppedFile = new File([blob], 'logo-cropped.png', { type: 'image/png' });
                    const transfer = new DataTransfer();
                    transfer.items.add(croppedFile);
                    this.$refs.file.files = transfer.files;
                    this.previewOpen = false;
                    this.submitting = true;
                    this.$refs.form.requestSubmit();
                }
            }"
            x-ref="form">
            @csrf
            @method('PUT')
            <div class="p-6 sm:flex sm:items-center sm:gap-x-6">
                <div class="flex items-center justify-center w-24 h-24 p-2 border border-gray-200 shadow-inner shrink-0 rounded-xl bg-gray-50">
                    @if (!empty($settings->village_logo))
                        <img src="{{ asset('storage/' . $settings->village_logo) }}" class="object-contain max-w-full max-h-full" alt="Logo">
                    @else
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6v12a2 2 0 002 2z" />
                        </svg>
                    @endif
                </div>
                <div class="flex-1 mt-4 space-y-1 sm:mt-0">
                    <input x-ref="file" type="file" name="village_logo" accept=".jpg,.jpeg,.png,.svg,.webp,image/*"
                        @change="loadPreview($event)"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:rounded-md file:border-0 file:bg-indigo-50 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-indigo-700 hover:file:bg-indigo-100">
                    <p class="text-xs text-gray-400">Ukuran file maksimal 2 MB dengan ekstensi .png, .jpg atau .svg</p>
                    @error('village_logo') <p class="text-xs font-medium text-rose-500">{{ $message }}</p> @enderror
                </div>
            </div>
            <div class="flex flex-wrap items-center justify-end px-6 py-3 border-t border-gray-100 gap-3 bg-gray-50">
                @if (!empty($settings->village_logo))
                    <button type="button" onclick="if (confirm('Hapus logo resmi desa?')) document.getElementById('logo-delete-form').submit()"
                        class="flex items-center justify-center gap-2 px-4 py-2 text-xs font-semibold text-white transition bg-gray-900 rounded-md shadow-sm hover:bg-gray-800">Hapus Logo</button>
                @endif
            </div>
            <div x-show="previewOpen" x-cloak x-transition class="fixed inset-0 z-[100] flex items-center justify-center bg-gray-950/60 p-4" @click.self.prevent="cancelPreview()" @keydown.escape.window="cancelPreview()">
                <div class="overflow-y-auto rounded-xl bg-white p-5 shadow-2xl" style="width: 360px; max-width: calc(100vw - 2rem); max-height: 90vh;">
                    <h3 class="text-base font-bold text-gray-950">Preview Logo Resmi</h3>
                    <div class="mx-auto mt-4 cursor-move select-none overflow-hidden rounded-lg border border-gray-200 bg-gray-50"
                        style="width: 256px; height: 256px; max-width: 100%;"
                        @pointerdown="startDrag($event)" @pointermove="moveDrag($event)" @pointerup="stopDrag()" @pointercancel="stopDrag()">
                        <img :src="preview" alt="Preview logo" class="max-w-none" :style="imageStyle()">
                    </div>
                    <div class="mt-5 flex justify-end gap-3">
                        <button type="button" @click.prevent="cancelPreview()" class="px-4 py-2 text-xs font-semibold text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50">Batal</button>
                        <button type="button" @click.prevent="confirmUpdate()" class="px-4 py-2 text-xs font-semibold text-white bg-gray-900 rounded-md hover:bg-gray-800">Perbarui Logo</button>
                    </div>
                </div>
            </div>
        </form>
        <form id="logo-delete-form" action="{{ route('settings.delete-logo') }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>
