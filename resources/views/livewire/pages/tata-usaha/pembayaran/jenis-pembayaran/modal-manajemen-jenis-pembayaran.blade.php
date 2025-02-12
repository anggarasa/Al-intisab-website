<div x-data="{ showModal: false, showDeleteModal: false }">
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

    <!-- Delete Confirmation Modal -->
    <div x-show="showDeleteModal" @modal-delete-jenis-pembayaran.window="showDeleteModal = true"
        @close-modal-delete-jenis-pembayaran.window="showDeleteModal = false" class="fixed inset-0 z-50 overflow-y-auto"
        style="display: none">
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>
        <div class="relative flex items-center justify-center min-h-screen p-4">
            <div class="relative w-full max-w-md p-6 bg-white rounded-xl shadow-lg">
                <div class="flex items-center justify-center mb-6">
                    <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                            </path>
                        </svg>
                    </div>
                </div>

                <h3 class="text-lg font-medium text-center text-gray-900 mb-4">
                    Konfirmasi Hapus
                </h3>
                <p class="text-sm text-center text-gray-500 mb-6">
                    Apakah Anda yakin ingin menghapus
                    <span class="font-medium text-gray-900">{{ $jenisPembayaran }}</span>? Tindakan ini
                    tidak
                    dapat dibatalkan.
                </p>

                <div class="flex justify-center space-x-3">
                    <button type="button" wire:click="resetInput"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="button" wire:click="deleteJenisPembayaran"
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>