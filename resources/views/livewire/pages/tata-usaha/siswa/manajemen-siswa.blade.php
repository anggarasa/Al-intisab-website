<main class="p-4 lg:p-8" x-data="{showDeleteModal: null, modalShowSiswa: null}">

  <!-- Header Section -->
  <div class="flex flex-col gap-4 mb-8 md:flex-row md:items-center md:justify-between">
    <div>
      <h1 class="text-2xl font-semibold text-gray-800">
        Manajemen Siswa
      </h1>
      <p class="mt-1 text-sm text-gray-600">
        Kelola Data Siswa
      </p>
    </div>
    <livewire:pages.tata-usaha.siswa.modal-manajemen-siswa />
  </div>

  <div class="grid grid-cols-1 gap-4 mb-8 sm:grid-cols-2 lg:grid-cols-3">
    <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100">
      <div class="flex items-center">
        <div class="px-5 py-3 bg-green-100 rounded-lg">
          <i class="text-2xl text-green-600 fa-solid fa-person"></i>
        </div>
        <div class="ml-4">
          <h3 class="text-sm font-medium text-gray-500">Siswa Laki-Laki</h3>
          <p class="text-lg font-semibold text-gray-800">{{ $siswaL }}
          </p>
        </div>
      </div>
    </div>

    <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100">
      <div class="flex items-center">
        <div class="px-5 py-3 bg-violet-100 rounded-lg">
          <i class="text-2xl text-violet-600 fa-solid fa-person-dress"> </i></i>
        </div>
        <div class="ml-4">
          <h3 class="text-sm font-medium text-gray-500">Siswa Perempuan</h3>
          <p class="text-lg font-semibold text-gray-800">{{ $siswaP }}
          </p>
        </div>
      </div>
    </div>

    <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100">
      <div class="flex items-center">
        <div class="p-3 bg-yellow-100 rounded-lg">
          <i class="text-2xl text-yellow-600 fa-solid fa-users"></i>
        </div>
        <div class="ml-4">
          <h3 class="text-sm font-medium text-gray-500">
            Jumlah Siswa
          </h3>
          <p class="text-lg BGPI font-semibold text-gray-800">{{ $siswas->count() }}</p>
        </div>
      </div>
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
          @foreach ($jurusans as $id => $jurusan)
          <option value="{{ $id }}">{{ $jurusan }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label class="block mb-2 text-sm font-medium text-gray-700">Kelas</label>
        <select wire:model.live="searchKelas"
          class="w-full p-2 text-sm border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
          <option value="">Semua Kelas</option>
          @foreach ($kelases as $id => $kelas)
          <option value="{{ $id }}">{{ $kelas }}</option>
          @endforeach
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
              Gambar</th>
            <th
              class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
              Nama Siswa</th>
            <th
              class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
              Nisn</th>
            <th
              class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
              Nik</th>
            <th
              class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
              Kelas</th>
            <th
              class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
              Jurusan</th>
            <th
              class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
              Email</th>
            <th
              class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
              Tempat Lahir</th>
            <th
              class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
              Tanggal Lahir</th>
            <th
              class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
              Gender</th>
            <th
              class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
              Agama</th>
            <th
              class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
              Alamat</th>
            <th
              class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
              Nama Ibu</th>
            <th
              class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
              Nama Ayah</th>
            <th
              class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
              Nama Wali</th>
            <th
              class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
              Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          @foreach ($siswas as $siswa)
          <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap cursor-pointer"
              @click="modalShowSiswa = 'modal-show-siswa_{{ $siswa->id }}'">
              @if ($siswa->foto)
              <img src="{{ asset('storage/'. $siswa->foto) }}" class="w-12 h-12 rounded-lg object-cover" />
              @else
              <img src="{{ asset('imgs/component/profile/avatar-man.jpg') }}"
                class="w-12 h-12 rounded-lg object-cover" />
              @endif
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div @click="modalShowSiswa = 'modal-show-siswa_{{ $siswa->id }}'"
                class="text-sm font-medium text-gray-900 hover:font-bold hover:underline cursor-pointer">
                {{ $siswa->name }}
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">
                {{ $siswa->nisn }}
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">{{ $siswa->nik }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">{{ $siswa->kelas->nama_kelas }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">{{ $siswa->jurusan->nama_jurusan }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">{{ $siswa->user->email }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">{{ $siswa->tempat_lahir }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">{{ $siswa->tanggal_lahir }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">{{ $siswa->kelamin->kelamin }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">{{ $siswa->agama->agama }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">{{ Str::limit($siswa->alamat, 20, '...') }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">{{ $siswa->nama_ibu }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">{{ $siswa->nama_ayah }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">{{ $siswa->nama_wali !== null ? $siswa->nama_wali : '-' }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex space-x-2">
                <button type="button" wire:click="editSiswa({{ $siswa->id }})"
                  class="inline-flex items-center px-3 py-1 text-sm text-violet-600 bg-violet-100 rounded-lg hover:bg-violet-200">
                  <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                    </path>
                  </svg>
                  Edit
                </button>
                <button type="button" wire:click="hapusSiswa({{ $siswa->id }})"
                  class="inline-flex items-center px-3 py-1 text-sm text-red-600 bg-red-100 rounded-lg hover:bg-red-200">
                  <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                    </path>
                  </svg>
                  Hapus
                </button>
              </div>
            </td>
          </tr>

          {{-- Modal Show siswa --}}
          <div x-show="modalShowSiswa === 'modal-show-siswa_{{ $siswa->id }}'"
            class="fixed inset-0 z-50 overflow-y-auto" style="display: none">
            <div class="flex items-center justify-center min-h-screen px-4">
              <!-- Backdrop -->
              <div class="fixed inset-0 bg-black/50"></div>

              <!-- Modal Content -->
              <div class="relative bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
                <!-- Modal Header -->
                <div
                  class="sticky top-0 bg-white/95 backdrop-blur-sm border-b border-gray-200 px-8 py-5 flex justify-between items-center rounded-t-2xl">
                  <h3 class="text-2xl font-semibold text-gray-800">
                    Detail Informasi Siswa
                  </h3>
                  <button @click="modalShowSiswa = null"
                    class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 p-2 rounded-lg transition-colors">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                      </path>
                    </svg>
                  </button>
                </div>

                <!-- Modal Body -->
                <div class="p-8">
                  <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Foto Siswa -->
                    <div class="md:col-span-1">
                      <div class="rounded-2xl bg-gradient-to-br from-green-50 to-green-100 p-2 shadow-lg">
                        <div class="aspect-square rounded-xl overflow-hidden ring-4 ring-white shadow-inner">
                          @if ($siswa->foto)
                          <img src="{{ asset('storage/'. $siswa->foto) }}" alt="{{ $siswa->name }}"
                            class="w-full h-full object-cover" />
                          @else
                          <img src="{{ asset('imgs/component/profile/avatar-man.jpg') }}" alt="{{ $siswa->name }}"
                            class="w-full h-full object-cover" />
                          @endif
                        </div>
                      </div>
                    </div>

                    <!-- Detail Siswa -->
                    <div class="md:col-span-2 space-y-8">
                      <!-- Informasi Dasar -->
                      <div class="space-y-4 bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                        <h4 class="text-lg font-semibold text-green-700 flex items-center gap-2">
                          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                          </svg>
                          Informasi Dasar
                        </h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                          <div>
                            <label class="block text-sm font-medium text-gray-500">Nama Lengkap</label>
                            <p class="mt-1 text-gray-900 font-medium">
                              {{ $siswa->name }}
                            </p>
                          </div>
                          <div>
                            <label class="block text-sm font-medium text-gray-500">NISN</label>
                            <p class="mt-1 text-gray-900 font-medium">
                              {{ $siswa->nisn }}
                            </p>
                          </div>
                          <div>
                            <label class="block text-sm font-medium text-gray-500">NIK</label>
                            <p class="mt-1 text-gray-900 font-medium">
                              {{ $siswa->nik }}
                            </p>
                          </div>
                          <div>
                            <label class="block text-sm font-medium text-gray-500">Jenis Kelamin</label>
                            <p class="mt-1 text-gray-900 font-medium">
                              {{ $siswa->kelamin->kelamin }}
                            </p>
                          </div>
                          <div>
                            <label class="block text-sm font-medium text-gray-500">Agama</label>
                            <p class="mt-1 text-gray-900 font-medium">{{ $siswa->agama->agama }}</p>
                          </div>
                          <div>
                            <label class="block text-sm font-medium text-gray-500">Email</label>
                            <p class="mt-1 text-gray-900 font-medium">
                              {{ $siswa->user->email }}
                            </p>
                          </div>
                        </div>
                      </div>

                      <!-- Informasi Akademik -->
                      <div class="space-y-4 bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                        <h4 class="text-lg font-semibold text-green-700 flex items-center gap-2">
                          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                          </svg>
                          Informasi Akademik
                        </h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                          <div>
                            <label class="block text-sm font-medium text-gray-500">Kelas</label>
                            <p class="mt-1 text-gray-900 font-medium">{{ $siswa->kelas->nama_kelas }}</p>
                          </div>
                          <div>
                            <label class="block text-sm font-medium text-gray-500">Jurusan</label>
                            <p class="mt-1 text-gray-900 font-medium">
                              {{ $siswa->jurusan->nama_jurusan }}
                            </p>
                          </div>
                        </div>
                      </div>

                      <!-- Informasi Personal -->
                      <div class="space-y-4 bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                        <h4 class="text-lg font-semibold text-green-700 flex items-center gap-2">
                          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                          </svg>
                          Informasi Personal
                        </h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                          <div>
                            <label class="block text-sm font-medium text-gray-500">Tempat Lahir</label>
                            <p class="mt-1 text-gray-900 font-medium">{{ $siswa->tempat_lahir }}</p>
                          </div>
                          <div>
                            <label class="block text-sm font-medium text-gray-500">Tanggal Lahir</label>
                            <p class="mt-1 text-gray-900 font-medium">
                              {{ date('d F Y', strtotime($siswa->tanggal_lahir)) }}
                            </p>
                          </div>
                          <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-500">Alamat</label>
                            <p class="mt-1 text-gray-900 font-medium">
                              {{ $siswa->alamat }}
                            </p>
                          </div>
                          <div>
                            <label class="block text-sm font-medium text-gray-500">Nomor HP</label>
                            <p class="mt-1 text-gray-900 font-medium">
                              {{ $siswa->no_hp }}
                            </p>
                          </div>
                        </div>
                      </div>

                      <!-- Informasi Orang Tua/Wali -->
                      <div class="space-y-4 bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                        <h4 class="text-lg font-semibold text-green-700 flex items-center gap-2">
                          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                          </svg>
                          Informasi Orang Tua/Wali
                        </h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                          <div>
                            <label class="block text-sm font-medium text-gray-500">Nama Ayah</label>
                            <p class="mt-1 text-gray-900 font-medium">
                              {{ $siswa->nama_ayah }}
                            </p>
                          </div>
                          <div>
                            <label class="block text-sm font-medium text-gray-500">Nama Ibu</label>
                            <p class="mt-1 text-gray-900 font-medium">
                              {{ $siswa->nama_ibu }}
                            </p>
                          </div>
                          <div>
                            <label class="block text-sm font-medium text-gray-500">Nama Wali</label>
                            <p class="mt-1 text-gray-900 font-medium">{{ $siswa->nama_wali !== null ? $siswa->nama_wali
                              : '-' }}</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Modal Footer -->
                <div class="sticky bottom-0 bg-gray-50 px-6 py-4 rounded-b-xl border-t border-gray-200">
                  <button @click="modalShowSiswa = null"
                    class="w-full sm:w-auto px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    Close
                  </button>
                </div>
              </div>
            </div>
            @endforeach
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    {{ $siswas->links('vendor.pagination.tailwind') }}
  </div>
</main>