<!-- Dashboard Content -->
<main class="p-4 lg:p-8" x-data="{
    sekolah: {
        nama: 'SMK Al-intisab Patokbeusi',
        npsn: '12345678',
        alamat: 'Jl. Pendidikan No. 123',
        kelurahan: 'Maju Jaya',
        kecamatan: 'Sejahtera',
        kota: 'Kabupaten Subang',
        provinsi: 'Provinsi Jawa Barat',
        kodePos: '12345',
        telepon: '(021) 1234567',
        email: 'smkn1@contoh.sch.id',
        website: 'www.smkn1contoh.sch.id',
        akreditasi: 'A',
        kepalaSekolah: 'Drs. Budi Santoso, M.Pd.',
        visi: 'Menjadi sekolah unggul yang menghasilkan lulusan berkompeten, berkarakter, dan berwawasan global',
        tahunBerdiri: '1975'
    },
    activeTab: 'identitas',
    showModal: false
}">
    <!-- Stats Cards -->
    <div class=" grid grid-cols-1 gap-4 mb-8 sm:grid-cols-2 lg:grid-cols-3">
        <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="flex items-center">
                <div class="p-3 bg-green-100 rounded-lg">
                    <i class="fa-solid fa-user-check text-2xl text-green-600"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500">Siswa Aktif</h3>
                    <p class="text-lg font-semibold text-gray-800">156</p>
                </div>
            </div>
        </div>

        <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="flex items-center">
                <div class="p-3 bg-red-100 rounded-lg">
                    <i class="fa-solid fa-user-xmark text-2xl text-red-600"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500">Siswa Mutasi</h3>
                    <p class="text-lg font-semibold text-gray-800">89</p>
                </div>
            </div>
        </div>

        <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="flex items-center">
                <div class="p-3 bg-yellow-100 rounded-lg">
                    <i class="fa-solid fa-users text-2xl text-yellow-600"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500">
                        Data Alumni
                    </h3>
                    <p class="text-lg BGPI font-semibold text-gray-800">67</p>
                </div>
            </div>
        </div>
    </div>

    <div class="lg:grid lg:grid-cols-12 lg:gap-x-6">
        <!-- Main Content di Kiri -->
        <div class="lg:col-span-8 xl:col-span-8 pb-12">
            <div class="max-w-7xl mx-auto">
                <!-- Header Card -->
                <div
                    class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8 transition-transform duration-300 hover:scale-[1.01]">
                    <div class="bg-gradient-to-r from-green-600 to-green-400 px-6 py-8">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div>
                                <h2 class="text-3xl font-bold text-white mb-2">{{ $identitas->nama_sekolah }}</h2>
                                <p class="text-green-50">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>{{ $identitas->kabupaten_kota }}, {{ $identitas->provinsi }}</span>
                                </p>
                            </div>
                            <div class="mt-4 md:mt-0">
                                <span class="bg-white px-4 py-2 rounded-full text-green-600 font-semibold shadow-md">
                                    <i class="fas fa-award mr-2"></i>Akreditasi
                                    <span>{{ $identitas->akreditasi }}</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                    <!-- Card Examples -->
                    <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="flex items-center space-x-4">
                            <div class="bg-green-100 p-3 rounded-full">
                                <i class="fas fa-id-card text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">NPSN</p>
                                <p class="font-semibold text-lg">{{ $identitas->npsn }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Kepala Sekolah Card -->
                    <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="flex items-center space-x-4">
                            <div class="bg-green-100 p-3 rounded-full">
                                <i class="fas fa-user-tie text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Kepala Sekolah</p>
                                <p class="font-semibold text-lg">{{ $identitas->kepala_sekolah }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Alamat Card -->
                <div
                    class="bg-white mt-6 p-6 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 lg:col-span-2">
                    <div class="flex items-start space-x-4">
                        <div class="bg-green-100 p-3 rounded-full">
                            <i class="fas fa-map-marked-alt text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm mb-2">Alamat Lengkap</p>
                            <p class="text-gray-800">
                                <span>{{ $identitas->alamat_sekolah }}</span><br />
                                Kel. <span>{{ $identitas->kelurahan }}</span>, Kec.
                                <span>{{ $identitas->kecamatan }}</span><br />
                                <span>{{ $identitas->kecamatan }}</span>,
                                <span>{{ $identitas->provinsi }}</span><br />
                                Kode Pos: <span>{{ $identitas->kode_pos }}</span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Kontak Card -->
                <div class="bg-white mt-6 p-6 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-start space-x-4">
                        <div class="bg-green-100 p-3 rounded-full">
                            <i class="fas fa-address-book text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm mb-2">Kontak</p>
                            <p class="text-gray-800">
                                <i class="fas fa-phone-alt mr-2 text-green-600"></i><span>{{ $identitas->no_telpone
                                    }}</span><br />
                                <i class="fas fa-envelope mr-2 text-green-600"></i><span>{{ $identitas->email
                                    }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar (Chart) di Kanan -->
        <aside class="lg:col-span-4 xl:col-span-4">
            <!-- Chart Siswa & siswi -->
            <div class="space-y-4 my-6">
                <div
                    class="bg-white shadow-lg rounded-lg p-6 relative overflow-hidden flex justify-center items-center h-96">
                    <canvas id="muridPieChart" class="w-full h-full"></canvas>
                </div>
            </div>

            <!-- Chart Guru Laki-laki & Perempuan -->
            <div class="space-y-4 my-6">
                <div
                    class="bg-white shadow-lg rounded-lg p-6 relative overflow-hidden flex justify-center items-center h-96">
                    <canvas id="guruPieChart" class="w-full h-full"></canvas>
                </div>
            </div>
        </aside>
    </div>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Chart Siswa & Siswi
        const ctxMurid = document.getElementById('muridPieChart').getContext('2d');
    
        const dataMurid = {
            labels: ['SISWA LAKI-LAKI', 'SISWI PEREMPUAN'],
            datasets: [{
                data: [60, 40],
                backgroundColor: ['#0000FF', '#ec4899'],
                hoverOffset: 4
            }]
        };
    
        const configMurid = {
            type: 'pie',
            data: dataMurid,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                // Menentukan kata yang tepat berdasarkan label
                                const label = tooltipItem.label;
                                const count = tooltipItem.raw;
                                let muridType = 'murid'; // Default
    
                                if (label === 'SISWA LAKI-LAKI') {
                                    muridType = 'SISWA';
                                } else if (label === 'SISWI PEREMPUAN') {
                                    muridType = 'SISWI';
                                }
    
                                return `${label}: ${count} ${muridType}`;
                            }
                        }
                    }
                }
            }
        };
    
        new Chart(ctxMurid, configMurid);
        // Chart Siswa & Siswi

        // Chart Guru
        const ctxGuru = document.getElementById('guruPieChart').getContext('2d');
    
        const dataGuru = {
            labels: ['GURU LAKI-LAKI', 'GURU PEREMPUAN'],
            datasets: [{
                data: [30, 70],
                backgroundColor: ['#22c55e', '#8b5cf6'],
                hoverOffset: 4
            }]
        };
    
        const configGuru = {
            type: 'pie',
            data: dataGuru,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' GURU';
                            }
                        }
                    }
                }
            }
        };
    
        new Chart(ctxGuru, configGuru);
        // Chart Guru
    </script>

</main>