<div>
    <div class="p-4 mt-16">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Daftar User</h2>
                    <p class="text-gray-600 text-sm">Kelola akses pengguna sistem</p>
                </div>

                <livewire:pages.master.user.modal-manajenem-user />
            </div>

            <!-- Search and Filter -->
            <div class="mb-6">
                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-1">
                        <input type="text" placeholder="Cari email..."
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" />
                    </div>
                    <div class="w-full sm:w-48">
                        <select
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <option value="">Semua Role</option>
                            <template x-for="role in roles">
                                <option :value="role" x-text="role"></option>
                            </template>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Email
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Role
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($users as $index => $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $users->firstItem() + $index }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div
                                        class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                        <span class="text-green-600 font-medium">{{ strtoupper(substr($user->email, 0,
                                            1)) }}</span>
                                    </div>
                                    <span>{{ $user->email }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                @if ($user->hasRole('master'))
                                    bg-green-100 text-green-800
                                    @elseif ($user->hasRole('kurikulum'))
                                    bg-blue-100 text-blue-800
                                    @elseif ($user->hasRole('tu'))
                                    bg-purple-100 text-purple-800
                                @endif">
                                    {{ $user->getRoleNames()->first() ?? 'No Role Assigned' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex space-x-2">
                                    <button type="button" wire:click="editUser({{ $user->id }})"
                                        class="inline-flex items-center px-3 py-1 text-sm text-violet-600 bg-violet-100 rounded-lg hover:bg-violet-200">
                                        <i class="fa-regular fa-pen-to-square text-base mr-1"></i>
                                        Edit
                                    </button>
                                    <button type="button" wire:click="hapusUser({{ $user->id }})"
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

            <!-- Pagination -->
            {{ $users->links('vendor.pagination.tailwind') }}
        </div>
    </div>
</div>