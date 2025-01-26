<main class="p-4 lg:p-8">

  <!-- Header Section -->
  <div class="flex flex-col gap-4 mb-8 md:flex-row md:items-center md:justify-between">
    <div>
      <h1 class="text-2xl font-semibold text-gray-800">
        Manajemen Guru
      </h1>
      <p class="mt-1 text-sm text-gray-600">
        Kelola Guru
      </p>
    </div>
    <livewire:pages.tata-usaha.guru.modal-manajemen-guru>
  </div>

  <div class="grid grid-cols-1 gap-4 mb-8 sm:grid-cols-2 lg:grid-cols-3">
    <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100">
      <div class="flex items-center">
        <div class="px-4 py-2 bg-green-100 rounded-lg">
          <i class="text-2xl text-green-600 fa-solid fa-person"></i>
        </div>
        <div class="ml-4">
          <h3 class="text-sm font-medium text-gray-500">Guru Laki-Laki</h3>
          <p class="text-lg font-semibold text-gray-800">{{ $guruL }}</p>
        </div>
      </div>
    </div>

    <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100">
      <div class="flex items-center">
        <div class="px-4 py-2 bg-violet-100 rounded-lg">
          <i class="text-2xl text-violet-600 fa-solid fa-person-dress"> </i></i>
        </div>
        <div class="ml-4">
          <h3 class="text-sm font-medium text-gray-500">Guru Perempuan</h3>
          <p class="text-lg font-semibold text-gray-800">{{ $guruP }}</p>
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
            Jumlah Guru
          </h3>
          <p class="text-lg BGPI font-semibold text-gray-800">{{ $gurus->count() }}</p>
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
            <input type="search" wire:model.live="search" placeholder="Cari Guru..."
              class="w-full p-2 pl-10 text-sm border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
            <div class="absolute top-1/2 left-3 transform -translate-y-1/2">
              <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
            </div>
          </div>
        </div>
      </form>
      <div>
        <label class="block mb-2 text-sm font-medium text-gray-700">Status Kepegawaian</label>
        <select wire:model.live="searchStatus"
          class="w-full p-2 text-sm border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
          <option value="">Pilih Status</option>
          <option value="AKTIF">AKTIF</option>
          <option value="TIDAK AKTIF">TIDAK AKTIF</option>
        </select>
      </div>
      <div>
        <label class="block mb-2 text-sm font-medium text-gray-700">Jenis PTK</label>
        <select wire:model.live="searchPtk"
          class="w-full p-2 text-sm border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
          <option value="">Semua PTK</option>
          @foreach ($ptks as $id => $ptk)
          <option value="{{ $id }}">{{ $ptk }}</option>
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
              Nama Guru</th>
            <th
              class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
              NIP</th>
            <th
              class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
              Nik</th>
            <th
              class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
              Status Kepegawaian</th>
            <th
              class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
              Jenis PTK</th>
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
              Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          @foreach ($gurus as $guru)
          <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap">
              @if ($guru->foto)
              <img src="{{ asset('storage/'. $guru->foto) }}" alt="{{ $guru->name }}"
                class="w-12 h-12 rounded-lg object-cover" />
              @else
              <img src="{{ asset('imgs/component/profile/avatar-man.jpg') }}" alt="{{ $guru->name }}"
                class="w-12 h-12 rounded-lg object-cover" />
              @endif
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm font-medium text-gray-900">
                {{ $guru->name }}
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">
                {{ $guru->nip }}
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">{{ $guru->nik }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap" x-data="{ dropdownStatus: false }">
              <div class="px-6 py-3">
                <div class="relative inline-flex items-center group">
                  <span @click="dropdownStatus = !dropdownStatus"
                    class="px-3 py-1 inline-flex items-center gap-2 text-xs leading-5 font-semibold rounded-full hover:underline cursor-pointer {{ $guru->status_kepegawaian === 'AKTIF' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $guru->status_kepegawaian }}
                    <i class="fa-solid fa-angle-down text-xs transition-transform duration-200"
                      :class="{'rotate-180': dropdownStatus}"></i>
                  </span>
                </div>
              </div>

              <div x-show="dropdownStatus" @click.outside="dropdownStatus = false"
                class="z-10 absolute bg-gray-200 divide-y divide-gray-100 rounded-lg shadow w-44"
                style="display: none;">
                <ul class="py-2 text-sm text-gray-900">
                  <li>
                    <a @click="dropdownStatus = false; $wire.updateStatusGuru({{ $guru->id }}, 'AKTIF')"
                      class="block px-4 py-2 cursor-pointer hover:bg-gray-300">Aktif</a>
                  </li>
                  <li>
                    <a @click="dropdownStatus = false; $wire.updateStatusGuru({{ $guru->id }}, 'TIDAK AKTIF')"
                      class="block px-4 py-2 cursor-pointer hover:bg-gray-300">Tidak Aktif</a>
                  </li>
                </ul>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">{{ $guru->ptk->jenis_ptk }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">{{ $guru->user->email }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">{{ $guru->tempat_lahir }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">{{ $guru->tanggal_lahir }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">{{ $guru->kelamin->kelamin }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">{{ $guru->agama->agama }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">{{ Str::limit($guru->alamat, 20, '...') }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex space-x-2">
                <button type="button" wire:click="editGuru({{ $guru->id }})"
                  class="inline-flex items-center px-3 py-1 text-sm text-violet-600 bg-violet-100 rounded-lg hover:bg-violet-200">
                  <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                    </path>
                  </svg>
                  Edit
                </button>
                <button type="button" wire:click="hapusGuru({{ $guru->id }})"
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
          @endforeach
          <!-- Add more rows as needed -->
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    {{ $gurus->links('vendor.pagination.tailwind') }}
  </div>
</main>