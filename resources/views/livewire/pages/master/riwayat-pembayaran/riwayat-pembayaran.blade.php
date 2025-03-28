<div class="p-4 mt-16">
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
                            <input type="date" wire:model="startDate" class="pl-10 px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all w-full" placeholder="Tanggal Mulai" />
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-calendar-alt text-gray-500"></i>
                            </div>
                            <input type="date" wire:model="endDate" class="pl-10 px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all w-full" placeholder="Tanggal Akhir" />
                        </div>
                    </div>

                <button type="submit" wire:loading.attr="disabled" wire:target="applyFilter"
                        class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-lg transition-all flex items-center justify-center relative min-w-[170px]">
                    <span wire:loading.remove wire:target="applyFilter">
                        <i class="fas fa-filter mr-2"></i> Terapkan Filter
                    </span>
                                    <span wire:loading wire:target="applyFilter" class="flex items-center gap-2">
                        <i class="fas fa-spinner fa-spin"></i> Memproses...
                    </span>
                </button>
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
