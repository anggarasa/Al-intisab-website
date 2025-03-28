<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laporan Pembayaran Siswa - SMK AL INTISAB</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap");

        body {
            font-family: "Inter", sans-serif;
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {
            body {
                width: 210mm;
                height: 297mm;
            }

            .page-break {
                page-break-after: always;
            }

            .no-print-break {
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body class="bg-white w-[210mm] mx-auto shadow-md">
<div class="a4-page">
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

    <!-- REPORT TITLE -->
    <div class="pt-6 pb-4 px-6">
        <h2 class="text-xl font-bold text-center uppercase">Laporan Pembayaran Siswa & Siswi</h2>
{{--        <p class="text-center text-gray-600">Tahun Ajaran 2023/2024</p>--}}
    </div>

    <!-- REPORT INFO -->
    <div class="pl-6 mb-4">
        <p class="text-sm"><span class="font-semibold">Tanggal Laporan:</span> <span id="current-date">{{ \Carbon\Carbon::now()->format('d F Y') }}</span></p>
        <p class="text-sm"><span class="font-semibold">Periode:</span> {{ \Carbon\Carbon::parse($startDate)->format('d F Y') }} -
            {{ \Carbon\Carbon::parse($endDate)->format('d F Y') }}</p>
    </div>

    <!-- PAYMENT TABLE -->
    <div class="px-6 mb-6">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200">
                        No
                    </th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200">
                        NISN
                    </th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200">
                        Nama Siswa
                    </th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200">
                        Kelas
                    </th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200">
                        Tanggal
                    </th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200">
                        Jenis Pembayaran
                    </th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200">
                        Total Pembayaran
                    </th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @php $no = 1; @endphp
                @foreach($transaksis as $transaksi)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 text-sm">{{ $no++}}</td>
                        <td class="px-4 py-2 text-sm">{{ $transaksi->siswa->nisn }}</td>
                        <td class="px-4 py-2 text-sm font-medium">{{ $transaksi->siswa->name }}</td>
                        <td class="px-4 py-2 text-sm">{{ $transaksi->siswa->kelas->nama_kelas }}</td>
                        <td class="px-4 py-2 text-sm">{{ date('d F Y', $transaksi->tgl_transaksi) }}</td>
                        <td class="px-4 py-2 text-sm">
                            {{ $transaksi->tagihan->jenisPembayaran->nama_pembayaran }}
                        </td>
                        <td class="px-4 py-2 text-sm">
                            Rp {{ number_format($transaksi->jumlah_pembayaran,0,',','.') }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr class="bg-gray-50">
                    <td colspan="6" class="px-4 py-3 text-sm font-semibold text-right">Total:</td>
                    <td class="px-4 py-3 text-sm font-semibold">
                        Rp {{ number_format($transaksis->sum('jumlah_pembayaran'), 0, ',', '.') }}
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
</body>
</html>
