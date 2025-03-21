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

  <!-- Info Siswa -->
  <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
    <div class="md:flex">
      <div class="md:flex-shrink-0 p-4 md:p-6 flex justify-center md:justify-start">
        <img class="h-32 w-32 rounded-full object-cover border-4 border-green-100"
          src="{{ $siswa->foto ? asset('storage/'. $siswa->foto) : asset('imgs/component/profile/avatar-man.jpg') }}"
          alt="{{ $siswa->name }}" />
      </div>
      <div class="p-4 md:p-6 md:flex-1">
        <div class="flex flex-col md:flex-row md:justify-between md:items-start">
          <div>
            <h2 class="text-xl md:text-2xl font-bold text-gray-800">{{ $siswa->name }}</h2>
            <p class="text-gray-600">
              <span>{{ $siswa->kelas->nama_kelas }}</span>
              • NISN: <span>{{ $siswa->nisn }}</span>
            </p>
          </div>
        </div>

        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
          <div class="bg-green-50 p-4 rounded-lg border border-green-100">
            <p class="text-sm text-green-600 font-medium">Total Pembayaran</p>
            <p class="text-lg font-bold text-green-700">
              Rp {{ number_format($siswa->tagihan->sum('total_tagihan'),0,',','.') }}
            </p>
          </div>
          <div class="bg-red-50 p-4 rounded-lg border border-red-100">
            <p class="text-sm text-red-600 font-medium">Belum Lunas</p>
            <p class="text-lg font-bold text-red-700">
              Rp {{ number_format($siswa->tagihan->sum('sisa_tagihan'),0,',','.') }}
            </p>
          </div>
          <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
            <p class="text-sm text-blue-600 font-medium">Total Transaksi</p>
            <p class="text-lg font-bold text-blue-700">{{ $siswa->transaksis->count() }}</p>
          </div>
        </div>
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
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @forelse ($siswa->transaksis as $transaksi)
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
                {{ $transaksi->tagihan->sisa_tagihan == 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                {{ $transaksi->tagihan->sisa_tagihan == 0 ? 'Lunas' : 'Belum Lunas' }}
              </span>
            </td>
          </tr>
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
  </div>
</body>

</html>