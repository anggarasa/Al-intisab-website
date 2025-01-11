<!-- Top Navigation -->
<div class="sticky top-0 z-10 flex items-center justify-between h-16 px-4 bg-white border-b lg:px-8">
    <button @click="sidebarOpen = true" class="lg:hidden">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
            </path>
        </svg>
    </button>
    <div class="flex items-center justify-between w-full">
        <span class="text-base font-bold">TATA USAHA SMK AL - INTISAB PATOKBEUSI</span>
        <button type="button" wire:click="logout"
            class="ml-4 flex items-center text-sm px-3 py-2 rounded-lg bg-green-500 text-white hover:bg-green-600">
            Logout
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="ml-1 size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
            </svg>
        </button>
    </div>
</div>