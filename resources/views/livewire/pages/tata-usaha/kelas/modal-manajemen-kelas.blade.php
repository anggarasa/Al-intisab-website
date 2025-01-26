<div x-data="{ showModal: false, showDeleteModal: false }">
    <!-- Button untuk membuka modal -->
    <button @click="showModal = true"
        class="flex items-center px-4 py-2 text-white bg-green-600 rounded-lg hover:bg-green-700 transition duration-200">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Tambah Kelas
    </button>

    <!-- Modal -->
    <div x-show="showModal" @modal-kelas.window="showModal = true" @close-modal-kelas.window="showModal = false"
        class="fixed inset-0 z-50 overflow-y-auto" style="display: none">
        <div class="flex items-center justify-center min-h-screen px-4">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-black opacity-40"></div>

            <!-- Modal Content -->
            <div class="relative bg-white rounded-lg shadow-xl max-w-md w-full p-6 space-y-6">
                <!-- Header -->
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-gray-900">
                        {{ $isEdit == true ? 'Update' : 'Tambah Kelas' }}
                    </h3>
                    <button wire:click="resetInput" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Form -->
                <form wire:submit="{{ $isEdit == true ? 'updateKelas' : 'createKelas' }}" class="space-y-4">
                    <!-- Input Nama Kelas -->
                    <div>
                        <x-input name="nama_kelas" label="Nama Kelas" wire="nama_kelas"
                            placeholder="Masukkan nama kelas" required="true" />
                    </div>

                    <!-- Select Jurusan -->
                    <div>
                        <label for="jurusan" class="block text-sm font-medium text-gray-700 mb-1">
                            Jurusan
                        </label>
                        <select id="jurusan" wire:model="jurusan"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white">
                            <option value="" selected>Pilih Jurusan</option>
                            @foreach ($jurusans as $jurusan)
                            <option value="{{ $jurusan->id }}">{{ $jurusan->nama_jurusan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" wire:click="resetInput"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition duration-300">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-lg transition duration-300">
                            {{ $isEdit == true ? 'Update' : 'Simpan' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-show="showDeleteModal" @modal-delete-kelas.window="showDeleteModal = true"
        @close-modal-delete-kelas.window="showDeleteModal = false" class="fixed inset-0 z-50 overflow-y-auto"
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
                    <span class="font-medium text-gray-900">{{ $nama_kelas }}</span>? Tindakan ini
                    tidak
                    dapat dibatalkan.
                </p>

                <div class="flex justify-center space-x-3">
                    <button type="button" @click="showDeleteModal = false"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="button" wire:click="deleteKelas"
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>