# SMK Al-Intisab Patokbeusi Website

Website resmi SMK Al-Intisab Patokbeusi dirancang untuk memberikan informasi lengkap mengenai sekolah, mulai dari siswa, orang tua, kurikulum, guru, tata usaha, hingga keuangan. Website ini dibangun menggunakan Laravel Livewire, TailwindCSS, dan Alpine.js untuk memberikan pengalaman yang interaktif dan responsif.

## Fitur Utama

-   **Siswa**: Informasi akademik dan kegiatan siswa.
-   **Orang Tua**: Akses informasi perkembangan siswa dan komunikasi dengan sekolah.
-   **Kurikulum**: Penyajian struktur dan materi pembelajaran.
-   **Guru**: Manajemen data guru dan kegiatan pembelajaran.
-   **Tata Usaha**: Pengelolaan administrasi sekolah.
-   **Keuangan**: Informasi keuangan dan pembayaran.

## Teknologi yang Digunakan

-   **Laravel Livewire**: Untuk pengembangan backend yang dinamis.
-   **TailwindCSS**: Untuk tampilan yang modern dan responsif.
-   **Alpine.js**: Untuk interaktivitas di frontend.

## Instalasi

1. Clone repository:
    ```bash
    git clone https://github.com/anggarasa/Al-intisab-website.git
    ```
2. Masuk ke direktori project:
    ```bash
    cd Al-intisab-website
    ```
3. Install dependencies:
    ```bash
    composer install
    npm install && npm run dev
    ```
4. Copy file `.env` dan sesuaikan konfigurasi:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
5. Jalankan migrasi database:
    ```bash
    php artisan migrate
    ```
6. Jalankan server:
    ```bash
    php artisan serve
    ```

## Tampilan

![Logo SMK Al-Intisab Patokbeusi](public/images/logo-sekolah.png)

---

Website ini dikembangkan untuk mendukung kemajuan pendidikan di SMK Al-Intisab Patokbeusi.

**Developer:** [Anggara Saputra, Reihan Ariansyah, Muhammad Islam Zaini Al Fatih, Dewi Apriyani, Aldi Septian Prayoga]
