<div class="p-4 mt-16" x-data="{showSiswaSelector: false, selectedDetail: null,}">
    <!-- Filter Siswa -->
    <div class="bg-white rounded-lg shadow p-4 mb-6 print:hidden">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="w-full md:w-auto flex items-center gap-2">
                <label class="text-sm text-gray-600 whitespace-nowrap font-medium">Pilih Siswa:</label>
                <div class="relative w-96 flex-1">
                    <button type="button" @click="showSiswaSelector = true"
                        class="w-full flex items-center justify-between bg-white border border-gray-300 rounded-lg px-3 py-2 text-left text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        <span>
                            {{ $selectedSiswa ? $selectedSiswa->name : 'Pilih siswa' }}
                            {{ $selectedSiswa ? '- ' . $selectedSiswa->nisn : '' }}
                        </span>
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div x-show="showSiswaSelector" @click.away="showSiswaSelector = false"
                        @modal-search-siswa.window="showSiswaSelector = false"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute z-10 mt-1 w-full bg-white shadow-lg rounded-lg py-1 max-h-60 overflow-auto">
                        <div class="p-2">
                            <input type="text" placeholder="Cari siswa..."
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-green-500"
                                wire:model.live="searchSiswa" />
                        </div>
                        @forelse ($siswas as $siswa)
                        <button wire:click="setSiswa({{ $siswa->id }})"
                            class="w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center gap-3 {{ $selectedSiswa ? $siswa->id == $selectedSiswa->id ? 'bg-green-100' : '' : '' }}">
                            <img src="{{ $siswa->foto ? asset('storage/'.$siswa->foto) : asset('imgs/component/profile/avatar-man.jpg') }}"
                                class="w-8 h-8 rounded-full" alt="{{ $siswa->name }}" />
                            <div>
                                <p class="font-medium text-gray-900">{{ $siswa->name }}</p>
                                <p class="text-sm text-gray-500">{{ $siswa->nisn . ' - ' . $siswa->kelas->nama_kelas }}
                                </p>
                            </div>
                        </button>
                        @empty
                        <div class="px-4 py-2 text-sm text-gray-500">
                            Tidak ada siswa yang ditemukan
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
            <button @click="showSiswaSelector = true"
                class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-md text-sm font-medium transition shadow-sm w-full md:w-auto"><i
                    class="fas fa-search mr-2"></i>Cari Siswa Lain</button>
        </div>
    </div>

    <!-- Selected siswa -->
    @if ($selectedSiswa)
    <!-- Info Siswa -->
    <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
        <div class="md:flex">
            <div class="md:flex-shrink-0 p-4 md:p-6 flex justify-center md:justify-start">
                <img class="h-32 w-32 rounded-full object-cover border-4 border-green-100"
                    src="{{ $selectedSiswa->foto ? asset('storage/'. $selectedSiswa->foto) : asset('imgs/component/profile/avatar-man.jpg') }}"
                    alt="{{ $selectedSiswa->name }}" />
            </div>
            <div class="p-4 md:p-6 md:flex-1">
                <div class="flex flex-col md:flex-row md:justify-between md:items-start">
                    <div>
                        <h2 class="text-xl md:text-2xl font-bold text-gray-800">{{ $selectedSiswa->name }}</h2>
                        <p class="text-gray-600">
                            <span>{{ $selectedSiswa->kelas->nama_kelas }}</span>
                            • NISN: <span>{{ $selectedSiswa->nisn }}</span>
                        </p>
                    </div>
                    <div class="mt-4 md:mt-0 flex space-x-2">
                        <button
                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md text-sm font-medium transition shadow-sm"
                            wire:click="cetakPdfAll"><i class="fas fa-print mr-2"></i>Cetak</button>
                        <button
                            class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md text-sm font-medium transition shadow-sm"><i
                                class="fas fa-envelope mr-2"></i>Email</button>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-green-50 p-4 rounded-lg border border-green-100">
                        <p class="text-sm text-green-600 font-medium">Total Pembayaran</p>
                        <p class="text-lg font-bold text-green-700">
                            Rp {{ number_format($selectedSiswa->tagihan->sum('total_tagihan'),0,',','.') }}
                        </p>
                    </div>
                    <div class="bg-red-50 p-4 rounded-lg border border-red-100">
                        <p class="text-sm text-red-600 font-medium">Belum Lunas</p>
                        <p class="text-lg font-bold text-red-700">
                            Rp {{ number_format($selectedSiswa->tagihan->sum('sisa_tagihan'),0,',','.') }}
                        </p>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg border border-green-100">
                        <p class="text-sm text-green-600 font-medium">Total Transaksi</p>
                        <p class="text-lg font-bold text-green-700">{{ $selectedSiswa->transaksis->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="p-6 mb-8 bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">Jenis Pembayaran</label>
                <select wire:model.live="searchJenisPembayaran"
                    class="w-full p-2 text-sm border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                    <option value="">Semua Jenis Pembayaran</option>
                    @foreach ($jenisPembayarans as $jenisPembayaran)
                    <option value="{{ $jenisPembayaran->id }}">{{ $jenisPembayaran->jenisPembayaran->nama_pembayaran }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">Status</label>
                <select wire:model.live="searchStatus"
                    class="w-full p-2 text-sm border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                    <option value="">Semua Status</option>
                    <option value="Lunas">Lunas</option>
                    <option value="Belum Lunas">Belum Lunas</option>
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
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID
                            Transaksi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Jumlah</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status</th>
                        <th
                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider print:hidden">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($transaksis as $transaksi)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            #TRX{{ $transaksi->id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $transaksi->tagihan->jenisPembayaran->nama_pembayaran }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ date('d F Y', strtotime($transaksi->tgl_pembayaran)) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ number_format($transaksi->jumlah_pembayaran,0,',','.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                {{ $transaksi->status === 'Lunas' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $transaksi->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium print:hidden">
                            <button class="text-green-600 hover:text-green-900"
                                @click="selectedDetail = 'modal-show-transaksi_{{ $transaksi->id }}'">
                                Detail
                            </button>
                        </td>
                    </tr>

                    <!-- Detail Pembayaran Modal -->
                    <div x-show="selectedDetail === 'modal-show-transaksi_{{ $transaksi->id }}'"
                        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4 print:hidden">
                        <div @click.away="selectedDetail = null" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="bg-white rounded-lg shadow-xl max-w-lg w-full mx-auto max-h-[90vh] overflow-y-auto">
                            <div class="border-b border-gray-200 p-4 flex justify-between items-center">
                                <h3 class="text-lg font-medium text-gray-900">Detail Pembayaran</h3>
                                <button @click="selectedDetail = null" class="text-gray-400 hover:text-gray-500">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="p-6">
                                <div class="mb-6 flex justify-between items-center">
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900">
                                            {{ $transaksi->tagihan->jenisPembayaran->nama_pembayaran }}
                                        </h3>
                                    </div>
                                    <span
                                        class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $transaksi->status === 'Lunas' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $transaksi->status }}
                                    </span>
                                </div>

                                <div class="space-y-4">
                                    <div class="flex justify-between border-b border-gray-100 pb-3">
                                        <span class="text-gray-600">ID Transaksi</span>
                                        <span class="font-medium text-gray-900">#TRX{{ $transaksi->id }}</span>
                                    </div>
                                    <div class="flex justify-between border-b border-gray-100 pb-3">
                                        <span class="text-gray-600">Tanggal</span>
                                        <span class="font-medium text-gray-900">
                                            {{ date('d F Y', strtotime($transaksi->tgl_pembayaran)) }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between border-b border-gray-100 pb-3">
                                        <span class="text-gray-600">Jumlah</span>
                                        <span class="font-medium text-gray-900">
                                            Rp {{ number_format($transaksi->jumlah_pembayaran,0,',','.') }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between border-b border-gray-100 pb-3">
                                        <span class="text-gray-600">Keterangan</span>
                                        <span class="font-medium text-gray-900">
                                            {{ $transaksi->keterangan ?? '-' }}
                                        </span>
                                    </div>
                                </div>

                                <div class="mt-8 flex justify-end space-x-3">
                                    <button @click="selectedDetail = null"
                                        class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                        Tutup
                                    </button>
                                    <button
                                        class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-md text-sm font-medium focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                        <i class="fas fa-print mr-2"></i>Cetak
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-500">
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
        {{ $transaksis->links('vendor.pagination.tailwind') }}
    </div>
    @else
    <!-- Filter Section -->
    <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-sm p-4 md:p-6 mb-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 md:mb-0">Filter Pembayaran</h2>

            <div class="flex flex-col md:flex-row gap-4">
                <div>
                    <select wire:model.live="filterType"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all">
                        <option value="custom">Kustom (Rentang Tanggal)</option>
                        <option value="monthly">Bulanan</option>
                    </select>
                </div>

                @if ($filterType === 'custom')
                <div class="flex flex-col sm:flex-row gap-2">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fas fa-calendar-alt text-gray-500"></i>
                        </div>
                        <input type="date" x-model="startDate"
                            class="pl-10 px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all w-full"
                            placeholder="Tanggal Mulai" />
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fas fa-calendar-alt text-gray-500"></i>
                        </div>
                        <input type="date" x-model="endDate"
                            class="pl-10 px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all w-full"
                            placeholder="Tanggal Akhir" />
                    </div>
                </div>
                @else
                <div class="flex gap-2">
                    <div class="w-full">
                        <select x-model="selectedMonth"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all">
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    <div class="w-full">
                        <select x-model="selectedYear"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all">
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                        </select>
                    </div>
                </div>
                @endif

                <button @click="applyFilter"
                    class="bg-green-600 hover:bg-green-700 text-white py-2 px-6 rounded-lg transition-all flex items-center justify-center"><i
                        class="fas fa-filter mr-2"></i> Terapkan Filter</button>
            </div>
        </div>

        <div class="flex flex-wrap gap-4 mt-6">
            <div class="bg-green-50 border border-green-200 rounded-lg p-3 flex items-center gap-3">
                <span class="text-green-700 text-sm font-medium">
                    @if ($filterType === 'custom')
                    <span>
                        <span x-text="formatDateDisplay(startDate)"></span>
                        s/d
                        <span x-text="formatDateDisplay(endDate)"></span>
                    </span>
                    @else
                    <span>
                        <span x-text="getMonthName(selectedMonth)"></span>
                        <span x-text="selectedYear"></span>
                    </span>
                    @endif
                </span>
                <button @click="resetFilter" class="text-green-700 hover:text-green-900">
                    <i class="fas fa-times-circle"></i>
                </button>
            </div>

            <div class="bg-emerald-50 border border-emerald-200 rounded-lg p-3">
                <span class="text-emerald-700 text-sm font-medium">Total: <span
                        x-text="formatCurrency(calculateTotal())"></span></span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-sm overflow-hidden">
        <!-- Search and Export -->
        <div class="p-4 md:p-6 border-b border-gray-100 flex flex-col sm:flex-row gap-4 justify-between">
            <div class="relative w-full sm:w-72">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <i class="fas fa-search text-gray-500"></i>
                </div>
                <input type="text" x-model="searchTerm" @input="searchPayments"
                    class="pl-10 w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                    placeholder="Cari berdasarkan nama/NIS..." />
            </div>

            <div class="flex gap-2">
                <button @click="exportToExcel"
                    class="bg-emerald-600 hover:bg-emerald-700 text-white py-2 px-4 rounded-lg transition-all flex items-center justify-center"><i
                        class="fas fa-file-excel mr-2"></i> Export Excel</button>
                <button @click="exportToPDF"
                    class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg transition-all flex items-center justify-center"><i
                        class="fas fa-file-pdf mr-2"></i> Export PDF</button>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full min-w-full" id="paymentTable">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                            Siswa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis
                            Pembayaran</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Jumlah</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($pembayarans as $index => $pembayaran)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $pembayarans->firstItem() + $index }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ date('d F Y', strtotime($pembayaran->tgl_pembayaran)) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $pembayaran->siswa->nisn }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-8 w-8 mr-3">
                                    <img src="{{ $pembayaran->siswa->foto ? asset('storage/'. $pembayaran->siswa->foto) : asset('imgs/component/profile/avatar-man.jpg') }}"
                                        alt="{{ $pembayaran->siswa->name }}"
                                        class="w-full h-full object-cover rounded-full">
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
                            Rp {{ number_format($pembayaran->jumlah_pembayaran,0,',','.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 py-1 text-xs rounded-full {{ $pembayaran->tagihan->sisa_tagihan == 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $pembayaran->tagihan->sisa_tagihan == 0 ? 'Lunas' : 'Belum Lunas' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            <button @click="selectedDetail = 'modal-detail-transaksi_{{ $pembayaran->id }}'"
                                class="text-blue-600 hover:text-blue-800">
                                Detail
                            </button>
                        </td>
                    </tr>

                    <!-- Detail Pembayaran Modal -->
                    <div x-show="selectedDetail === 'modal-detail-transaksi_{{ $pembayaran->id }}'"
                        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4 print:hidden">
                        <div @click.away="selectedDetail = null" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="bg-white rounded-lg shadow-xl max-w-lg w-full mx-auto max-h-[90vh] overflow-y-auto">
                            <div class="border-b border-gray-200 p-4 flex justify-between items-center">
                                <h3 class="text-lg font-medium text-gray-900">Detail Pembayaran</h3>
                                <button @click="selectedDetail = null" class="text-gray-400 hover:text-gray-500">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="p-6">
                                <div class="mb-6 flex justify-between items-center">
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900">
                                            {{ $pembayaran->tagihan->jenisPembayaran->nama_pembayaran }}
                                        </h3>
                                    </div>
                                    <span
                                        class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $pembayaran->tagihan->sisa_tagihan == 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $pembayaran->tagihan->sisa_tagihan == 0 ? 'Lunas' : 'Belum Lunas' }}
                                    </span>
                                </div>

                                <div class="space-y-4">
                                    <div class="flex justify-between border-b border-gray-100 pb-3">
                                        <span class="text-gray-600">ID pembayaran</span>
                                        <span class="font-medium text-gray-900">#TRX{{ $pembayaran->id }}</span>
                                    </div>
                                    <div class="flex justify-between border-b border-gray-100 pb-3">
                                        <span class="text-gray-600">Tanggal</span>
                                        <span class="font-medium text-gray-900">
                                            {{ date('d F Y', strtotime($pembayaran->tgl_pembayaran)) }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between border-b border-gray-100 pb-3">
                                        <span class="text-gray-600">Jumlah</span>
                                        <span class="font-medium text-gray-900">
                                            Rp {{ number_format($pembayaran->jumlah_pembayaran,0,',','.') }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between border-b border-gray-100 pb-3">
                                        <span class="text-gray-600">Keterangan</span>
                                        <span class="font-medium text-gray-900">
                                            {{ $pembayaran->keterangan ?? '-' }}
                                        </span>
                                    </div>
                                </div>

                                <div class="mt-8 flex justify-end space-x-3">
                                    <button @click="selectedDetail = null"
                                        class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                        Tutup
                                    </button>
                                    <button
                                        class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-md text-sm font-medium focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                        <i class="fas fa-print mr-2"></i>Cetak
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
    </div>
    @endif
</div>