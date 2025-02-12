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
        <livewire:pages.master.pembayaran.jenis-pembayaran.modal-manajemen-jenis-pembayaran />
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        No
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Jenis Pembayaran
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Total Pembayaran
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($jenisPembayarans as $index => $pembayaran)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $jenisPembayarans->firstItem() + $index }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{
                        $pembayaran->nama_pembayaran }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ number_format($pembayaran->total,0,',','.') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex space-x-2">
                            <button type="button" wire:click="editJenisPembayaran({{ $pembayaran->id }})"
                                class="inline-flex items-center px-3 py-1 text-sm text-violet-600 bg-violet-100 rounded-lg hover:bg-violet-200">
                                <i class="fa-regular fa-pen-to-square text-base mr-1"></i>
                                Edit
                            </button>
                            <button type="button" wire:click="hapusJenisPembayaran({{ $pembayaran->id }})"
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
    </div>
</div>