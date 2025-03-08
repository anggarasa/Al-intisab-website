<div class="p-4 mt-16">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-8 text-center">
            Manajemen Identitas Sekolah
        </h1>

        <!-- Form Input -->
        @if (empty($identitasSekolahs))
        <div class="bg-white rounded-lg shadow-md p-6">

            <form wire:submit="buatIdentitas" class="space-y-6">
                <!-- Logo Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Logo Sekolah
                    </label>
                    <div class="flex items-center space-x-4">
                        <div
                            class="w-32 h-32 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center">
                            <template x-if="!previewImage">
                                <div class="text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <p class="text-xs text-gray-500 mt-1">Upload Logo</p>
                                </div>
                            </template>
                            <template x-if="previewImage">
                                <img :src="previewImage" class="w-full h-full object-cover rounded-lg" />
                            </template>
                        </div>
                        <input type="file" @change="handleImageUpload" accept="image/*" class="hidden" id="logo-upload">
                        <label for="logo-upload"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 cursor-pointer">
                            Pilih File
                        </label>
                    </div>
                </div>

                <!-- Informasi Dasar -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Sekolah
                        </label>
                        <input type="text" name="nama" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            NPSN
                        </label>
                        <input type="text" name="npsn" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Alamat Sekolah
                        </label>
                        <textarea name="alamat" required rows="2"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Kelurahan
                        </label>
                        <input type="text" name="kelurahan" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Kecamatan
                        </label>
                        <input type="text" name="kecamatan" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Kota
                        </label>
                        <input type="text" name="kota" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Provinsi
                        </label>
                        <input type="text" name="provinsi" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Kode Pos
                        </label>
                        <input type="text" name="kodePos" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            No Telepon
                        </label>
                        <input type="tel" name="telepon" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Email
                        </label>
                        <input type="email" name="email" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Akreditasi
                        </label>
                        <select name="akreditasi" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Pilih Akreditasi</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="Belum Terakreditasi">Belum Terakreditasi</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Kepala Sekolah
                        </label>
                        <input type="text" name="kepalaSekolah" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Simpan Identitas
                    </button>
                </div>
            </form>
        </div>
        @endif

        <!-- Display Identitas -->
        @if ($identitasSekolahs)
        @foreach ($identitasSekolahs as $identitas)
        <div class="bg-white rounded-lg shadow-md p-6">

            <div class="flex justify-end space-x-4 mb-6">
                <button @click="editIdentitas"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Edit
                </button>
                <button @click="deleteIdentitas"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Hapus
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Logo -->
                <div class="flex justify-center">
                    <img src="{{ asset('storage/'. $identitas->logo) }}"
                        class="w-48 h-48 object-cover rounded-lg shadow-md">
                </div>

                <!-- Informasi Dasar -->
                <div class="md:col-span-2 space-y-4">
                    <h2 class="text-2xl font-bold text-gray-800">{{ $identitas->nama_sekolah }}</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">NPSN</p>
                            <p class="font-medium">{{ $identitas->npsn }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Akreditasi</p>
                            <p class="font-medium">{{ $identitas->akreditasi }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Kepala Sekolah</p>
                            <p class="font-medium">{{ $identitas->kepala_sekolah }}</p>
                        </div>
                    </div>

                    <div class="pt-4">
                        <p class="text-sm text-gray-500">Alamat Lengkap</p>
                        <p class="font-medium">
                            <span>{{ $identitas->alamat_sekolah }}</span><br>
                            Kel. <span>{{ $identitas->kelurahan }}</span>,
                            Kec. <span>{{ $identitas->kecamatan }}</span><br>
                            <span>{{ $identitas->kabupaten_kota }}</span>,
                            <span>{{ $identitas->provinsi }}</span>
                            <span>{{ $identitas->kode_pos }}</span>
                        </p>
                    </div>

                    <div class="pt-4">
                        <p class="text-sm text-gray-500">Kontak</p>
                        <p class="font-medium">
                            Telp: <span>{{ $identitas->no_telpone }}</span><br>
                            Email: <span>{{ $identitas->email }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>