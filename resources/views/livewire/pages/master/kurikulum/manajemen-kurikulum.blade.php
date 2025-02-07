<div class="p-4 mt-16">
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
        <livewire:pages.master.kurikulum.modal-manajemen-kurikulum />
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
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($kurikulums as $index => $kurikulum)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $kurikulums->firstItem() + $index }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $kurikulum->nama_kurikulum }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex space-x-2">
                            <button type="button" wire:click="editAgama({{ $kurikulum->id }})"
                                class="inline-flex items-center px-3 py-1 text-sm text-violet-600 bg-violet-100 rounded-lg hover:bg-violet-200">
                                <i class="fa-regular fa-pen-to-square text-base mr-1"></i>
                                Edit
                            </button>
                            <button type="button" wire:click="hapusData({{ $kurikulum->id }})"
                                class="inline-flex items-center px-3 py-1 text-sm text-red-600 bg-red-100 rounded-lg hover:bg-red-200">
                                <i class="fa-regular fa-trash-can text-base mr-1"></i>
                                Hapus
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagenation --}}
        {{ $kurikulums->links('vendor.pagination.tailwind') }}
    </div>
</div>