<div x-data="{ activeTab: 'gender' }">
    {{-- Main Content --}}
    <div class="p-4 mt-16">
        <!-- Tabs -->
        <div class="mb-6 flex flex-wrap gap-2">
            <button @click="activeTab = 'gender'"
                :class="activeTab === 'gender' ? 'bg-green-600 text-white' : 'bg-white text-green-600 hover:bg-green-50'"
                class="px-4 py-2 rounded-lg font-medium transition-colors">
                Manajemen Gender
            </button>
            <button @click="activeTab = 'religion'"
                :class="activeTab === 'religion' ? 'bg-green-600 text-white' : 'bg-white text-green-600 hover:bg-green-50'"
                class="px-4 py-2 rounded-lg font-medium transition-colors">
                Manajemen Agama
            </button>
            <button @click="activeTab = 'ptk'"
                :class="activeTab === 'ptk' ? 'bg-green-600 text-white' : 'bg-white text-green-600 hover:bg-green-50'"
                class="px-4 py-2 rounded-lg font-medium transition-colors">
                Manajemen PTK
            </button>
            <button @click="activeTab = 'major'"
                :class="activeTab === 'major' ? 'bg-green-600 text-white' : 'bg-white text-green-600 hover:bg-green-50'"
                class="px-4 py-2 rounded-lg font-medium transition-colors">
                Manajemen Jurusan
            </button>
        </div>

        <!-- Content Area -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <!-- Gender Management -->
            <div x-show="activeTab === 'gender'">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Daftar Gender</h2>
                    <button @click="$dispatch('modal-crud-gender')"
                        class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                        Tambah Gender
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Gender
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($genderes as $index => $gender)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $genderes->firstItem() + $index }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $gender->kelamin }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button type="button" wire:click="editGender({{ $gender->id }})"
                                        class="text-blue-600 hover:text-blue-900 mr-3">
                                        Edit
                                    </button>
                                    <button type="button" wire:click="hapusData({{ $gender->id }}, 'gender')"
                                        class="text-red-600 hover:text-red-900">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- Pagination --}}
                    {{ $genderes->links('vendor.pagination.tailwind') }}
                </div>
            </div>

            <!-- Religion Management -->
            <div x-show="activeTab === 'religion'">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Daftar Agama</h2>
                    <button type="button" @click="$dispatch('modal-crud-agama')"
                        class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                        Tambah Agama
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Agama
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($agamas as $index => $agama)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $agamas->firstItem() + $index }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $agama->agama }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button type="button" wire:click="editAgama({{ $agama->id }})"
                                        class="text-blue-600 hover:text-blue-900 mr-3">
                                        Edit
                                    </button>
                                    <button type="button" wire:click="hapusData({{ $agama->id }}, 'agama')"
                                        class="text-red-600 hover:text-red-900">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Pagenation --}}
                    {{ $agamas->links('vendor.pagination.tailwind') }}
                </div>
            </div>

            <!-- PTK Management -->
            <div x-show="activeTab === 'ptk'">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Daftar PTK</h2>
                    <button type="button" @click="$dispatch('modal-crud-ptk')"
                        class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                        Tambah PTK
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jenis PTK
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Keterangan
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($ptks as $index => $ptk)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $ptks->firstItem() + $index }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $ptk->jenis_ptk }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $ptk->keterangan !== null ?
                                    Str::limit($ptk->keterangan, 50, '...') : '(Kosong)' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button type="button" wire:click="editPtk({{ $ptk->id }})"
                                        class="text-blue-600 hover:text-blue-900 mr-3">
                                        Edit
                                    </button>
                                    <button type="button" wire:click="hapusData({{ $ptk->id }}, 'ptk')"
                                        class="text-red-600 hover:text-red-900">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Pagination --}}
                    {{ $ptks->links('vendor.pagination.tailwind') }}
                </div>
            </div>

            <!-- Major Management -->
            <div x-show="activeTab === 'major'">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Daftar Jurusan</h2>
                    <button @click="showModal = true; modalType = 'add-major'; modalTitle = 'Tambah Jurusan'"
                        class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                        Tambah Jurusan
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kode
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Jurusan
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Deskripsi
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <template x-for="(major, index) in majors" :key="index">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap" x-text="index + 1"></td>
                                    <td class="px-6 py-4 whitespace-nowrap" x-text="major.code"></td>
                                    <td class="px-6 py-4 whitespace-nowrap" x-text="major.name"></td>
                                    <td class="px-6 py-4 whitespace-nowrap" x-text="major.description"></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <button
                                            @click="currentItem = major; showModal = true; modalType = 'edit-major'; modalTitle = 'Edit Jurusan'"
                                            class="text-blue-600 hover:text-blue-900 mr-3">
                                            Edit
                                        </button>
                                        <button
                                            @click="currentItem = major; showModal = true; modalType = 'delete-major'; modalTitle = 'Hapus Jurusan'"
                                            class="text-red-600 hover:text-red-900">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <livewire:pages.master.data.modal-manajemen-data />
    </div>
</div>