<div class="p-4 mt-16">
    <!-- Header Section -->
    <div class="flex flex-col gap-4 mb-8 md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">
                Management Identitas Sekolah
            </h1>
            <p class="mt-1 text-sm text-gray-600">
                Kelola identitas sekolah Smk Al-Intisab
            </p>
        </div>
        @if ($identitasSekolahs->isEmpty())
        <button @click="$dispatch('modal-curd-identitas')"
            class="flex items-center px-4 py-2 text-white bg-green-600 rounded-lg hover:bg-green-700 transition duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Buat Identitas Sekolah
        </button>
        @endif
    </div>

    @if ($identitasSekolahs && $identitasSekolahs->isNotEmpty())
    <!-- Main Content -->
    <div class="pt-14 pb-12 px-4 sm:px-6 lg:px-8">
        @foreach ($identitasSekolahs as $identitas)
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-end mb-4">
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-edit mr-2"></i>Edit
                </button>
                <button type="button" wire:click="hapusIdentitas({{ $identitas->id }})"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">
                    <i class="fas fa-trash-alt mr-2"></i>Delete
                </button>
            </div>

            <!-- Header Card -->
            <div
                class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8 transform hover:scale-[1.01] transition-transform duration-300">
                <div class="bg-gradient-to-r from-green-600 to-green-400 px-6 py-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            <h2 class="text-3xl font-bold text-white mb-2">{{ $identitas->nama_sekolah }}</h2>
                            <p class="text-green-50">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                <span>{{ $identitas->kabupaten_kota }}</span>, <span>{{ $identitas->provinsi }}</span>
                            </p>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <span class="bg-white px-4 py-2 rounded-full text-green-600 font-semibold shadow-md">
                                <i class="fas fa-award mr-2"></i>Akreditasi <span>{{ $identitas->akreditasi }}</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                <!-- NPSN Card -->
                <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center space-x-4">
                        <div class="bg-green-100 p-3 rounded-full">
                            <i class="fas fa-id-card text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">NPSN</p>
                            <p class="font-semibold text-lg">{{ $identitas->npsn }}</p>
                        </div>
                    </div>
                </div>

                <!-- Kepala Sekolah Card -->
                <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center space-x-4">
                        <div class="bg-green-100 p-3 rounded-full">
                            <i class="fas fa-user-tie text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Kepala Sekolah</p>
                            <p class="font-semibold text-lg">{{ $identitas->kepala_sekolah }}</p>
                        </div>
                    </div>
                </div>

                <!-- Alamat Card -->
                <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-start space-x-4">
                        <div class="bg-green-100 p-3 rounded-full">
                            <i class="fas fa-map-marked-alt text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm mb-2">Alamat Lengkap</p>
                            <p class="text-gray-800">
                                <span>{{ $identitas->alamat_sekolah }}</span><br>
                                Kel. <span>{{ $identitas->kelurahan }}</span>,
                                Kec. <span>{{ $identitas->kecamatan }}</span><br>
                                <span>{{ $identitas->kabupaten_kota }}</span>,
                                <span>{{ $identitas->provinsi }}</span><br>
                                Kode Pos: <span>{{ $identitas->kode_pos }}</span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Kontak Card -->
                <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-start space-x-4">
                        <div class="bg-green-100 p-3 rounded-full">
                            <i class="fas fa-address-book text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm mb-2">Kontak</p>
                            <p class="text-gray-800">
                                <i class="fas fa-phone-alt mr-2 text-green-600"></i><span>{{ $identitas->no_telpone
                                    }}</span><br>
                                <i class="fas fa-envelope mr-2 text-green-600"></i><span>{{ $identitas->email
                                    }}</span><br>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="flex items-center justify-center p-6 rounded-xl bg-white">
        <div class="text-center">
            <div class="relative inline-block">
                <img alt="Error Data Kosong!" class="w-full h-full mx-auto"
                    src="{{ asset('imgs/component/identitas/identitas-sekolah.svg') }}" />
            </div>
            <h1 class="mt-6 text-4xl font-bold text-gray-700">
                Data kosong!
            </h1>
            <p class="mt-2 text-xl text-gray-500">
                Silakan buat data indentitas sekolah.
            </p>
        </div>
    </div>
    @endif

    <livewire:pages.master.identitas.modal-manajemen-identitas-sekolah />
</div>