<div>
    <!-- Sidebar Mobile -->
    <div x-show="sidebarOpen" class="fixed inset-0 z-40 lg:hidden"
        x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="fixed inset-0 bg-gray-600 bg-opacity-75"></div>
        <div class="fixed inset-y-0 left-0 flex flex-col w-64 bg-white border-r">
            <div class="flex items-center justify-between h-48 px-4 border-b">
                @forelse ($logos as $logo)
                <img src="{{ asset('storage/'. $logo->logo) }}" class="ml-10 w-36 h-36 object-cover"
                    alt="SML al-intisab">
                @empty
                <img src="{{ asset('imgs/logo/logo-intisab.svg') }}" class="ml-10 w-36 h-36 object-cover"
                    alt="SML al-intisab">
                @endforelse
                <button @click="sidebarOpen = false" class="lg:hidden absolute top-4 right-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <nav class="flex-1 overflow-y-auto">
                <ul class="p-4">

                    {{-- Dasboard Master --}}
                    <x-sidebar-menu-item href="{{ route('master.dashboard-master') }}" label="Dashboard"
                        icon="fas fa-home" :active="request()->routeIs('master.dashboard-master')" />

                    {{-- identitas sekolah --}}
                    <x-sidebar-menu-item href="{{ route('master.manajemen.identitas-sekolah') }}"
                        label="Identitas Sekolah" icon="fas fa-address-card"
                        :active="request()->routeIs('master.manajemen.identitas-sekolah')" />

                    <!-- Manajemen Data -->
                    <x-sidebar-dropdown title="Manajemen Data" icon="fas fa-database" :links="[
        ['label' => 'Jenis PTK', 'url' => '/master/manajemen/jenis-ptk'],
        ['label' => 'Manajemen Jurusan', 'url' => '/master/manajemen/jurusan'],
        ['label' => 'Manajemen Kelas', 'url' => '/master/manajemen/kelas'],
        ['label' => 'Manajemen Agama', 'url' => '/master/manajemen/agama'],
        ['label' => 'Jenis Pembayaran', 'url' => '/master/manajemen/jenis-pembayaran'],
        ['label' => 'Manajemen Guru', 'url' => '/master/manajemen/guru'],
        ['label' => 'Manajemen Siswa', 'url' => '/master/manajemen/siswa'],
        ]" />

                    <!-- Input pembayaran -->
                    <x-sidebar-menu-item href="{{ route('master.input-pembayaran') }}" label="Input Pembayaran"
                        icon="fas fa-cash-register" :active="request()->routeIs('master.input-pembayaran')" />

                    <!-- Riwayat pembayaran -->
                    <x-sidebar-menu-item href="{{ route('master.riwayat-pembayaran') }}" label="Riwayat Pembayaran"
                        icon="fas fa-file-invoice-dollar" :active="request()->routeIs('master.riwayat-pembayaran')" />

                    <!-- Tahun Ajaran & Kurikulum -->
                    <x-sidebar-dropdown title="Tahun Ajaran & Kurikulum" icon="fas fa-book-open-reader" :links="[
          ['label' => 'Manajemen Kurikulum', 'url' => '/master/manajemen/kurikulum'],
          ['label' => 'Tahun Pelajaran', 'url' => '/master/manajemen/siswa'],
          ]" />


                    <!-- Absensi -->
                    <x-sidebar-dropdown title="Absensi" icon="fas fa-clock" :links="[
          ['label' => 'Siswa', 'url' => '/tata-usaha/manajemen-siswa/Siswa'],
          ['label' => 'Guru', 'url' => '/tata-usaha/manajemen-Guru/Guru'],
      ]" />

                    <!-- users -->
                    <x-sidebar-menu-item href="{{ route('master.manajemen.user') }}" label="Manajemen User"
                        icon="fas fa-user" :active="request()->routeIs('master.manajemen.user')" />
                </ul>
            </nav>
        </div>
    </div>

    <!-- Sidebar Desktop -->
    <div class="hidden lg:fixed lg:inset-y-0 lg:flex lg:w-72 lg:flex-col">
        <div class="flex flex-col flex-1 min-h-0 bg-white border-r">
            <div class="flex items-center justify-center h-48 px-4 border-b">
                @forelse ($logos as $logo)
                <img src="{{ asset('storage/'. $logo->logo) }}" class="ml-10 w-36 h-36 object-cover"
                    alt="SML al-intisab">
                @empty
                <img src="{{ asset('imgs/logo/logo-intisab.svg') }}" class="ml-10 w-36 h-36 object-cover"
                    alt="SML al-intisab">
                @endforelse
            </div>
            <nav class="flex-1 overflow-y-auto">
                <ul class="p-4">

                    {{-- Dasboard Master --}}
                    <x-sidebar-menu-item href="{{ route('master.dashboard-master') }}" label="Dashboard"
                        icon="fas fa-home" :active="request()->routeIs('master.dashboard-master')" />

                    {{-- identitas sekolah --}}
                    <x-sidebar-menu-item href="{{ route('master.manajemen.identitas-sekolah') }}"
                        label="Identitas Sekolah" icon="fas fa-address-card"
                        :active="request()->routeIs('master.manajemen.identitas-sekolah')" />

                    <!-- Manajemen Data -->
                    <x-sidebar-dropdown title="Manajemen Data" icon="fas fa-database" :links="[
        ['label' => 'Jenis PTK', 'url' => '/master/manajemen/jenis-ptk'],
        ['label' => 'Manajemen Jurusan', 'url' => '/master/manajemen/jurusan'],
        ['label' => 'Manajemen Kelas', 'url' => '/master/manajemen/kelas'],
        ['label' => 'Manajemen Agama', 'url' => '/master/manajemen/agama'],
        ['label' => 'Jenis Pembayaran', 'url' => '/master/manajemen/jenis-pembayaran'],
        ['label' => 'Manajemen Guru', 'url' => '/master/manajemen/guru'],
        ['label' => 'Manajemen Siswa', 'url' => '/master/manajemen/siswa'],
        ]" />

                    <!-- Input pembayaran -->
                    <x-sidebar-menu-item href="{{ route('master.input-pembayaran') }}" label="Input Pembayaran"
                        icon="fas fa-cash-register" :active="request()->routeIs('master.input-pembayaran')" />

                    <!-- Riwayat pembayaran -->
                    <x-sidebar-menu-item href="{{ route('master.riwayat-pembayaran') }}" label="Riwayat Pembayaran"
                        icon="fas fa-file-invoice-dollar" :active="request()->routeIs('master.riwayat-pembayaran')" />

                    <!-- Tahun Ajaran & Kurikulum -->
                    <x-sidebar-dropdown title="Tahun Ajaran & Kurikulum" icon="fas fa-book-open-reader" :links="[
          ['label' => 'Manajemen Kurikulum', 'url' => '/master/manajemen/kurikulum'],
          ['label' => 'Tahun Pelajaran', 'url' => '/master/manajemen/siswa'],
          ]" />


                    <!-- Absensi -->
                    <x-sidebar-dropdown title="Absensi" icon="fas fa-clock" :links="[
          ['label' => 'Siswa', 'url' => '/tata-usaha/manajemen-siswa/Siswa'],
          ['label' => 'Guru', 'url' => '/tata-usaha/manajemen-Guru/Guru'],
      ]" />

                    <!-- users -->
                    <x-sidebar-menu-item href="{{ route('master.manajemen.user') }}" label="Manajemen User"
                        icon="fas fa-user" :active="request()->routeIs('master.manajemen.user')" />
                </ul>
            </nav>
        </div>
    </div>
</div>