<main class="p-4 lg:p-8">

    <!-- Header Section -->
    <div
    class="flex flex-col gap-4 mb-8 md:flex-row md:items-center md:justify-between"
    >
    <div>
      <h1 class="text-2xl font-semibold text-gray-800">
        Manajemen Siswa
      </h1>
      <p class="mt-1 text-sm text-gray-600">
        Kelola Siswa
      </p>
    </div>
    <button
      @click="showModal = true; modalType = 'add'; resetForm()"
      class="flex items-center px-4 py-2 text-white bg-violet-600 rounded-lg hover:bg-violet-700 transition duration-200"
    >
      <svg
        class="w-5 h-5 mr-2"
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 24"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M12 4v16m8-8H4"
        ></path>
      </svg>
      Tambah Baju
    </button>
    </div>

        <div class="grid grid-cols-1 gap-4 mb-8 sm:grid-cols-2 lg:grid-cols-3">
            <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-lg">
                        {{-- <i class="fa-solid fa-user-check text-2xl text-green-600"></i> --}}
                        <i class="text-2xl text-green-600 fa-solid fa-person"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-500">Siswa Laki-Laki</h3>
                        <p class="text-lg font-semibold text-gray-800">156</p>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-violet-100 rounded-lg">
                        <i class="text-2xl text-violet-600 fa-solid fa-person-dress"> </i></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-500">Siswa Perempuan</h3>
                        <p class="text-lg font-semibold text-gray-800">89</p>
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
                        <p class="text-lg BGPI font-semibold text-gray-800">67</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters Section -->
        <div
        class="p-6 mb-8 bg-white rounded-xl shadow-sm border border-gray-100"
      >
        <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-700"
              >Kategori</label
            >
            <select
              class="w-full p-2 text-sm border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500"
            >
              <option value="">Semua Kategori</option>
              <template x-for="kategori in kategoriOptions">
                <option :value="kategori" x-text="kategori"></option>
              </template>
            </select>
          </div>
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-700"
              >Status</label
            >
            <select
              class="w-full p-2 text-sm border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500"
            >
              <option value="">Semua Status</option>
              <option value="Tersedia">Tersedia</option>
              <option value="Disewa">Disewa</option>
              <option value="Maintenance">Maintenance</option>
            </select>
          </div>
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-700"
              >Ukuran</label
            >
            <select
              class="w-full p-2 text-sm border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500"
            >
              <option value="">Semua Ukuran</option>
              <template x-for="ukuran in ukuranOptions">
                <option :value="ukuran" x-text="ukuran"></option>
              </template>
            </select>
          </div>
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-700"
              >Rentang Harga</label
            >
            <div class="flex gap-2">
              <input
                type="number"
                placeholder="Min"
                class="w-full p-2 text-sm border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500"
              />
              <input
                type="number"
                placeholder="Max"
                class="w-full p-2 text-sm border border-gray-300 rounded-lg focus:ring-violet-500 focus:border-violet-500"
              />
            </div>
          </div>
        </div>
      </div>

        <!-- Table Section -->
        <div
        class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden"
      >
        <div class="overflow-x-auto">
          <table class="w-full">
            <thead class="bg-gray-50">
              <tr>
                <th
                  class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                  Gambar
                </th>
                <th
                  class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                  Nama Siswa
                </th>
                <th
                  class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                  Nisn
                </th>
                <th
                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
              >
               Nik
              </th>
                <th
                  class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                 Tempat Lahir
                </th>
                <th
                  class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                Tanggal Lahir
                </th>
                <th
                  class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                 Alamat
                </th>
                <th
                  class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                 Nama Ibu
                </th>
                <th
                  class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                 Nama Ayah
                </th>
                <th
                  class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                 Nama Wali
                </th>
                <th
                  class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                 Aksi
                </th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
              <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap">
                  <img
                    src="https://via.placeholder.com/50x50"
                    class="w-12 h-12 rounded-lg object-cover"
                  />
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm font-medium text-gray-900">
                    Iqbal Maulana
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">
                   0075233627
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">321637537839</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">Subang</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">10-02-2008</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">jln. Bojong loa Kp. Panyingkiran RT 26 RW 08 Ds. Pabuaran Kec. Pabuaran Kab. Subang</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">Nayla</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">Jeni</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">Dewi</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex space-x-2">
                    <button
                      @click="showModal = true; modalType = 'edit'"
                      class="inline-flex items-center px-3 py-1 text-sm text-violet-600 bg-violet-100 rounded-lg hover:bg-violet-200"
                    >
                      <svg
                        class="w-4 h-4 mr-1"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                        ></path>
                      </svg>
                      Edit
                    </button>
                    <button
                      @click="showDeleteModal = true; selectedItem = 'Gaun Pengantin Modern Luxury'"
                      class="inline-flex items-center px-3 py-1 text-sm text-red-600 bg-red-100 rounded-lg hover:bg-red-200"
                    >
                      <svg
                        class="w-4 h-4 mr-1"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                        ></path>
                      </svg>
                      Hapus
                    </button>
                  </div>
                </td>
              </tr>
              <!-- Add more rows as needed -->
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <div
          class="flex items-center justify-between px-6 py-4 bg-white border-t"
        >
          <div class="flex items-center text-sm text-gray-500">
            <span>Showing</span>
            <select
              class="mx-2 border-gray-300 rounded-md focus:ring-violet-500 focus:border-violet-500"
            >
              <option>10</option>
              <option>25</option>
              <option>50</option>
            </select>
            <span>of 100 entries</span>
          </div>
          <div class="flex space-x-2">
            <button
              class="px-3 py-1 text-sm text-gray-500 bg-white border rounded-lg hover:bg-gray-100 disabled:opacity-50"
            >
              Previous
            </button>
            <button
              class="px-3 py-1 text-sm text-white bg-violet-600 rounded-lg hover:bg-violet-700"
            >
              1
            </button>
            <button
              class="px-3 py-1 text-sm text-gray-500 bg-white border rounded-lg hover:bg-gray-100"
            >
              2
            </button>
            <button
              class="px-3 py-1 text-sm text-gray-500 bg-white border rounded-lg hover:bg-gray-100"
            >
              3
            </button>
            <button
              class="px-3 py-1 text-sm text-gray-500 bg-white border rounded-lg hover:bg-gray-100"
            >
              Next
            </button>
          </div>
        </div>
      </div>
    </main>

