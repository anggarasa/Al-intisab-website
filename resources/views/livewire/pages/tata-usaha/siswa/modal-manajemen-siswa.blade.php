<div x-data="{
    showModal: false,
    showDeleteModal: false,
}">
    <button @click="showModal = true"
        class="flex items-center px-4 py-2 text-white bg-green-600 rounded-lg hover:bg-green-700 transition duration-200">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Tambah Data Siswa
    </button>

    {{-- Modal Crud siswa --}}
    <div x-show="showModal" class="fixed inset-0 z-30 overflow-y-auto" @modal-curd-siswa.window="showModal = true"
        @close-modal-crud-siswa.window="showModal = false" x-cloak>
        <div class="flex items-center justify-center min-h-screen px-4">
            <!-- Overlay -->
            <div class="fixed inset-0 bg-black opacity-50"></div>

            <!-- Modal Content -->
            <div class="relative bg-white rounded-lg w-full max-w-4xl p-6 shadow-xl">
                <!-- Header -->
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">{{ $isEdit == true ? 'Update' : 'Tambah' }} Data Siswa
                    </h2>
                    <button type="button" wire:click="resetInput" class="text-gray-500 hover:text-gray-700">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Form -->
                <form wire:submit="{{ $isEdit == true ? 'updateSiswa' : 'tambahSiswa' }}" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Nama -->
                        <div>
                            <x-input name="name" label="Nama Lengkap" wire="name" required="true" />
                        </div>

                        <!-- Email -->
                        <div>
                            <x-input type="email" name="email" label="Email" wire="email" required="true" />
                        </div>

                        <!-- Password -->
                        <div>
                            <x-password-input name="password" label="Password" wireModel="password"
                                required="{{ $isEdit == true ? 'false' : 'true' }}" />
                        </div>

                        <!-- Confirmasi Password -->
                        <div>
                            <x-password-input name="password_confirmation" label="Konfirmasi Passowrd"
                                wireModel="password_confirmation" required="{{ $isEdit == true ? 'false' : 'true' }}" />
                        </div>

                        <!-- Kelas -->
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Kelas</label>
                            <select wire:model="kelas"
                                class="w-full px-4 py-3 border-2 rounded-xl focus:ring-2 focus:ring-green-300 focus:border-green-400 outline-none transition bg-white/50">
                                <option value="">Pilih Kelas</option>
                                @foreach ($kelases as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Jurusan -->
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Jurusan</label>
                            <select wire:model="jurusan"
                                class="w-full px-4 py-3 border-2 rounded-xl focus:ring-2 focus:ring-green-300 focus:border-green-400 outline-none transition bg-white/50">
                                <option value="">Pilih Jurusan</option>
                                @foreach ($jurusans as $keahlian)
                                <option value="{{ $keahlian->id }}">{{ $keahlian->nama_jurusan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Jenis Kelamin</label>
                            <select wire:model="jenisKelamin"
                                class="w-full px-4 py-3 border-2 rounded-xl focus:ring-2 focus:ring-green-300 focus:border-green-400 outline-none transition bg-white/50">
                                <option value="">Pilih Jenis Kelamin</option>
                                @foreach ($kelamins as $kelamin)
                                <option value="{{ $kelamin->id }}">{{ $kelamin->kelamin }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Agama -->
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Agama</label>
                            <select wire:model="agama"
                                class="w-full px-4 py-3 border-2 rounded-xl focus:ring-2 focus:ring-green-300 focus:border-green-400 outline-none transition bg-white/50">
                                <option value="">Pilih Agama</option>
                                @foreach ($agamass as $kepercayaan)
                                <option value="{{ $kepercayaan->id }}">{{ $kepercayaan->agama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- NISN -->
                        <div>
                            <x-input type="number" name="nisn" label="NISN" wire="nisn" required="true" />
                        </div>

                        <!-- NIK -->
                        <div>
                            <x-input type="number" name="nik" label="NIK" wire="nik" required="true" />
                        </div>

                        <!-- Tempat Lahir -->
                        <div>
                            <x-input type="text" name="tempatLahir" label="Tempat Lahir" wire="tempatLahir"
                                required="true" />
                        </div>

                        <!-- Tanggal Lahir -->
                        <div>
                            <x-input type="date" name="tanggalLahir" label="Tanggal Lahir" wire="tanggalLahir"
                                required="true" />
                        </div>

                        <!-- No HP -->
                        <div>
                            <x-input type="tel" name="noHp" label="No. Handphone" wire="noHp" required="true" />
                        </div>

                        <!-- Foto dengan Preview -->
                        <div class="col-span-2">
                            <x-input-upload-image name="foto" id="foto" label="Upload Foto" />
                        </div>

                        <!-- Nama Ayah -->
                        <div>
                            <x-input type="text" name="namaAyah" label="Nama Ayah" wire="namaAyah" required="true" />
                        </div>

                        <!-- Nama Ibu -->
                        <div>
                            <x-input type="text" name="namaIbu" label="Nama Ibu" wire="namaIbu" required="true" />
                        </div>

                        <!-- Nama Wali -->
                        <div>
                            <x-input type="text" name="namaWali" label="Nama Wali (Opsional)" wire="namaWali" />
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                        <textarea wire:model="alamat" rows="3"
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

    <div x-show="showDeleteModal" @modal-delete-siswa.window="showDeleteModal = true"
        @close-modal-delete-siswa.window="showDeleteModal = false" class="fixed inset-0 z-30 overflow-y-auto"
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
                    <span class="font-medium text-gray-900">{{ $name }}</span>? Tindakan ini
                    tidak
                    dapat dibatalkan.
                </p>

                <div class="flex justify-center space-x-3">
                    <button type="button" wire:click="resetInput"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="button" wire:click="deleteSiswa"
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>