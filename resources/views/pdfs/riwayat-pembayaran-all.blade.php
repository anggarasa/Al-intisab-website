<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SMK AL INTISAB</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  {{-- Font Awesome Icons --}}
  <script src="https://kit.fontawesome.com/9d4da73c07.js" crossorigin="anonymous"></script>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap");

    body {
      font-family: "Inter", sans-serif;
    }
  </style>
</head>

<body>
  <header class="w-full bg-white shadow-md">
    <div class="container mx-auto px-4 py-4">
      <div class="flex flex-col md:flex-row items-center">
        <!-- Logo and School Name Section -->
        <div class="flex items-center">
          <!-- School Logo -->
          <div class="w-24 h-24 mr-4">
            <img src="{{ asset('imgs/logo/logo-yai.png') }}" class="w-full h-full object-cover"
              alt="SMK Al-Intisab Patokbeusi">
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
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-sky-400" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
          </div>
          <div class="flex items-center justify-end mt-1">
            <span class="inline-block text-sm mr-2">smk_alintisab@yahoo.co.id</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-sky-400" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
          </div>
          <div class="flex items-center justify-end mt-1">
            <span class="inline-block text-sm mr-2">smkyai.com</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-sky-400" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
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

  <div class="p-8">
    <!-- Informasi Laporan -->
    <div class="mb-4">
      <div>
        <p><span class="font-semibold">Periode:</span> 1 Maret 2025 - 22 Maret 2025</p>
        <p><span class="font-semibold">Dicetak pada:</span> {{ date('d F Y') }}</p>
      </div>
    </div>

    <!-- Tabel Laporan -->
    <table class="w-full border-collapse border border-gray-300 mb-6">
      <thead>
        <tr class="bg-gray-100">
          <th class="border border-gray-300 px-3 py-2 text-left">No.</th>
          <th class="border border-gray-300 px-3 py-2 text-left">Tanggal</th>
          <th class="border border-gray-300 px-3 py-2 text-left">NISN</th>
          <th class="border border-gray-300 px-3 py-2 text-left">Nama Siswa</th>
          <th class="border border-gray-300 px-3 py-2 text-left">Kelas</th>
          <th class="border border-gray-300 px-3 py-2 text-left">Jenis Pembayaran</th>
          <th class="border border-gray-300 px-3 py-2 text-right">Jumlah (Rp)</th>
        </tr>
      </thead>
      <tbody>
        <!-- Baris data -->
        @php
        $no = 1;
        @endphp
        @foreach ($pembayarans as $pembayaran)
        <tr>
          <td class="border border-gray-300 px-3 py-2">{{ $no++ }}</td>
          <td class="border border-gray-300 px-3 py-2">{{ date('d F Y', strtotime($pembayaran->tgl_pembayaran)) }}</td>
          <td class="border border-gray-300 px-3 py-2">{{ $pembayaran->siswa->nisn }}</td>
          <td class="border border-gray-300 px-3 py-2">{{ $pembayaran->siswa->name }}</td>
          <td class="border border-gray-300 px-3 py-2">{{ $pembayaran->siswa->kelas->nama_kelas }}</td>
          <td class="border border-gray-300 px-3 py-2">{{ $pembayaran->tagihan->jenisPembayaran->nama_pembayaran }}</td>
          <td class="border border-gray-300 px-3 py-2 text-right">Rp {{
            number_format($pembayaran->jumlah_pembayaran,0,',','.') }}</td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr class="bg-gray-200 font-semibold">
          <td class="border border-gray-300 px-3 py-2 text-right" colspan="6">Total</td>
          <td class="border border-gray-300 px-3 py-2 text-right">Rp {{
            number_format($pembayarans->sum('jumlah_pembayaran'),0,',','.') }}</td>
        </tr>
      </tfoot>
    </table>

    <!-- Ringkasan -->
    <div class="grid grid-cols-2 gap-4 mb-6">
      <div class="border border-gray-300 p-4 rounded">
        <h3 class="font-semibold mb-2">Ringkasan Status</h3>
        <table class="w-full">
          <tr>
            <td>Lunas</td>
            <td>: {{ $pembayarans->where('tagihan.sisa_tagihan', 0)->count() }} pembayaran</td>
          </tr>
          <tr>
            <td>Belum Lunas</td>
            <td>: {{ $pembayarans->where('tagihan.sisa_tagihan', '>', 0)->count() }} pembayaran</td>
          </tr>
        </table>
      </div>
      <div class="border border-gray-300 p-4 rounded">
        <h3 class="font-semibold mb-2">Ringkasan Jenis</h3>
        <table class="w-full">
          @foreach ($jenisPembayarans as $jenis)
          <tr>
            <td>{{ $jenis->nama_pembayaran }}</td>
            <td>
              : Rp {{ number_format($jenis->tagihans->flatMap->transaksis->sum('jumlah_pembayaran'), 0, ',', '.') }}
            </td>
          </tr>
          @endforeach
        </table>
      </div>
    </div>

    <!-- Footer Laporan -->
    {{-- <div class="flex justify-end mt-8">
      @foreach ($sekolahs as $sekolah)
      <div class="text-center w-64">
        <p>{{ $sekolah->kabupaten_kota }}, {{ date('d F Y') }}</p>
        <p class="mb-16">Petugas Keuangan,</p>
        <p class="font-semibold">{{ }}</p>
        <p>NIP. 19750610 200012 1 003</p>
      </div>
      @endforeach
    </div>
  </div> --}}

</body>

</html>