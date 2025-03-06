<!-- Top Navigation -->
<div class="fixed top-0 right-0 left-0 z-20 flex items-center justify-between h-16 px-4 bg-white border-b lg:left-72">
    <button @click="sidebarOpen = true" class="lg:hidden">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
            </path>
        </svg>
    </button>
    <div class="flex items-center justify-between w-full">
        <span class="text-base font-bold">ADMIN MASTER SMK AL - INTISAB PATOKBEUSI</span>
        <button type="button" @click="$dispatch('modal-logout')"
            class="ml-4 flex items-center text-sm px-3 py-2 rounded-lg bg-green-500 text-white hover:bg-green-600">
            Logout
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="ml-1 size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
            </svg>
        </button>
    </div>

    <!-- Logout Confirmation Modal -->
    <div x-data="{ modalLogout: false }" x-show="modalLogout" @modal-logout.window="modalLogout = true"
        class="fixed inset-0 z-50 overflow-y-auto" style="display: none">
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>
        <div class="relative flex items-center justify-center min-h-screen p-4">
            <div class="relative w-full max-w-md p-6 bg-white rounded-xl shadow-lg">
                <div class="flex items-center justify-center mb-6">
                    <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                        <i class="fa-solid fa-exclamation text-2xl text-blue-600"></i>
                    </div>
                </div>

                <h3 class="text-lg font-medium text-center text-gray-900 mb-4">
                    Konfirmasi Logout
                </h3>
                <p class="text-sm text-center text-gray-500 mb-6">
                    Apakah Anda yakin ingin
                    <span class="font-medium text-gray-900">Logout</span>?
                </p>

                <div class="flex justify-center space-x-3">
                    <button type="button" @click="modalLogout = false"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="button" wire:click="logout"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                        Log out
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>