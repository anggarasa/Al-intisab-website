<div class="p-4 mt-16" x-data="{
        showDeleteModal: false,
        previewImage: @js($logoOld ? asset('storage/' . $logoOld) : null),

        handleImageUpload(event) {
            const file = event.target.files[0];
            if(file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.previewImage = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        },

        resetPreview() {
            this.previewImage = @js($logo ? asset('storage/' . $logo) : null);
        }
    }">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-8 text-center">
            Manajemen Identitas Sekolah
        </h1>

        @if ($identitasSekolahs->isNotEmpty() && !$isEdit)
        <!-- Display Identitas -->
        @foreach ($identitasSekolahs as $identitas)
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-end space-x-4 mb-6">
                <button wire:click="editIdentitas({{ $identitas->id }})"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Edit
                </button>
                <button type="button" wire:click="hapusIdentitas({{ $identitas->id }})"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Hapus
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="flex justify-center">
                    <img src="{{ asset('storage/'. $identitas->logo) }}"
                        class="w-48 h-48 object-cover rounded-lg shadow-md">
                </div>
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
        @else
        <!-- Form Input -->
        <div class="bg-white rounded-lg shadow-md p-6">

            <form wire:submit="{{ $isEdit ? 'updateIdentitas' : 'buatIdentitas' }}" class="space-y-6">
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
                        <input type="file" @change="handleImageUpload" wire:model="logo" accept="image/*" class="hidden"
                            id="logo-upload">
                        <label for="logo-upload"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 cursor-pointer">
                            Pilih File
                        </label>
                    </div>
                </div>

                <!-- Informasi Dasar -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input name="name" label="Nama Sekolah" wire="name" required="true" />
                    </div>

                    <div>
                        <x-input name="npsn" type="number" label="NPSN" wire="npsn" required="true" />
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Alamat Sekolah
                        </label>
                        <textarea name="alamat" wire:model="alamat" placeholder="Jl epres No.1" required rows="2"
                            class="w-full px-3 py-2 border-2 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500"></textarea>
                    </div>

                    <div>
                        <x-input name="kelurahan" label="Kelurahan" wire="kelurahan" required="true" />
                    </div>

                    <div>
                        <x-input name="kecamatan" label="Kecamatan" wire="kecamatan" required="true" />
                    </div>

                    <div>
                        <x-input name="kota" label="Kota" wire="kota" required="true" />
                    </div>

                    <div>
                        <x-input name="provinsi" label="Provinsi" wire="provinsi" required="true" />
                    </div>

                    <div>
                        <x-input name="pos" type="number" label="Kode POS" wire="pos" required="true" />
                    </div>

                    <div>
                        <x-input name="hp" label="No Telpone" wire="hp" required="true" />
                    </div>

                    <div>
                        <x-input name="email" type="email" label="Email" wire="email" required="true" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Akreditasi
                        </label>
                        <select name="akreditasi" wire:model="akreditasi" required
                            class="w-full px-4 py-3 border-2 rounded-xl focus:ring-2 focus:ring-green-300 focus:border-green-400 outline-none transition bg-white/50">
                            <option value="">Pilih Akreditasi</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="Belum Terakreditasi">Belum Terakreditasi</option>
                        </select>
                    </div>

                    <div>
                        <x-input name="kepsek" label="Kepala Sekolah" wire="kepsek" required="true" />
                    </div>
                </div>

                <div class="flex justify-end space-x-5">
                    @if ($isEdit)
                    <button type="button" wire:click="resetInput"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Batal
                    </button>
                    @endif
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        {{ $isEdit ? 'Update' : 'Simpan' }} Identitas
                    </button>
                </div>
            </form>
        </div>
        @endif

    </div>

    <!-- modal delete -->
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
                    <span class="font-medium text-gray-900">{{ $name }}</span>? Tindakan ini
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

    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('reset-preview-image', () => {
                Alpine.data('previewImage', null);
            });
        });
    </script>
</div>