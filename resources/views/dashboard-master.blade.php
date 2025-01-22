<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--
    <link rel="shortcut icon" href="/imgs/logo/logo-aplikasi-ym.svg" type="image/x-icon"> --}}

    <title>Smk Al-intisab Patokbeusi - {{ $title }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />

    {{-- Font Awesome Icons --}}
    <script src="https://kit.fontawesome.com/9d4da73c07.js" crossorigin="anonymous"></script>

    {{-- Quill Editor --}}
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="bg-gray-100">

    <div x-data="{ sidebarOpen: false }">
        <!-- Sidebar -->
        <div
          :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}"
          class="fixed top-0 left-0 z-30 w-64 h-screen transition-transform duration-300 transform bg-green-800 lg:translate-x-0"
        >
          <div class="flex items-center justify-center h-16 bg-green-900">
            <span class="text-xl font-bold text-white">Admin SMK</span>
          </div>
          <nav class="p-4">
            <a
              href="#"
              class="flex items-center px-4 py-3 text-white hover:bg-green-700 rounded-lg"
            >
              <svg
                class="w-5 h-5 mr-3"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                ></path>
              </svg>
              Dashboard
            </a>
            <a
              href="#"
              class="flex items-center px-4 py-3 mt-2 text-white hover:bg-green-700 rounded-lg"
            >
              <svg
                class="w-5 h-5 mr-3"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                ></path>
              </svg>
              Siswa
            </a>
            <a
              href="#"
              class="flex items-center px-4 py-3 mt-2 text-white hover:bg-green-700 rounded-lg"
            >
              <svg
                class="w-5 h-5 mr-3"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"
                ></path>
              </svg>
              Guru
            </a>
            <a
              href="#"
              class="flex items-center px-4 py-3 mt-2 text-white hover:bg-green-700 rounded-lg"
            >
              <svg
                class="w-5 h-5 mr-3"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"
                ></path>
              </svg>
              Nilai
            </a>
            <a
              href="#"
              class="flex items-center px-4 py-3 mt-2 text-white hover:bg-green-700 rounded-lg"
            >
              <svg
                class="w-5 h-5 mr-3"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                ></path>
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                ></path>
              </svg>
              Pengaturan
            </a>
          </nav>
        </div>

        <!-- Main Content -->
        <div class="lg:ml-64">
          <!-- Top Navigation -->
          <div class="fixed top-0 right-0 left-0 z-20 flex items-center justify-between h-16 px-4 bg-white border-b lg:left-64">
            <button
              @click="sidebarOpen = !sidebarOpen"
              class="p-2 text-gray-600 rounded-md lg:hidden hover:bg-gray-100"
            >
              <svg
                class="w-6 h-6"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"
                ></path>
              </svg>
            </button>
            <div class="flex items-center">
              <button class="p-2 text-gray-600 rounded-full hover:bg-gray-100">
                <svg
                  class="w-6 h-6"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
                  ></path>
                </svg>
              </button>
              <div
                class="relative ml-3"
                x-data="{ open: false }"
              >
                <button
                  @click="open = !open"
                  class="flex items-center max-w-xs text-sm bg-gray-800 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                >
                  <img
                    class="w-8 h-8 rounded-full"
                    src="https://ui-avatars.com/api/?name=Admin&background=0D8ABC&color=fff"
                    alt=""
                  />
                </button>
                <div
                  x-show="open"
                  @click.away="open = false"
                  class="absolute right-0 w-48 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5"
                >
                  <a
                    href="#"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                    >Profil</a
                  >
                  <a
                    href="#"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                    >Pengaturan</a
                  >
                  <a
                    href="#"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                    >Keluar</a
                  >
                </div>
              </div>
            </div>
          </div>

          <!-- Content -->
          <div class="p-4 mt-16">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
              <!-- Card 1 -->
              <div class="p-6 bg-white rounded-lg shadow-sm">
                <div class="flex items-center">
                  <div class="p-3 bg-green-100 rounded-full">
                    <svg
                      class="w-8 h-8 text-green-600"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                      ></path>
                    </svg>
                  </div>
                  <div class="ml-4">
                    <h2 class="text-sm font-medium text-gray-600">Total Siswa</h2>
                    <p class="text-2xl font-semibold text-gray-800">1,257</p>
                  </div>
                </div>
              </div>

              <!-- Card 2 -->
              <div class="p-6 bg-white rounded-lg shadow-sm">
                <div class="flex items-center">
                  <div class="p-3 bg-green-100 rounded-full">
                    <svg
                      class="w-8 h-8 text-green-600"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"
                      ></path>
                    </svg>
                  </div>
                  <div class="ml-4">
                    <h2 class="text-sm font-medium text-gray-600">Total Guru</h2>
                    <p class="text-2xl font-semibold text-gray-800">84</p>
                  </div>
                </div>
              </div>

              <!-- Card 3 -->
              <div class="p-6 bg-white rounded-lg shadow-sm">
                <div class="flex items-center">
                  <div class="p-3 bg-green-100 rounded-full">
                    <svg
                      class="w-8 h-8 text-green-600"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"
                      ></path>
                    </svg>
                  </div>
                  <div class="ml-4">
                    <h2 class="text-sm font-medium text-gray-600">Total Kelas</h2>
                    <p class="text-2xl font-semibold text-gray-800">36</p>
                  </div>
                </div>
              </div>

              <!-- Card 4 -->
              <div class="p-6 bg-white rounded-lg shadow-sm">
                <div class="flex items-center">
                  <div class="p-3 bg-green-100 rounded-full">
                    <svg
                      class="w-8 h-8 text-green-600"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"
                      ></path>
                    </svg>
                  </div>
                  <div class="ml-4">
                    <h2 class="text-sm font-medium text-gray-600">Total Jurusan</h2>
                    <p class="text-2xl font-semibold text-gray-800">6</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Recent Activity -->
            <div class="mt-8">
              <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Aktivitas Terbaru</h2>
                <a
                  href="#"
                  class="text-sm font-medium text-green-600 hover:text-green-700"
                  >Lihat Semua</a
                >
              </div>
              <div class="overflow-hidden bg-white rounded-lg shadow">
                <table class="min-w-full divide-y divide-gray-200">
                  <thead class="bg-gray-50">
                    <tr>
                      <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nama</th>
                      <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Aktivitas</th>
                      <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Waktu</th>
                      <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Status</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                          <div class="flex-shrink-0 w-10 h-10">
                            <img
                              class="w-10 h-10 rounded-full"
                              src="https://ui-avatars.com/api/?name=John+Doe&background=0D8ABC&color=fff"
                              alt=""
                            />
                          </div>
                          <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">John Doe</div>
                            <div class="text-sm text-gray-500">Kelas X RPL 1</div>
                          </div>
                        </div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">Mengumpulkan Tugas</div>
                        <div class="text-sm text-gray-500">Pemrograman Web</div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">5 menit yang lalu</div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full"> Selesai </span>
                      </td>
                    </tr>
                    <!-- More rows... -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

    @livewireScripts
</body>

</html>
