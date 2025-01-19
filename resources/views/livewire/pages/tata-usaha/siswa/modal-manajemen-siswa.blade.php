<div x-data="{
    showModal: false,
    imagePreview: null,
    formData: {foto: null},
    previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                this.formData.foto = file;
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.imagePreview = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        },
        clearImage() {
            this.imagePreview = null;
            this.formData.foto = null;
            document.getElementById('fotoInput').value = '';
        }
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
                    <h2 class="text-2xl font-bold text-green-500">Tambah Data Siswa</h2>
                    <button type="button" wire:click="resetInput" class="text-gray-500 hover:text-gray-700">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Form -->
                <form wire:submit="tambahSiswa" class="space-y-4">
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
                            {{--
                            <x-password-input name="password" label="Password" wireModel="password" /> --}}
                            <x-input type="password" name="password" label="Password" wire="password" required="true" />
                        </div>

                        <!-- Confirmasi Password -->
                        <div>
                            {{--
                            <x-password-input name="confirmPassword" label="Konfirmasi Passowrd"
                                wireModel="confirmPassword" /> --}}
                            <x-input type="password" name="password_confirmation" label="Konfirmasi Password"
                                wire="password_confirmation" required="true" />
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

                        <!-- NIK -->
                        <div>
                            <x-input type="number" name="nik" label="NIK" wire="nik" required="true" />
                        </div>

                        <!-- No HP -->
                        <div>
                            <x-input type="tel" name="noHp" label="No. Handphone" wire="noHp" required="true" />
                        </div>

                        <!-- Foto dengan Preview -->
                        <div class="col-span-2">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Foto</label>
                            <div class="flex items-start space-x-4">
                                <div class="flex-1">
                                    <input type="file" wire:model="foto" id="fotoInput" accept="image/*"
                                        @change="previewImage"
                                        class="w-full px-4 py-3 border-2 rounded-xl file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 focus:ring-2 focus:ring-green-300 focus:border-green-400 outline-none transition bg-white/50" />
                                </div>
                                <!-- Preview Container -->
                                <div x-show="imagePreview" class="relative">
                                    <img :src="imagePreview"
                                        class="h-32 w-32 object-cover rounded-lg border-2 border-green-500" />
                                    <button type="button" @click="clearImage"
                                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 focus:outline-none">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
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
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>