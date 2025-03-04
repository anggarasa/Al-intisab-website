<div x-data="{
    showModal: false,
    showDeleteModal: false,
}">

    {{-- Modal Crud siswa --}}
    <div x-show="showModal" class="fixed inset-0 z-30 overflow-y-auto" @modal-curd-identitas.window="showModal = true"
        @close-modal-crud-identitas.window="showModal = false" x-cloak>
        <div class="flex items-center justify-center min-h-screen px-4">
            <!-- Overlay -->
            <div class="fixed inset-0 bg-black opacity-50"></div>

            <!-- Modal Content -->
            <div class="relative bg-white rounded-lg w-full max-w-4xl p-6 shadow-xl">
                <!-- Header -->
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">{{ $isEdit == true ? 'Update' : 'Buat' }} Identitas
                        Sekolah
                    </h2>
                    <button type="button" wire:click="resetInput" class="text-gray-500 hover:text-gray-700">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Form -->
                <form wire:submit="{{ $isEdit == true ? 'updateIdentitasSekolah' : 'buatIdentitas' }}"
                    class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Nama -->
                        <div>
                            <x-input name="name" label="Nama Sekolah" wire="name" placeholder="Nama Sekolah"
                                required="true" />
                        </div>

                        <!-- Nama Kepala sekolah -->
                        <div>
                            <x-input name="kepala_sekolah" label="Nama Kepala Sekolah" wire="kepala_sekolah"
                                placeholder="John Doe" required="true" />
                        </div>

                        <!-- Email -->
                        <div>
                            <x-input type="email" name="email" label="Email" wire="email"
                                placeholder="emailsekolah@example.com" required="true" />
                        </div>

                        <!-- No HP -->
                        <div>
                            <x-input type="tel" name="noHp" label="No. Handphone" wire="noHp" placeholder="081233456789"
                                required="true" />
                        </div>

                        <!-- NPSN -->
                        <div>
                            <x-input type="number" name="npsn" label="NPSN" wire="npsn" placeholder="123456789"
                                required="true" />
                        </div>

                        <!-- Kelurahan -->
                        <div>
                            <x-input type="text" name="kelurahan" label="Kelurahan" wire="kelurahan"
                                placeholder="Nama Kelurahan" required="true" />
                        </div>

                        <!-- Kecamatam -->
                        <div>
                            <x-input type="text" name="kecamatan" label="Kecamatam" wire="kecamatan"
                                placeholder="Nama Kecamatan" required="true" />
                        </div>

                        <!-- Kab/Kota -->
                        <div>
                            <x-input type="text" name="kota" label="Kab/Kota" wire="kota" placeholder="Nama Kota"
                                required="true" />
                        </div>

                        <!-- Provinsi -->
                        <div>
                            <x-input type="text" name="provinsi" label="Provinsi" wire="provinsi"
                                placeholder="Nama Provinsi" required="true" />
                        </div>

                        <!-- Kode Pos -->
                        <div>
                            <x-input type="text" name="pos" label="Kode Pos" wire="pos" placeholder="42312"
                                required="true" />
                        </div>

                        <!-- Akreditasi -->
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Nilai Akreditasi</label>
                            <select wire:model="akreditasi"
                                class="w-full px-4 py-3 border-2 rounded-xl focus:ring-2 focus:ring-green-300 focus:border-green-400 outline-none transition bg-white/50">
                                <option value="">Pilih Akreditasi</option>
                                <option value="TT">TT (Tidak Terakreditasi)</option>
                                <option value="C">C (Cukup)</option>
                                <option value="B">B (Baik)</option>
                                <option value="A">A (Sangat Baik)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Sekolah</label>
                        <textarea wire:model="alamat" rows="3" placeholder="Jl.epres No.1"
                            class="w-full px-3 py-2 border-2 rounded-lg focus:ring-2 focus:ring-green-300 focus:border-green-400 outline-none transition bg-white/50"></textarea>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" wire:click="resetInput"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                            {{ $isEdit == true ? 'Update' : 'Simpan' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div x-show="showDeleteModal" @modal-delete-identitas.window="showDeleteModal = true"
        @close-modal-delete-identitas.window="showDeleteModal = false" class="fixed inset-0 z-30 overflow-y-auto"
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
                    <span class="font-medium text-gray-900">Identitas Sekolah</span>? Tindakan ini
                    tidak
                    dapat dibatalkan.
                </p>

                <div class="flex justify-center space-x-3">
                    <button type="button" wire:click="resetInput"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="button" wire:click="deleteIdentitas"
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>