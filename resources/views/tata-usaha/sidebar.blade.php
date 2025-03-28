<!-- Sidebar Mobile -->
<div x-show="sidebarOpen" class="fixed inset-0 z-40 lg:hidden"
  x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
  x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
  x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
  <div class="fixed inset-0 bg-gray-600 bg-opacity-75"></div>
  <div class="fixed inset-y-0 left-0 flex flex-col w-64 bg-white border-r">
    <div class="flex items-center justify-between h-48 px-4 border-b">
      <img src="{{ asset('imgs/logo/logo-intisab.svg') }}" class="ml-10 w-36 h-36 object-cover" alt="SML al-intisab">
      <button @click="sidebarOpen = false" class="lg:hidden absolute top-4 right-4">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>
    <nav class="flex-1 overflow-y-auto">
      <ul class="p-4">

        <x-sidebar-menu-item href="{{ route('tata-usaha.dashboard') }}" label="Dashboard" icon="fas fa-home"
          :active="request()->routeIs('tata-usaha.dashboard')" />

        <x-sidebar-menu-item href="{{ route('tata-usaha.manajemen-kelas.manajemen') }}" label="Kelas"
          icon="fas fa-school" :active="request()->routeIs('tata-usaha.manajemen-kelas.manajemen')" />

        <!-- Jenis pembayaran -->
        <x-sidebar-menu-item href="{{ route('tata-usaha.manajemen-pembayaran.jenis-pembayaran') }}"
          label="Jenis Pembayaran" icon="fas fa-money-check-dollar"
          :active="request()->routeIs('tata-usaha.manajemen-pembayaran.jenis-pembayaran')" />

        <!-- Siswa & Guru -->
        <x-sidebar-dropdown title="Siswa & Guru" icon="fas fa-users" :links="[
            ['label' => 'Manajemen Siswa', 'url' => '/tata-usaha/manajemen-siswa/Siswa'],
            ['label' => 'Manajemen Guru', 'url' => '/tata-usaha/manajemen-Guru/Guru'],
        ]" />

        <!-- Input pembayaran -->
        <x-sidebar-menu-item href="{{ route('tata-usaha.input-pembayaran') }}" label="Input Pembayaran"
          icon="fas fa-cash-register" :active="request()->routeIs('tata-usaha.input-pembayaran')" />

        <!-- Input pembayaran -->
        <x-sidebar-menu-item href="{{ route('tata-usaha.riwayat-pembayaran') }}" label="Riwayat Pembayaran"
          icon="fas fa-file-invoice-dollar" :active="request()->routeIs('tata-usaha.riwayat-pembayaran')" />

        <!-- Settings Dropdown -->
        <li class="mb-2">
          <div @click="settingsDropdown = !settingsDropdown"
            class="block px-4 py-2 text-gray-800 rounded hover:bg-pink-100 cursor-pointer flex justify-between items-center">
            <span>Settings</span>
            <svg class="w-4 h-4 transition-transform" :class="{'rotate-180': settingsDropdown}" fill="none"
              stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
          </div>
          <ul x-show="settingsDropdown" class="pl-6">
            <li>
              <a href="#" class="block px-4 py-2 text-gray-800 rounded hover:bg-pink-100">Profile</a>
            </li>
            <li>
              <a href="#" class="block px-4 py-2 text-gray-800 rounded hover:bg-pink-100">Account</a>
            </li>
            <li>
              <a href="#" class="block px-4 py-2 text-gray-800 rounded hover:bg-pink-100">Security</a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</div>

<!-- Sidebar Desktop -->
<div class="hidden lg:fixed lg:inset-y-0 lg:flex lg:w-72 lg:flex-col">
  <div class="flex flex-col flex-1 min-h-0 bg-white border-r">
    <div class="flex items-center justify-center h-48 px-4 border-b">
      <img src="{{ asset('imgs/logo/logo-intisab.svg') }}" class="w-36 h-3w-36 object-cover" alt="SML al-intisab">
    </div>
    <nav class="flex-1 overflow-y-auto">
      <ul class="p-4">

        <x-sidebar-menu-item href="{{ route('tata-usaha.dashboard') }}" label="Dashboard" icon="fas fa-home"
          :active="request()->routeIs('tata-usaha.dashboard')" />

        <x-sidebar-menu-item href="{{ route('tata-usaha.manajemen-kelas.manajemen') }}" label="Kelas"
          icon="fas fa-school" :active="request()->routeIs('tata-usaha.manajemen-kelas.manajemen')" />

        <!-- Jenis pembayaran -->
        <x-sidebar-menu-item href="{{ route('tata-usaha.manajemen-pembayaran.jenis-pembayaran') }}"
          label="Jenis Pembayaran" icon="fas fa-money-check-dollar"
          :active="request()->routeIs('tata-usaha.manajemen-pembayaran.jenis-pembayaran')" />

        <!-- Siswa & Guru -->
        <x-sidebar-dropdown title="Siswa & Guru" icon="fas fa-users" :links="[
            ['label' => 'Manajemen Siswa', 'url' => '/tata-usaha/manajemen-siswa/Siswa'],
            ['label' => 'Manajemen Guru', 'url' => '/tata-usaha/manajemen-Guru/Guru'],
        ]" />

        <!-- Input pembayaran -->
        <x-sidebar-menu-item href="{{ route('tata-usaha.input-pembayaran') }}" label="Input Pembayaran"
          icon="fas fa-cash-register" :active="request()->routeIs('tata-usaha.input-pembayaran')" />

        <!-- Input pembayaran -->
        <x-sidebar-menu-item href="{{ route('tata-usaha.riwayat-pembayaran') }}" label="Riwayat Pembayaran"
          icon="fas fa-file-invoice-dollar" :active="request()->routeIs('tata-usaha.riwayat-pembayaran')" />

        <!-- Absensi -->
        <x-sidebar-dropdown title="Absensi" icon="fas fa-clock" :links="[
          ['label' => 'Siswa', 'url' => '/tata-usaha/manajemen-siswa/Siswa'],
          ['label' => 'Guru', 'url' => '/tata-usaha/manajemen-Guru/Guru'],
          ]" />


        <!-- Settings Dropdown -->
        <li class="mb-2">
          <div @click="settingsDropdown = !settingsDropdown"
            class="block px-4 py-2 text-gray-800 rounded hover:bg-green-500 hover:text-white cursor-pointer flex justify-between items-center">
            <span>Settings</span>
            <svg class="w-4 h-4 transition-transform" :class="{'rotate-180': settingsDropdown}" fill="none"
              stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
          </div>
          <ul x-show="settingsDropdown" class="pl-6">
            <li>
              <a href="#" class="block px-4 py-2 text-gray-800 rounded hover:bg-green-500 hover:text-white">Profile</a>
            </li>
            <li>
              <a href="#" class="block px-4 py-2 text-gray-800 rounded hover:bg-green-500 hover:text-white">Account</a>
            </li>
            <li>
              <a href="#" class="block px-4 py-2 text-gray-800 rounded hover:bg-green-500 hover:text-white">Security</a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</div>