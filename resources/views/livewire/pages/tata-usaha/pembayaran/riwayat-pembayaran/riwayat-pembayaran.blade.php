<div class="p-4 lg:p-8" x-data="{showModal: false}">
    <!-- Header Section -->
    <div class="flex flex-col gap-4 mb-8 md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">
                Riwayat Pembayaran
            </h1>
            <p class="mt-1 text-sm text-gray-600">
                Riwayat transaksi pembayaran SMK AL-Intisab Patokbeusi
            </p>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="p-6 mb-8 bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <form>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Search</label>
                    <div class="relative">
                        <input type="search" wire:model.live="search" placeholder="Cari Siswa..."
                            class="w-full p-2 pl-10 text-sm border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                        <div class="absolute top-1/2 left-3 transform -translate-y-1/2">
                            <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </form>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">Jurusan</label>
                <select wire:model.live="searchJurusan"
                    class="w-full p-2 text-sm border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                    <option value="">Semua Jurusan</option>
                    <option value="">Rekayasa Perangkat Lunak</option>
                </select>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">Kelas</label>
                <select wire:model.live="searchKelas"
                    class="w-full p-2 text-sm border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                    <option value="">Semua Kelas</option>
                    <option value="">X RPL</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th
                            class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Gambar
                        </th>
                        <th
                            class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Nama Siswa
                        </th>
                        <th
                            class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Nisn
                        </th>
                        <th
                            class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Jenis Pembayaran
                        </th>
                        <th
                            class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Total Bayar
                        </th>
                        <th
                            class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Sisa Tagihan
                        </th>
                        <th
                            class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Keterangan
                        </th>
                        <th
                            class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Tanggal Pembayaran
                        </th>
                        <th
                            class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @if ($transaksis->isEmpty())
                    <tr>
                        <td colspan="11" class="px-6 py-4 text-center">
                            <div class="flex flex-col items-center space-y-2 text-gray-500">
                                <i class="fa-solid fa-user-xmark text-4xl text-red-500"></i>
                                <p class="text-lg font-semibold">Riwayat pembayaran tidak ditemukan</p>
                                <p class="text-sm">Pastikan kata kunci pencarian Anda benar atau coba lagi.</p>
                            </div>
                        </td>
                    </tr>
                    @else
                    @foreach ($transaksis as $transaksi)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap cursor-pointer">
                            @if ($transaksi->siswa->foto)
                            <img src="{{ asset('storage/'. $transaksi->siswa->foto) }}"
                                class="w-12 h-12 rounded-lg object-cover" />
                            @else
                            <img src="{{ asset('imgs/component/profile/avatar-man.jpg') }}"
                                class="w-12 h-12 rounded-lg object-cover" />
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                                {{ $transaksi->siswa->name }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ $transaksi->siswa->nisn }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $transaksi->tagihan->jenisPembayaran->nama_pembayaran
                                }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ number_format($transaksi->jumlah_pembayaran,0,',','.')
                                }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $transaksi->sisa_tagihan == 0 ? 'Lunas' :
                                'Rp '.number_format($transaksi->sisa_tagihan,0,',','.') }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $transaksi->keterangan ? $transaksi->keterangan : '-'
                                }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{
                                Carbon\Carbon::parse($transaksi->tgl_pembayaran)->format('d F Y') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span @click="showModal = 'modal-show-transaksi_{{ $transaksi->id }}'"
                                class="text-green-600 font-bold hover:text-green-700 hover:underline cursor-pointer">View
                                Detail</span>
                    </tr>

                    <!-- Transaction Detail Modal -->
                    <div x-show="showModal === 'modal-show-transaksi_{{ $transaksi->id }}'"
                        class="fixed inset-0 bg-gray-500 bg-opacity-75 z-40 flex items-center justify-center p-4"
                        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                        <div class="bg-white rounded-lg max-w-md w-full p-6" @click.away="showModal = false">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">Detail Pembayaran</h3>
                                <button @click="showModal = false" class="text-gray-400 hover:text-gray-500">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Nama Siswa</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $transaksi->siswa->name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">NISN</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $transaksi->siswa->nisn }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Jenis Pembayaran</p>
                                    <p class="mt-1 text-sm">
                                        {{ $transaksi->tagihan->jenisPembayaran->nama_pembayaran }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Total Bayar</p>
                                    <p class="mt-1 text-sm text-green-600 font-semibold">
                                        {{ 'Rp '.number_format($transaksi->jumlah_pembayaran,0,',','.') }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Sisa Tagihan</p>
                                    <p class="mt-1 text-sm text-gray-900">
                                        {{ $transaksi->sisa_tagihan == 0 ? 'Lunas' : 'Rp
                                        '.number_format($transaksi->sisa_tagihan,0,',','.') }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Tanggal Pembayaran</p>
                                    <p class="mt-1 text-sm text-gray-900">
                                        {{ Carbon\Carbon::parse($transaksi->tgl_pembayaran)->format('d F Y') }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Keterangan</p>
                                    <p class="mt-1 text-sm text-gray-900">
                                        {{ $transaksi->keterangan ? $transaksi->keterangan : '-' }}
                                    </p>
                                </div>
                            </div>
                            <div class="mt-6">
                                <button @click="showModal = false"
                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:text-sm">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        {{ $transaksis->links('vendor.pagination.tailwind') }}
    </div>
</div>