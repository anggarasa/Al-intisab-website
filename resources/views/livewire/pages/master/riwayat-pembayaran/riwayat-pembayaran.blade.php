<div class="p-4 mt-16">
    <!-- Filter Section -->
    <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-sm p-4 md:p-6 mb-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 md:mb-0">Filter Pembayaran</h2>

            <div class="flex flex-col md:flex-row gap-4">
                <div>
                    <select x-model="filterType" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                        <option value="custom">Kustom (Rentang Tanggal)</option>
                        <option value="monthly">Bulanan</option>
                    </select>
                </div>

                <template x-if="filterType === 'custom'">
                    <div class="flex flex-col sm:flex-row gap-2">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-calendar-alt text-gray-500"></i>
                            </div>
                            <input type="date" x-model="startDate" class="pl-10 px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all w-full" placeholder="Tanggal Mulai" />
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-calendar-alt text-gray-500"></i>
                            </div>
                            <input type="date" x-model="endDate" class="pl-10 px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all w-full" placeholder="Tanggal Akhir" />
                        </div>
                    </div>
                </template>

                <template x-if="filterType === 'monthly'">
                    <div class="flex gap-2">
                        <div class="w-full">
                            <select x-model="selectedMonth" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
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
                            <select x-model="selectedYear" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                            </select>
                        </div>
                    </div>
                </template>

                <button @click="applyFilter" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-lg transition-all flex items-center justify-center"><i class="fas fa-filter mr-2"></i> Terapkan Filter</button>
            </div>
        </div>

        <div class="flex flex-wrap gap-4 mt-6">
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 flex items-center gap-3">
            <span class="text-blue-700 text-sm font-medium">
              <template x-if="filterType === 'custom'">
                <span> <span x-text="formatDateDisplay(startDate)"></span> s/d <span x-text="formatDateDisplay(endDate)"></span> </span>
              </template>
              <template x-if="filterType === 'monthly'">
                <span> <span x-text="getMonthName(selectedMonth)"></span> <span x-text="selectedYear"></span> </span>
              </template>
            </span>
                <button @click="resetFilter" class="text-blue-700 hover:text-blue-900">
                    <i class="fas fa-times-circle"></i>
                </button>
            </div>

            <div class="bg-emerald-50 border border-emerald-200 rounded-lg p-3">
                <span class="text-emerald-700 text-sm font-medium">Total: <span x-text="formatCurrency(calculateTotal())"></span></span>
            </div>
        </div>
    </div>

    <!-- Search and Export -->
    <div class="p-4 md:p-6 border-b border-gray-100 flex flex-col sm:flex-row gap-4 justify-between">
        <div class="relative w-full sm:w-72">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <i class="fas fa-search text-gray-500"></i>
            </div>
            <input
                type="text"
                x-model="searchTerm"
                @input="searchPayments"
                class="pl-10 w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                placeholder="Cari berdasarkan nama/NIS..."
            />
        </div>

        <button wire:click="cetakPdfs" wire:loading.attr="disabled"
                class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg transition-all flex items-center justify-center relative">
            <span wire:loading.remove>
                <i class="fas fa-file-pdf mr-2"></i> Export PDF
            </span>
                    <span wire:loading class="absolute inset-0 flex items-center justify-center">
                <i class="fas fa-spinner fa-spin"></i>
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
                        {{ date('d F Y', $pembayaran->tgl_transaksi)  }}
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
                            <button class="text-blue-600 hover:text-blue-800" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </td>
                </tr>
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
