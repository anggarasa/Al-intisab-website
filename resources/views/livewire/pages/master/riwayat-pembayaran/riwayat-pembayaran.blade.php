<div class="p-4 mt-16" x-data="{showSiswaSelector: false, selectedDetail: null}">
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
                            @click="printReceipt"><i class="fas fa-print mr-2"></i>Cetak</button>
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
                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                        <p class="text-sm text-blue-600 font-medium">Total Transaksi</p>
                        <p class="text-lg font-bold text-blue-700">{{ $selectedSiswa->transaksis->count() }}</p>
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
                            <button class="text-blue-600 hover:text-blue-900"
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
    <!-- Empty State when no siswa is selected -->
    <div class="bg-white rounded-lg shadow-sm p-6 md:p-10 text-center">
        <div class="max-w-md mx-auto">
            <!-- Empty state illustration -->
            <div class="mb-6">
                <i class="fas fa-user-graduate text-green-100 text-6xl md:text-7xl"></i>
            </div>

            <!-- Empty state title and description -->
            <h2 class="text-xl md:text-2xl font-bold text-gray-800 mb-3">Pilih Siswa</h2>
            <p class="text-gray-600 mb-8">Silahkan pilih siswa terlebih dahulu untuk melihat detail pembayaran dan
                riwayat transaksi.</p>

            <!-- Search box -->
            <div class="relative mb-6">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <button @click="showSiswaSelector = true"
                    class="w-full pl-10 p-3 text-sm border text-left text-gray-500 border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 hover:border-green-500">
                    Cari berdasarkan nama atau NISN...
                </button>
            </div>

            <!-- Quick filters -->
            <div class="flex flex-wrap justify-center gap-3 mb-8">
                <button
                    class="px-4 py-2 bg-green-50 hover:bg-green-100 text-green-700 rounded-full text-sm font-medium transition border border-green-200"
                    wire:click="filterByKelas('10')">
                    <i class="fas fa-filter mr-1"></i>Kelas 10
                </button>
                <button
                    class="px-4 py-2 bg-green-50 hover:bg-green-100 text-green-700 rounded-full text-sm font-medium transition border border-green-200"
                    wire:click="filterByKelas('11')">
                    <i class="fas fa-filter mr-1"></i>Kelas 11
                </button>
                <button
                    class="px-4 py-2 bg-green-50 hover:bg-green-100 text-green-700 rounded-full text-sm font-medium transition border border-green-200"
                    wire:click="filterByKelas('12')">
                    <i class="fas fa-filter mr-1"></i>Kelas 12
                </button>
            </div>

            <!-- Recent students or info cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-8">
                <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                    <p class="text-sm text-blue-600 font-medium">Total Siswa</p>
                    <p class="text-lg font-bold text-blue-700">{{ $totalSiswa ?? '0' }}</p>
                </div>
                <div class="bg-green-50 p-4 rounded-lg border border-green-100">
                    <p class="text-sm text-green-600 font-medium">Pembayaran Lunas</p>
                    <p class="text-lg font-bold text-green-700">{{ $totalLunas ?? '0' }}</p>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>