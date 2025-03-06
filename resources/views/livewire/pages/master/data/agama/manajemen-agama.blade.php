<div class="p-4 mt-16">
    <!-- Header Section -->
    <div class="flex flex-col gap-4 mb-8 md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">
                Jenis PTK
            </h1>
            <p class="mt-1 text-sm text-gray-600">
                Kelola jenis PTK Smk Al-Intisab
            </p>
        </div>
        <livewire:pages.master.data.agama.modal-manajemen-agama />
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden max-w-full">
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-12">
                            No
                        </th>
                        <th
                            class="px-4 py-3 text-xs text-center font-medium text-gray-500 uppercase tracking-wider w-3/4">
                            Agama
                        </th>
                        <th
                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/4">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @if ($agamas->isEmpty())
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center">
                            <div class="flex flex-col items-center space-y-2 text-gray-500">
                                <i class="fa-regular fa-circle-xmark text-4xl text-red-500"></i>
                                <p class="text-lg font-semibold">Data agama tidak ditemukan</p>
                                <p class="text-sm">Pastikan kata kunci pencarian Anda benar atau coba lagi.</p>
                            </div>
                        </td>
                    </tr>
                    @else
                    @foreach ($agamas as $index => $agama)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm whitespace-nowrap text-center">
                            {{ $agamas->firstItem() + $index }}
                        </td>
                        <td class="px-4 py-3 text-sm text-center font-medium text-gray-900 whitespace-nowrap">
                            {{ $agama->agama }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="flex space-x-2 justify-center">
                                <button type="button" wire:click="editAgama({{ $agama->id }})"
                                    class="inline-flex items-center px-3 py-1 text-sm text-violet-600 bg-violet-100 rounded-lg hover:bg-violet-200">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                    Edit
                                </button>
                                <button type="button" wire:click="hapusAgama({{ $agama->id }})"
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
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 bg-white border-t">
            {{ $agamas->links('vendor.pagination.tailwind') }}
        </div>
    </div>
</div>