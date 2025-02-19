<div class="p-4 mt-16">
    <!-- Header Section -->
    <div class="flex flex-col gap-4 mb-8 md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">
                Input Pembayaran
            </h1>
            <p class="mt-1 text-sm text-gray-600">
                Input pembayaran Smk Al-Intisab
            </p>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="p-6 mb-8 bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">Jurusan</label>
                <select wire:model="searchJurusan" wire:change="handleSearchJurusan($event.target.value)"
                    class="w-full p-2 text-sm border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                    <option value="">Pilih Jurusan</option>
                    @foreach ($jurusans as $jurusan)
                    <option value="{{ $jurusan->id }}">{{ $jurusan->nama_jurusan }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">Kelas</label>
                <select wire:model="searchKelas" wire:change="handleSearchKelas($event.target.value)"
                    class="w-full p-2 text-sm border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                    <option value="">Pilih Kelas</option>
                    @foreach ($kelases as $kelas)
                    <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>

            <form wire:submit="searchSiswa" class="flex items-end gap-4">
                <div class="flex-grow">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Cari Siswa</label>
                    <div class="relative">
                        <input type="search" wire:model.defer="search"
                            class="w-full p-2 pl-10 text-sm border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500"
                            placeholder="Cari Nama, Email, atau NISN...">
                        <div class="absolute top-1/2 left-3 transform -translate-y-1/2">
                            <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                        </div>
                    </div>
                </div>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg">Cari</button>
            </form>
        </div>
    </div>

    {{-- form input & detail siswa --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Card Input -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Form Pembayaran</h2>

            <form x-data="{
                    nisn: '',
                    kelas: '',
                    jenisPembayaran: '',
                    jumlahPembayaran: '',
                    tanggalPembayaran: '',
                    keterangan: ''
                }">
                <div class="space-y-4">
                    <!-- NISN -->
                    <div class="flex flex-col md:flex-row md:items-center gap-4">
                        <label class="w-full md:w-1/3 text-gray-700 font-medium">NISN</label>
                        <input type="text" value="{{ $siswaTerpilih->nisn ?? '' }}" readonly
                            class="w-full md:w-2/3 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition" />
                    </div>

                    <!-- Kelas -->
                    <div class="flex flex-col md:flex-row md:items-center gap-4">
                        <label class="w-full md:w-1/3 text-gray-700 font-medium">Kelas</label>
                        <input type="text" value="{{ $siswaTerpilih->kelas->nama_kelas ?? '' }}" readonly
                            class="w-full md:w-2/3 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition" />
                    </div>

                    <!-- Jenis Pembayaran -->
                    <div class="flex flex-col md:flex-row md:items-center gap-4">
                        <label class="w-full md:w-1/3 text-gray-700 font-medium">Jenis Pembayaran</label>
                        <select x-model="jenisPembayaran"
                            class="w-full md:w-2/3 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition">
                            <option value="">Pilih Jenis Pembayaran</option>
                            <option value="SPP">SPP</option>
                            <option value="Uang Gedung">Uang Gedung</option>
                            <option value="Praktikum">Praktikum</option>
                        </select>
                    </div>

                    <!-- Jumlah Pembayaran -->
                    <div class="flex flex-col md:flex-row md:items-center gap-4">
                        <label class="w-full md:w-1/3 text-gray-700 font-medium">Jumlah Pembayaran</label>
                        <input type="number" x-model="jumlahPembayaran"
                            class="w-full md:w-2/3 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                            placeholder="Rp." />
                    </div>

                    <!-- Tanggal Pembayaran -->
                    <div class="flex flex-col md:flex-row md:items-center gap-4">
                        <label class="w-full md:w-1/3 text-gray-700 font-medium">Tanggal Pembayaran</label>
                        <input type="date" x-model="tanggalPembayaran"
                            class="w-full md:w-2/3 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition" />
                    </div>

                    <!-- Keterangan -->
                    <div class="flex flex-col md:flex-row md:items-start gap-4">
                        <label class="w-full md:w-1/3 text-gray-700 font-medium">Keterangan</label>
                        <textarea x-model="keterangan" rows="3"
                            class="w-full md:w-2/3 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                            placeholder="Tambahkan keterangan..."></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end mt-6">
                        <button type="submit"
                            class="px-6 py-2 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300 transition">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Card Profile -->
        @if ($siswaTerpilih)
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Profil Siswa</h2>
            <div class="flex flex-col items-center">
                <div class="w-32 h-32 bg-gray-200 rounded-full overflow-hidden mb-4">
                    <img src="{{ $siswaTerpilih->foto ? asset('storage/'. $siswaTerpilih->foto) : asset('imgs/component/profile/avatar-man.jpg') }}"
                        class="w-full h-full object-cover">
                </div>
                <div class="w-full space-y-4">
                    <div class="flex flex-col items-center">
                        <h3 class="text-xl font-semibold text-gray-800">{{ $siswaTerpilih->name }}</h3>
                        <p class="text-gray-600">{{ $siswaTerpilih->user->email }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">NISN</span>
                            <span class="font-medium text-gray-800">{{ $siswaTerpilih->nisn }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Kelas</span>
                            <span class="font-medium text-gray-800">{{ $siswaTerpilih->kelas->nama_kelas }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Jurusan</span>
                            <span class="font-medium text-gray-800">{{ $siswaTerpilih->kelas->jurusan->nama_jurusan
                                }}</span>
                        </div>
                    </div>

                    <!-- Status Pembayaran -->
                    <div class="bg-yellow-50 rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <span class="text-yellow-600 font-medium">Sisa Pembayaran</span>
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-600 rounded-full text-sm font-medium">{{
                                number_format($siswaTerpilih->tagihan->sisa_tagihan,0,',','.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>