<div x-data="fileUpload">
    <label for="{{ $id ?? $name }}" class="block text-gray-700 text-sm font-bold mb-2">
        {{ $label ?? 'Upload Gambar' }}
    </label>

    <!-- Preview Images -->
    <div class="flex flex-wrap gap-4">
        <template x-for="(preview, index) in previews" :key="index">
            <div class="relative w-32 h-32">
                <img :src="preview" alt="Preview Image" class="object-cover w-full h-full rounded-lg" />
            </div>
        </template>
    </div>

    <!-- Pesan jika harus memilih ulang -->
    <div x-show="previews.length > 0" class="mt-2 text-sm text-gray-500">
        Anda harus memilih ulang jika ingin mengganti gambar yang akan diupload.
    </div>

    <!-- Upload Input -->
    <div class="flex items-center justify-center w-full mt-4">
        <label
            class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:bg-gray-50">
            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                <svg class="w-8 h-8 mb-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                    </path>
                </svg>
                <p class="mb-2 text-sm text-gray-500">
                    Klik untuk upload gambar
                </p>
                <p class="text-xs text-gray-500">
                    PNG, JPG atau JPEG (MAX. 2MB, Maksimal 4 gambar)
                </p>
            </div>
            <input type="file" id="{{ $id ?? $name }}" name="{{ $name }}[]" wire:model.live="{{ $name }}"
                accept="image/*" class="hidden" @change="handleFiles($event.target.files)" />
        </label>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('fileUpload', () => ({
            previews: [],

            init() {
                Livewire.on('setOldImages', (images) => {
                    const flattenedImages = images.flat();
                    this.$nextTick(() => {
                        this.previews = flattenedImages.filter(url => typeof url === 'string');
                    });
                });

                // Tambahkan listener untuk close modal
                Livewire.on('resetFileUpload', () => {
                    this.clearPreviews();
                });
            },

            handleFiles(files) {
                if (files.length > 4) {
                    alert('Maksimal 4 gambar');
                    this.clearPreviews();
                    return;
                }

                this.clearPreviews();
                Array.from(files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = e => {
                        this.$nextTick(() => {
                            this.previews.push(e.target.result);
                        });
                    };
                    reader.readAsDataURL(file);
                });
            },

            clearPreviews() {
                this.previews = [];
            }
        }));
    });
</script>