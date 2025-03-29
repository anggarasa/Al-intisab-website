<div class="p-4 mt-16" x-data="{ showSiswaSelector: false, modalDetail: null }">
    <!-- select siswa -->
    <div class="bg-white rounded-lg shadow p-4 mb-6 print:hidden">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="w-full md:w-auto flex items-center gap-2">
                <label class="text-sm text-gray-600 whitespace-nowrap font-medium">Pilih Siswa:</label>
                <div class="relative w-96 flex-1">
                    <button
                        type="button"
                        @click="showSiswaSelector = true"
                        class="w-full flex items-center justify-between bg-white border border-gray-300 rounded-lg px-3 py-2 text-left text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                    >
                        <span>Pilih Siswa/Siswi</span>
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div
                        x-show="showSiswaSelector"
                        @modal-select-siswa.window="showSiswaSelector = false"
                        @click.away="showSiswaSelector = false"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute z-10 mt-1 w-full bg-white shadow-lg rounded-lg py-1 max-h-60 overflow-auto"
                    >
                        <div class="p-2">
                            <input type="search" placeholder="Cari siswa..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-green-500 focus:border-green-500" wire:model.live="searchSiswa" />
                        </div>
                        @forelse($siswas as $siswa)
                            <button wire:click="setSelectedSiswa({{ $siswa->id }})" class="w-full text-left px-4 py-2 {{ $selectedSiswa ? $selectedSiswa->id == $siswa->id ? 'bg-green-100' : '' : 'hover:bg-gray-100' }} flex items-center gap-3">
                                <img src="{{ $siswa->foto ? asset('storage/'. $siswa->foto) : asset('imgs/component/profile/avatar-man.jpg') }}" class="w-8 h-8 rounded-full object-cover" alt="{{ $siswa->name }}" />
                                <div>
                                    <p class="font-medium text-gray-900">{{ $siswa->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $siswa->nisn . ' - ' . $siswa->kelas->nama_kelas }}</p>
                                </div>
                            </button>
                        @empty
                        <div class="px-4 py-2 text-sm text-gray-500">Tidak ada siswa yang ditemukan</div>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="w-full md:w-auto flex items-center gap-2">
                <button @click="showSiswaSelector = true"
                        class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-md text-sm font-medium transition shadow-sm w-full md:w-auto">
                    <i class="fas fa-search mr-2"></i>Cari Siswa/Siswi Lain
                </button>
                @if($selectedSiswa)
                <button
                    wire:click="clearSelectedSiswa"
                    class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-md text-sm font-medium transition shadow-sm w-full md:w-auto">
                    <i class="fas fa-times mr-2"></i>Cancel
                </button>
                @endif
            </div>
        </div>
    </div>

    @if($selectedSiswa)
        <!-- Info Siswa -->
        <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
            <div class="md:flex">
                <div class="md:flex-shrink-0 p-4 md:p-6 flex justify-center md:justify-start">
                    <img class="h-32 w-32 rounded-full object-cover border-4 border-green-100" src="{{ $selectedSiswa->foto ? asset('storage/'. $selectedSiswa->foto) : asset('imgs/component/profile/avatar-man.jpg') }}" alt="{{ $selectedSiswa->name }}" />
                </div>
                <div class="p-4 md:p-6 md:flex-1">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-start">
                        <div>
                            <h2 class="text-xl md:text-2xl font-bold text-gray-800">{{ $selectedSiswa->name }}</h2>
                            <p class="text-gray-600"><span>{{ $selectedSiswa->kelas->nama_kelas }}</span> • NISN: <span>{{ $selectedSiswa->nisn }}</span></p>
                        </div>
                        <div class="mt-4 md:mt-0 flex space-x-2">
                            <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md text-sm font-medium transition shadow-sm disabled:opacity-50 disabled:cursor-not-allowed inline-flex items-center"
                                    wire:click="perSiswaPdf"
                                    wire:loading.attr="disabled"
                                    wire:target="perSiswaPdf">

                                <!-- Tombol normal (sembunyi saat loading) -->
                                <span class="inline-flex items-center" wire:loading.remove wire:target="perSiswaPdf">
                                    <i class="fas fa-print mr-2"></i>Cetak
                                </span>

                                <!-- Animasi loading menggunakan FontAwesome -->
                                <span class="inline-flex items-center space-x-2" wire:loading wire:target="perSiswaPdf">
                                    <i class="fas fa-spinner fa-spin"></i>
                                    <span>Mencetak...</span>
                                </span>
                            </button>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-green-50 p-4 rounded-lg border border-green-100">
                            <p class="text-sm text-green-600 font-medium">Total Pembayaran</p>
                            <p class="text-lg font-bold text-green-700">Rp {{ number_format($selectedSiswa->tagihan->sum('total_tagihan'),0,',','.') }}</p>
                        </div>
                        <div class="bg-red-50 p-4 rounded-lg border border-red-100">
                            <p class="text-sm text-red-600 font-medium">Belum Lunas</p>
                            <p class="text-lg font-bold text-red-700">Rp {{ number_format($selectedSiswa->tagihan->sum('sisa_tagihan'),0,',','.') }}</p>
                        </div>
                        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                            <p class="text-sm text-blue-600 font-medium">Total Transaksi</p>
                            <p class="text-lg font-bold text-blue-700">{{ $pembayarans->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter dan Pencarian -->
        <div class="p-6 mb-8 bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Jenis Pembayaran</label>
                    <select wire:model.live="searchJenisPembayaran" class="w-full p-2 text-sm border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                        <option value="">Semua Jenis Pembayaran</option>
                        @foreach ($jenisPembayarans as $jenisPembayaran)
                            <option value="{{ $jenisPembayaran->id }}">{{ $jenisPembayaran->nama_pembayaran }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Status</label>
                    <select wire:model.live="searchStatus" class="w-full p-2 text-sm border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                        <option value="">Pilih Status</option>
                        <option value="lunas">Lunas</option>
                        <option value="belum lunas">Belum Lunas</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Tabel Pembayaran -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Transaksi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider print:hidden">Aksi</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($pembayarans as $transaksi)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                #{{ $transaksi->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $transaksi->tagihan->jenisPembayaran->nama_pembayaran }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($transaksi->tgl_pembayaran)->format('d F Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Rp {{ number_format($transaksi->jumlah_pembayaran,0,',','.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                              <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $transaksi->tagihan->sisa_tagihan == 0 ? 'bg-green-50 text-green-800' : 'bg-red-50 text-red-800' }}">
                                  {{ $transaksi->tagihan->sisa_tagihan == 0 ? 'Lunas' : 'Belum Lunas' }}
                              </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium print:hidden">
                                <button @click="modalDetail = 'modal-detail_{{ $transaksi->id }}'" class="text-blue-600 hover:text-blue-900">Detail</button>
                            </td>
                        </tr>

                        <!-- Detail Pembayaran Modal -->
                        <div
                            x-show="modalDetail === 'modal-detail_{{ $transaksi->id }}'"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4 print:hidden"
                        >
                            <div
                                @click.away="modalDetail = null"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform scale-95"
                                x-transition:enter-end="opacity-100 transform scale-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 transform scale-100"
                                x-transition:leave-end="opacity-0 transform scale-95"
                                class="bg-white rounded-lg shadow-xl max-w-lg w-full mx-auto max-h-[90vh] overflow-y-auto"
                            >
                                <div class="border-b border-gray-200 p-4 flex justify-between items-center">
                                    <h3 class="text-lg font-medium text-gray-900">Detail Pembayaran</h3>
                                    <button @click="modalDetail = null" class="text-gray-400 hover:text-gray-500">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <div class="p-6">
                                    <div class="mb-6 flex justify-between items-center">
                                        <h3 class="text-xl font-bold text-gray-900">{{ $transaksi->tagihan->jenisPembayaran->nama_pembayaran }}</h3>
                                        <span
                                            class="px-3 py-1 text-sm font-semibold rounded-full {{ $transaksi->tagihan->sisa_tagihan == 0 ? 'bg-green-50 text-green-800' : 'bg-red-50 text-red-800' }}"
                                        >
                                        {{ $transaksi->tagihan->sisa_tagihan == 0 ? 'Lunas' : 'Belum Lunas' }}
                                    </span>
                                    </div>

                                    <div class="space-y-4">
                                        <div class="flex justify-between border-b border-gray-100 pb-3">
                                            <span class="text-gray-600">ID Transaksi</span>
                                            <span class="font-medium text-gray-900">
                                            #{{ $transaksi->id }}
                                        </span>
                                        </div>
                                        <div class="flex justify-between border-b border-gray-100 pb-3">
                                            <span class="text-gray-600">Tanggal</span>
                                            <span class="font-medium text-gray-900">
                                            {{ \Carbon\Carbon::parse($transaksi->tgl_pembayaran)->format('d F Y') }}
                                        </span>
                                        </div>
                                        <div class="flex justify-between border-b border-gray-100 pb-3">
                                            <span class="text-gray-600">Jumlah</span>
                                            <span class="font-medium text-gray-900">
                                            {{ number_format($transaksi->jumlah_pembayaran,0,',','.') }}
                                        </span>
                                        </div>
                                        <div class="flex justify-between border-b border-gray-100 pb-3">
                                            <span class="text-gray-600">Keterangan</span>
                                            <span class="font-medium text-gray-900">
                                            {{ $transaksi->keterangan ? $transaksi->keterangan : '-' }}
                                        </span>
                                        </div>
                                    </div>

                                    <div class="mt-8 flex justify-end space-x-3">
                                        <button @click="modalDetail = null" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                            Tutup
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-search text-gray-300 text-4xl mb-3"></i>
                                    <p>Tidak ada data yang sesuai dengan pencarian.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <!-- Filter Section -->
        <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-sm p-4 md:p-6 mb-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 md:mb-0">Filter Pembayaran</h2>

                <form wire:submit="applyFilter" class="flex flex-col md:flex-row gap-4">
                    <div class="flex flex-col sm:flex-row gap-2">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-calendar-alt text-gray-500"></i>
                            </div>
                            <input type="date" wire:model="startDate"
                                   class="pl-10 px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all w-full"
                                   placeholder="Tanggal Mulai"/>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-calendar-alt text-gray-500"></i>
                            </div>
                            <input type="date" wire:model="endDate"
                                   class="pl-10 px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all w-full"
                                   placeholder="Tanggal Akhir"/>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" wire:loading.attr="disabled" wire:target="applyFilter"
                                class="bg-green-600 hover:bg-green-700 text-white py-2 px-6 rounded-lg transition-all flex items-center justify-center relative min-w-[170px]">
                        <span wire:loading.remove wire:target="applyFilter">
                            <i class="fas fa-filter mr-2"></i> Terapkan Filter
                        </span>
                            <span wire:loading wire:target="applyFilter" class="flex items-center gap-2">
                            <i class="fas fa-spinner fa-spin"></i> Memproses...
                        </span>
                        </button>
                        <button type="button" wire:click="resetFilter"
                                wire:loading.attr="disabled"
                                wire:target="resetFilter"
                                class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-6 rounded-lg transition-all flex items-center justify-center relative"
                                @if(!$startDate && !$endDate) style="display: none;" @endif>
                            <i class="fas fa-times mr-2"></i> Reset Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Search and Export -->
        <div class="p-4 md:p-6 border-b border-gray-100 flex flex-col sm:flex-row gap-4 justify-between">
            <div class="relative w-full sm:w-72">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <i class="fas fa-search text-gray-500"></i>
                </div>
                <input
                    type="search"
                    wire:model.live="search"
                    class="pl-10 w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all"
                    placeholder="Cari berdasarkan nama/NISN..."
                />
            </div>

            <button wire:click="cetakPdf" wire:loading.attr="disabled" wire:target="cetakPdf"
                    class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg transition-all flex items-center justify-center relative min-w-[150px]">
            <span wire:loading.remove wire:target="cetakPdf">
                <i class="fas fa-file-pdf mr-2"></i> Export PDF
            </span>
                <span wire:loading wire:target="cetakPdf" class="flex items-center gap-2">
                <i class="fas fa-spinner fa-spin"></i> Mengunduh...
            </span>
            </button>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full min-w-full" id="paymentTable">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NISN</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Siswa</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Pembayaran</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @php $no = 1; @endphp
                @forelse($pembayarans as $index => $pembayaran)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $no++  }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ \Carbon\Carbon::parse($pembayaran->tgl_pembayaran)->translatedFormat('d F Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $pembayaran->siswa->nisn }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-8 w-8 rounded-full mr-3">
                                    <img src="{{ $pembayaran->siswa->foto ? asset('storage/'. $pembayaran->siswa->foto) : asset('imgs/component/profile/avatar-man.jpg') }}" class="w-full h-full object-cover rounded-full" alt="{{ $pembayaran->siswa->name }}">
                                </div>
                                <div class="text-sm font-medium text-gray-900">{{ $pembayaran->siswa->name }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $pembayaran->siswa->kelas->nama_kelas }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $pembayaran->tagihan->jenisPembayaran->nama_pembayaran }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ number_format($pembayaran->jumlah_pembayaran,0,',','.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                    <span
                        class="px-2 py-1 text-xs rounded-full {{ $pembayaran->tagihan->sisa_tagihan == 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}"
                    >
                        {{ $pembayaran->tagihan->sisa_tagihan == 0 ? 'Lunas' : 'Belum Lunas' }}
                    </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            <div class="flex space-x-2">
                                <button @click="modalDetail = 'modal-detail_{{ $pembayaran->id }}'" class="text-blue-600 hover:text-blue-800" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Detail Pembayaran Modal -->
                    <div
                        x-show="modalDetail === 'modal-detail_{{ $pembayaran->id }}'"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4 print:hidden"
                    >
                        <div
                            @click.away="modalDetail = null"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="bg-white rounded-lg shadow-xl max-w-lg w-full mx-auto max-h-[90vh] overflow-y-auto"
                        >
                            <div class="border-b border-gray-200 p-4 flex justify-between items-center">
                                <h3 class="text-lg font-medium text-gray-900">Detail Pembayaran</h3>
                                <button @click="modalDetail = null" class="text-gray-400 hover:text-gray-500">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="p-6">
                                <div class="mb-6 flex justify-between items-center">
                                    <h3 class="text-xl font-bold text-gray-900">{{ $pembayaran->siswa->name }}</h3>
                                    <span
                                        class="text-xl font-bold text-gray-900"
                                    >
                                        {{ $pembayaran->siswa->kelas->nama_kelas }}
                                    </span>
                                </div>

                                <div class="mb-6 flex justify-between items-center">
                                    <h3 class="text-xl text-gray-900">{{ $pembayaran->tagihan->jenisPembayaran->nama_pembayaran }}</h3>
                                    <span
                                        class="px-3 py-1 text-sm font-semibold rounded-full {{ $pembayaran->tagihan->sisa_tagihan == 0 ? 'bg-green-50 text-green-800' : 'bg-red-50 text-red-800' }}"
                                    >
                                        {{ $pembayaran->tagihan->sisa_tagihan == 0 ? 'Lunas' : 'Belum Lunas' }}
                                    </span>
                                </div>

                                <div class="space-y-4">
                                    <div class="flex justify-between border-b border-gray-100 pb-3">
                                        <span class="text-gray-600">ID Transaksi</span>
                                        <span class="font-medium text-gray-900">
                                            #{{ $pembayaran->id }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between border-b border-gray-100 pb-3">
                                        <span class="text-gray-600">Tanggal</span>
                                        <span class="font-medium text-gray-900">
                                            {{ \Carbon\Carbon::parse($pembayaran->tgl_pembayaran)->format('d F Y') }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between border-b border-gray-100 pb-3">
                                        <span class="text-gray-600">Jumlah</span>
                                        <span class="font-medium text-gray-900">
                                            {{ number_format($pembayaran->jumlah_pembayaran,0,',','.') }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between border-b border-gray-100 pb-3">
                                        <span class="text-gray-600">Keterangan</span>
                                        <span class="font-medium text-gray-900">
                                            {{ $pembayaran->keterangan ? $pembayaran->keterangan : '-' }}
                                        </span>
                                    </div>
                                </div>

                                <div class="mt-8 flex justify-end space-x-3">
                                    <button @click="modalDetail = null" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                        Tutup
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="9" class="px-6 py-10 text-center text-gray-500">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-search text-gray-300 text-4xl mb-3"></i>
                                <p class="text-lg font-medium">Tidak ada data pembayaran ditemukan</p>
                                <p class="text-sm text-gray-500 mt-1">Coba ubah filter atau pencarian Anda</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        {{ $pembayarans->links('vendor.pagination.tailwind') }}
    @endif
</div>
