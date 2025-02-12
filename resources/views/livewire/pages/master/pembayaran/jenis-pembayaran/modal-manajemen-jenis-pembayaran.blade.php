<div x-data="{ showModal: false }">
    <button @click="showModal = true"
        class="flex items-center px-4 py-2 text-white bg-green-600 rounded-lg hover:bg-green-700 transition duration-200">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Tambah Jenis Pembayaran
    </button>

    <div x-show="showModal" @modal-crud-jenis-pembayaran.window="showModal = true"
        @close-modal-crud-jenis-pembayaran.window="showModal = false"
        class="fixed inset-0 bg-black bg-opacity-50 z-30 flex items-center justify-center p-4" x-transition>
        <div class="bg-white rounded-xl max-w-md w-full p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800">{{ $isEdit == true ? 'Update' : 'Tambah' }} Jenis Pembayaran
                </h3>
                <button type="button" wire:click="resetInput" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <form wire:submit="{{ $isEdit == true ? 'updateJenisPembayaran' : 'tambahJenisPembayaran' }}">
                <x-input name="jenisPembayaran" wire="jenisPembayaran" label="Jenis Pembayaran" required="true" />

                <x-input type="number" name="total" wire="total" label="Total Pembayaran" required="true" />

                <div class="flex justify-end gap-2">
                    <button type="button" wire:click="resetInput" class="px-4 py-2 text-gray-600 hover:text-gray-800">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        {{ $isEdit == true ? 'Update' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>