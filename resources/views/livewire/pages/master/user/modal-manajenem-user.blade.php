<div x-data="{ showModal: false }">
    <button @click="showModal = true"
        class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                clip-rule="evenodd" />
        </svg>
        Tambah User
    </button>

    <!-- Modal -->
    <div x-show="showModal" @modal-crud-user.window="showModal = true" @close-modal-crud-user.window="showModal = false"
        class="fixed inset-0 bg-black bg-opacity-50 z-30 flex items-center justify-center p-4"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="bg-white rounded-xl max-w-md w-full p-6" @modal-crud-user.window="showModal = true"
            @close-modal-crud-user.window="showModal = false" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="transform scale-95 opacity-0"
            x-transition:enter-end="transform scale-100 opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="transform scale-100 opacity-100"
            x-transition:leave-end="transform scale-95 opacity-0">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800">{{ $isEdit == true ? 'Update' : 'Tambah' }} User</h3>
                <button type="button" wire:click="resetInput" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <form wire:submit="{{ $isEdit == true ? 'updateUser' : 'tambahUser' }}">
                {{-- Email --}}
                <div class="mb-4">
                    <x-input type="email" name="email" label="Email" wire="email" placeholder="Masukkan email"
                        required="true" />
                </div>

                {{-- password --}}
                <div class="mb-4">
                    <x-password-input name="password" label="Password" wireModel="password" />
                </div>

                {{-- Confirm Password --}}
                <div class="mb-4">
                    <x-password-input name="password_confirmation" label="Konfirmasi Passowrd"
                        wireModel="password_confirmation" />
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Role</label>
                    <select wire:model="role"
                        class="w-full px-4 py-3 border-2 rounded-xl focus:ring-2 focus:ring-green-300 focus:border-green-400 outline-none transition bg-white/50">
                        <option value="">Pilih Role</option>
                        <option value="kurikulum">Kurikulum</option>
                        <option value="tu">Tata Usaha</option>
                        <option value="master">Admin Master</option>
                    </select>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" wire:click="resetInput" class="px-4 py-2 text-gray-600 hover:text-gray-800">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 disabled:opacity-50">
                        {{ $isEdit == true ? 'Update' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>