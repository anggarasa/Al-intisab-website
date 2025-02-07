<div class="p-4 mt-16" x-data="{ modalDetail: null }">
    <!-- Header Section -->
    <div class="flex flex-col gap-4 mb-8 md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">
                Management Kurikulum
            </h1>
            <p class="mt-1 text-sm text-gray-600">
                Kelola kurikulum Smk Al-Intisab
            </p>
        </div>
        <livewire:pages.kurikulum.kurikulum.modal-manajemen-kurikulum />
    </div>

    <!-- Filters Section -->
    <div class="p-6 mb-8 bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="grid grid-cols-1">
            <form>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Search Kurikulum</label>
                    <div class="relative">
                        <input type="search" wire:model.live="search" placeholder="Cari Kurikulum..."
                            class="w-full p-2 pl-10 text-sm border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                        <div class="absolute top-1/2 left-3 transform -translate-y-1/2">
                            <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        No
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Kurikulum
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Deskripsi
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($kurikulums as $index => $kurikulum)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $kurikulums->firstItem() + $index }}</td>
                    <td class="px-6 py-4 whitespace-nowrap hover:underline hover:font-bold hover:text-gray-800 hover:cursor-pointer"
                        @click="modalDetail = 'modal-detail-kurikulum_{{ $kurikulum->id }}'">
                        {{
                        $kurikulum->nama_kurikulum }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $kurikulum->deskripsi ? Str::limit($kurikulum->deskripsi, 80, '...') : '-' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex space-x-2">
                            <button type="button" wire:click="editKurikulum({{ $kurikulum->id }})"
                                class="inline-flex items-center px-3 py-1 text-sm text-violet-600 bg-violet-100 rounded-lg hover:bg-violet-200">
                                <i class="fa-regular fa-pen-to-square text-base mr-1"></i>
                                Edit
                            </button>
                            <button type="button" wire:click="hapusKurikulum({{ $kurikulum->id }})"
                                class="inline-flex items-center px-3 py-1 text-sm text-red-600 bg-red-100 rounded-lg hover:bg-red-200">
                                <i class="fa-regular fa-trash-can text-base mr-1"></i>
                                Hapus
                            </button>
                        </div>
                    </td>
                </tr>

                {{-- Modal detail --}}
                <!-- Modal -->
                <div x-show="modalDetail === 'modal-detail-kurikulum_{{ $kurikulum->id }}'"
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                    <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/2 lg:w-1/3 p-6">
                        <!-- Header Modal -->
                        <div class="flex justify-between items-center border-b pb-3">
                            <h2 class="text-xl font-semibold text-green-700">{{ $kurikulum->nama_kurikulum }}</h2>
                            <button @click="modalDetail = null" class="text-gray-500 hover:text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Body Modal -->
                        <div class="mt-4">
                            <p class="text-gray-700">
                                {{ $kurikulum->deskripsi }}
                            </p>
                        </div>

                        <!-- Footer Modal -->
                        <div class="mt-6 flex justify-end">
                            <button @click="modalDetail = null"
                                class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagenation --}}
    {{ $kurikulums->links('vendor.pagination.tailwind') }}
</div>