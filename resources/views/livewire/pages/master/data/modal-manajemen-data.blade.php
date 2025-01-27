<div>
    {{-- Modal crud gender --}}
    <div x-data="{ showModal: false }" x-show="showModal" @modal-crud-gender.window="showModal = true"
        @close-modal-crud-gender.window="showModal = false"
        class="fixed inset-0 bg-black bg-opacity-50 z-30 flex items-center justify-center p-4" x-transition>
        <div class="bg-white rounded-xl max-w-md w-full p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800">{{ $isEdit == true ? 'Update': 'Tambah' }} Gender</h3>
                <button type="button" wire:click="resetInput" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <form wire:submit="{{ $isEdit == true ? 'updateGender' : 'tambahGender' }}">

                <select wire:model="gender"
                    class="w-full px-4 py-2 border rounded-lg mb-4 focus:outline-none focus:ring-green-500 focus:border-green-500">
                    <option value="">Pilih Gender</option>
                    <option value="laki-Laki">Laki-Laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>

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

    {{-- Modal crud agama --}}
    <div x-data="{ showModal: false }" x-show="showModal" @modal-crud-agama.window="showModal = true"
        @close-modal-crud-agama.window="showModal = false"
        class="fixed inset-0 bg-black bg-opacity-50 z-30 flex items-center justify-center p-4" x-transition>
        <div class="bg-white rounded-xl max-w-md w-full p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800">{{ $isEdit == true ? 'Update' : 'Tambah' }} Agama</h3>
                <button type="button" wire:click="resetInput" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <form wire:submit="{{ $isEdit == true ? 'updateAgama' : 'tambahAgama' }}">
                <input type="text" wire:model="agama" placeholder="Masukkan agama"
                    class="w-full px-4 py-2 border rounded-lg mb-4 focus:outline-none focus:ring-green-500 focus:border-green-500" />
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

    <div x-data="{ showModal: false }" x-show="showModal" @modal-crud-ptk.window="showModal = true"
        @close-modal-crud-ptk.window="showModal = false"
        class="fixed inset-0 bg-black bg-opacity-50 z-30 flex items-center justify-center p-4" x-transition>
        <div class="bg-white rounded-xl max-w-md w-full p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800">{{ $isEdit == true ? 'Update' : 'Tambah' }} Jenis PTK</h3>
                <button type="button" wire:click="resetInput" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <!-- PTK Forms -->
            <form wire:submit="{{ $isEdit == true ? 'updatePtk' : 'tambahPtk' }}">
                <input type="text" wire:model="ptk" placeholder="Nama PTK"
                    class="w-full px-4 py-2 border rounded-lg mb-4 focus:outline-none focus:ring-green-500 focus:border-green-500" />

                <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                <textarea wire:model="ptkKet" rows="3"
                    class="w-full px-3 py-2 mb-4 border-2 rounded-lg focus:ring-2 focus:ring-green-300 focus:border-green-400 outline-none transition bg-white/50"></textarea>

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

    {{-- Modal Delete data manajemen --}}
    <div x-data="{ modalDelete: false }" x-show="modalDelete" @modal-delete-data.window="modalDelete = true"
        @close-modal-delete-data.window="modalDelete = false" class="fixed inset-0 z-30 overflow-y-auto"
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
                    <span class="font-medium text-gray-900">{{ $deleteName }}</span>? Tindakan ini
                    tidak
                    dapat dibatalkan.
                </p>

                <div class="flex justify-center space-x-3">
                    <button type="button" wire:click="resetInput"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="button" wire:click="deleteData"
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>