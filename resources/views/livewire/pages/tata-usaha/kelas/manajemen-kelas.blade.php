<main class="p-4 lg:p-8" x-data="{ showDeleteModal: false }">

  <!-- Header Section -->
  <div class="flex flex-col gap-4 mb-8 md:flex-row md:items-center md:justify-between">
    <div>
      <h1 class="text-2xl font-semibold text-gray-800">
        Management Kelas
      </h1>
      <p class="mt-1 text-sm text-gray-600">
        Kelola kelas Smk Al-Intisab
      </p>
    </div>
    <livewire:pages.tata-usaha.kelas.modal-manajemen-kelas />
  </div>

  <div class="grid grid-cols-1 gap-4 mb-8 sm:grid-cols-2 lg:grid-cols-3">
    <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100">
      <div class="flex items-center">
        <div class="p-3 bg-green-100 rounded-lg">
          {{-- <i class="fa-solid fa-user-check text-2xl text-green-600"></i> --}}
          <i class="text-2xl text-green-600 fa-solid fa-school-circle-check"></i>
        </div>
        <div class="ml-4">
          <h3 class="text-sm font-medium text-gray-500">Kelas Aktif</h3>
          <p class="text-lg font-semibold text-gray-800">156</p>
        </div>
      </div>
    </div>

    <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100">
      <div class="flex items-center">
        <div class="p-3 bg-red-100 rounded-lg">
          <i class="text-2xl text-red-600 fa-solid fa-school-circle-xmark"></i>
        </div>
        <div class="ml-4">
          <h3 class="text-sm font-medium text-gray-500">Kelas Tidak Aktif</h3>
          <p class="text-lg font-semibold text-gray-800">89</p>
        </div>
      </div>
    </div>

    <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100">
      <div class="flex items-center">
        <div class="p-3 bg-yellow-100 rounded-lg">
          <i class="text-2xl text-yellow-600 fa-solid fa-school"></i>
        </div>
        <div class="ml-4">
          <h3 class="text-sm font-medium text-gray-500">
            Jumlah Kelas
          </h3>
          <p class="text-lg BGPI font-semibold text-gray-800">{{ $kelases->count() }}</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Filters Section -->
  <div class="p-6 mb-8 bg-white rounded-xl shadow-sm border border-gray-100">
    <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
      <div>
        <label class="block mb-2 text-sm font-medium text-gray-700">Kategori</label>
        <select
          class="w-full p-2 text-sm border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500">
          <option value="">Semua Kategori</option>
          <template x-for="kategori in kategoriOptions">
            <option :value="kategori" x-text="kategori"></option>
          </template>
        </select>
      </div>
      <div>
        <label class="block mb-2 text-sm font-medium text-gray-700">Status</label>
        <select
          class="w-full p-2 text-sm border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500">
          <option value="">Semua Status</option>
          <option value="Tersedia">Tersedia</option>
          <option value="Disewa">Disewa</option>
          <option value="Maintenance">Maintenance</option>
        </select>
      </div>
      <div>
        <label class="block mb-2 text-sm font-medium text-gray-700">Ukuran</label>
        <select
          class="w-full p-2 text-sm border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500">
          <option value="">Semua Ukuran</option>
          <template x-for="ukuran in ukuranOptions">
            <option :value="ukuran" x-text="ukuran"></option>
          </template>
        </select>
      </div>
      <div>
        <label class="block mb-2 text-sm font-medium text-gray-700">Rentang Harga</label>
        <div class="flex gap-2">
          <input type="number" placeholder="Min"
            class="w-full p-2 text-sm border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500" />
          <input type="number" placeholder="Max"
            class="w-full p-2 text-sm border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500" />
        </div>
      </div>
    </div>
  </div>

  <!-- Table Section -->
  <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Nama Kelas
            </th>
            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Jurusan
            </th>
            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Status
            </th>
            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Aksi
            </th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          @foreach ($kelases as $kelas)
          <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm font-medium text-gray-900">
                {{ $kelas->nama_kelas }}
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">
                {{ $kelas->jurusan->nama_jurusan }}
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span
                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                Aktif
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex space-x-2">
                <button type="button" wire:click="editKelas({{ $kelas->id }})"
                  class="inline-flex items-center px-3 py-1 text-sm text-violet-600 bg-violet-100 rounded-lg hover:bg-violet-200">
                  <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                    </path>
                  </svg>
                  Edit
                </button>
                <button type="button" @click="showDeleteModal = 'modal-delete-kelas_{{ $kelas->id }}'"
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


          <!-- Delete Confirmation Modal -->
          <div x-show="showDeleteModal === 'modal-delete-kelas_{{ $kelas->id }}'"
            @close-modal-delete-kelas.window="showDeleteModal = false" class="fixed inset-0 z-50 overflow-y-auto"
            style="display: none">
            <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>
            <div class="relative flex items-center justify-center min-h-screen p-4">
              <div class="relative w-full max-w-md p-6 bg-white rounded-xl shadow-lg">
                <div class="flex items-center justify-center mb-6">
                  <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                      </path>
                    </svg>
                  </div>
                </div>

                <h3 class="text-lg font-medium text-center text-gray-900 mb-4">
                  Konfirmasi Hapus
                </h3>
                <p class="text-sm text-center text-gray-500 mb-6">
                  Apakah Anda yakin ingin menghapus
                  <span class="font-medium text-gray-900">{{ $kelas->nama_kelas }}</span>? Tindakan ini
                  tidak
                  dapat dibatalkan.
                </p>

                <div class="flex justify-center space-x-3">
                  <button type="button" @click="showDeleteModal = null"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                    Batal
                  </button>
                  <button type="button" wire:click="deleteKelas({{ $kelas->id }})"
                    class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">
                    Hapus
                  </button>
                </div>
              </div>
            </div>
          </div>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="flex items-center justify-between px-6 py-4 bg-white border-t">
      <div class="flex items-center text-sm text-gray-500">
        <span>Showing</span>
        <select class="mx-2 border-gray-300 rounded-md focus:ring-violet-500 focus:border-violet-500">
          <option>10</option>
          <option>25</option>
          <option>50</option>
        </select>
        <span>of 100 entries</span>
      </div>
      <div class="flex space-x-2">
        <button
          class="px-3 py-1 text-sm text-gray-500 bg-white border rounded-lg hover:bg-gray-100 disabled:opacity-50">
          Previous
        </button>
        <button class="px-3 py-1 text-sm text-white bg-violet-600 rounded-lg hover:bg-violet-700">
          1
        </button>
        <button class="px-3 py-1 text-sm text-gray-500 bg-white border rounded-lg hover:bg-gray-100">
          2
        </button>
        <button class="px-3 py-1 text-sm text-gray-500 bg-white border rounded-lg hover:bg-gray-100">
          3
        </button>
        <button class="px-3 py-1 text-sm text-gray-500 bg-white border rounded-lg hover:bg-gray-100">
          Next
        </button>
      </div>
    </div>
  </div>
</main>