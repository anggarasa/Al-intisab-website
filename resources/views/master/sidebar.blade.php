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

        <x-sidebar-menu-item href="{{ route('master.dashboard-master') }}" label="Dashboard" icon="fas fa-home"
          :active="request()->routeIs('master.dashboard-master')" />

        <!-- Manajemen Data -->
        <x-sidebar-menu-item href="{{ route('master.manajemen.data') }}" label="Manajemen Data" icon="fas fa-database"
          :active="request()->routeIs('master.manajemen.data')" />

        <!-- Manajemen User -->
        <x-sidebar-menu-item href="{{ route('master.manajemen.user') }}" label="Manajemen User" icon="fas fa-user"
          :active="request()->routeIs('master.manajemen.user')" />

        <!-- Pembayaran -->
        <x-sidebar-dropdown title="Pembayaran" icon="fas fa-cash-register" :links="[
            ['label' => 'SPP', 'url' => '/tata-usaha/manajemen-siswa/Siswa'],
            ['label' => 'Baju', 'url' => '/tata-usaha/manajemen-Guru/Guru'],
            ['label' => 'PKL', 'url' => '/tata-usaha/manajemen-Guru/Guru'],
        ]" />

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

<!-- Sidebar Desktop -->
<div class="hidden lg:fixed lg:inset-y-0 lg:flex lg:w-64 lg:flex-col">
  <div class="flex flex-col flex-1 min-h-0 bg-white border-r">
    <div class="flex items-center justify-center h-48 px-4 border-b">
      <img src="{{ asset('imgs/logo/logo-intisab.svg') }}" class="w-36 h-3w-36 object-cover" alt="SML al-intisab">
    </div>
    <nav class="flex-1 overflow-y-auto">
      <ul class="p-4">

        {{-- Dasboard Master --}}
        <x-sidebar-menu-item href="{{ route('master.dashboard-master') }}" label="Dashboard" icon="fas fa-home"
          :active="request()->routeIs('master.dashboard-master')" />

        <!-- Manajemen Data -->
        <x-sidebar-menu-item href="{{ route('master.manajemen.data') }}" label="Manajemen Data" icon="fas fa-database"
          :active="request()->routeIs('master.manajemen.data')" />

        <!-- Manajemen Data -->
        <x-sidebar-menu-item href="{{ route('master.manajemen.kelas') }}" label="Manajemen Kelas" icon="fas fa-school"
          :active="request()->routeIs('master.manajemen.kelas')" />

        <!-- Manajemen User -->
        <x-sidebar-dropdown title="Users" icon="fas fa-users" :links="[
            ['label' => 'Manajemen User', 'url' => '/master/manajemen/user'],
            ['label' => 'Manajemen Siswa', 'url' => '/master/manajemen/siswa'],
            ['label' => 'Manajemen Guru', 'url' => '/master/manajemen/guru'],
        ]" />

        <!-- Pembayaran -->
        <x-sidebar-dropdown title="Pembayaran" icon="fas fa-cash-register" :links="[
            ['label' => 'SPP', 'url' => '/tata-usaha/manajemen-siswa/Siswa'],
            ['label' => 'Baju', 'url' => '/tata-usaha/manajemen-Guru/Guru'],
            ['label' => 'PKL', 'url' => '/tata-usaha/manajemen-Guru/Guru'],
        ]" />

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