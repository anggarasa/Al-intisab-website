<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pembayaran Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @page {
            size: A4;
            margin: 0;
        }
        body {
            font-family: 'Arial', sans-serif;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body class="bg-gray-100 p-4">
<div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
    <!-- HEADER SECTION -->
    <header class="w-full bg-white shadow-md">
        <div class="container mx-auto px-4 py-4">
            <div class="flex flex-col md:flex-row items-center">
                <!-- Logo and School Name Section -->
                <div class="flex items-center">
                    <!-- School Logo -->
                    <div class="w-24 h-24 mr-4">
                        <img src="{{ public_path('imgs/logo/logo-yai.png') }}" class="w-full h-full" alt=""/>
                    </div>

                    <!-- School Name and Info -->
                    <div>
                        <p class="text-sm font-semibold uppercase">Yayasan Al Intisabi (PUI)</p>
                        <h1 class="text-2xl font-bold text-sky-500">SMK AL INTISAB</h1>
                        <p class="text-sm font-semibold">NPSN: 69726019 TERAKREDITASI A</p>
                        <div class="text-xs">
                            <p>Teknik Sepeda Motor | Manajemen Perkantoran</p>
                            <p>Layanan Keuangan Syariah | Rekayasa Perangkat Lunak</p>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="md:ml-auto mt-4 md:mt-0 text-right">
                    <p class="text-sm">Jl. Raya Ciberes No. 20</p>
                    <p class="text-sm">Patokbeusi-Subang (41263)</p>
                    <div class="flex items-center justify-end mt-1">
                        <span class="inline-block text-sm mr-2">(0260) 7615251</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-sky-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                            />
                        </svg>
                    </div>
                    <div class="flex items-center justify-end mt-1">
                        <span class="inline-block text-sm mr-2">smk_alintisab@yahoo.co.id</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-sky-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="flex items-center justify-end mt-1">
                        <span class="inline-block text-sm mr-2">smkyai.com</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-sky-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"
                            />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <!-- Blue bar at the bottom -->
        <div class="flex items-center">
            <div class="h-3 bg-sky-400 w-full"></div>
            <div class="h-3 bg-gray-300 w-full"></div>
        </div>
    </header>

    <!-- Data Siswa -->
    <div class="p-6 border-b">
        <h2 class="text-xl font-semibold mb-4">Data Siswa</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <div class="mb-3">
                    <p class="text-gray-600 text-sm">Nama Siswa</p>
                    <p class="font-semibold" id="nama-siswa">{{ $siswa->name }}</p>
                </div>
                <div class="mb-3">
                    <p class="text-gray-600 text-sm">Nomor Induk</p>
                    <p class="font-semibold" id="nisn">{{ $siswa->nisn }}</p>
                </div>
            </div>
            <div>
                <div class="mb-3">
                    <p class="text-gray-600 text-sm">Kelas</p>
                    <p class="font-semibold" id="kelas">{{ $siswa->kelas->nama_kelas }}</p>
                </div>
                <div class="mb-3">
                    <p class="text-gray-600 text-sm">Tanggal Pencetakan</p>
                    <p class="font-semibold" id="tahun-ajaran">{{ \Carbon\Carbon::now()->format('d F Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Pembayaran -->
    <div class="p-6">
        <h2 class="text-xl font-semibold mb-4">Riwayat Pembayaran</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Pembayaran</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="payment-history">
                @php $no = 1; @endphp
                @foreach($transaksis as $transaksi)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $no++ }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::parse($transaksi->tgl_pembayaran)->format('d F Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $transaksi->tagihan->jenisPembayaran->nama_pembayaran }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp {{ number_format($transaksi->jumlah_pembayaran,0,',','.') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $transaksi->keterangan ? $transaksi->keterangan : 'Kosong' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Ringkasan -->
    <div class="p-6 bg-gray-50">
        <h2 class="text-xl font-semibold mb-4">Ringkasan Pembayaran</h2>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-medium text-gray-700 mb-2">Total Pembayaran</h3>
            <div class="flex justify-between items-center">
                <p class="text-gray-600">Total yang sudah dibayar:</p>
                <p class="font-bold text-blue-600" id="total-paid">Rp {{ number_format($transaksis->sum('jumlah_pembayaran'),0,',','.') }}</p>
            </div>
            <div class="flex justify-between items-center mt-1">
                <p class="text-gray-600">Total yang belum dibayar:</p>
                <p class="font-bold text-red-600" id="total-unpaid">Rp {{ number_format($siswa->tagihan->sum('sisa_tagihan'),0,',','.') }}</p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
