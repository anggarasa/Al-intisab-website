<?php

namespace App\Livewire\Pages\Master\User\Siswa;

use App\Models\User;
use App\Models\Agama;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Jurusan;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\JenisKelamin;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\TataUsaha\Pembayaran\Tagihan;
use App\Models\TataUsaha\Pembayaran\JenisPembayaran;
use App\Livewire\Pages\Master\User\Siswa\ManajemenSiswa;

class ModalManajemenSiswa extends Component
{
    use WithFileUploads;
    public $name, $email, $password, $password_confirmation, $kelas, $jurusan, $jenisKelamin, $agama, $nisn, $tempatLahir, $tanggalLahir, $nik, $noHp, $foto, $namaAyah, $namaIbu, $namaWali, $alamat;

    public $jurusans, $kelases, $kelamins, $agamass;

    public $siswaId, $isEdit = false;

    public $jenisPembayarans = [];
    public $selectedJenisPembayarans = [];

    public function mount() {
        $this->jurusans = Jurusan::all();
        $this->kelases = Kelas::all();
        $this->kelamins = JenisKelamin::all();
        $this->agamass = Agama::all();
        $this->jenisPembayarans = JenisPembayaran::all();
    }

    // Tambah Siswa
    public function tambahSiswa()
    {
        DB::beginTransaction(); // Mulai transaksi database
        try {
            $validated = $this->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|lowercase|email:dns,rfc,strict|max:255|unique:users,email',
                'password' => 'required|string|confirmed|min:6',
                'kelas' => 'required|integer',
                'jurusan' => 'required|integer',
                'jenisKelamin' => 'required|integer',
                'agama' => 'required|integer',
                'nisn' => 'required|string|max:255|unique:siswas,nisn',
                'tempatLahir' => 'required|string|max:255',
                'tanggalLahir' => 'required|date',
                'nik' => 'required|string|max:255|unique:siswas,nik',
                'noHp' => 'required|string|min:9|max:13|unique:siswas,no_hp',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2024',
                'namaAyah' => 'required|string|max:255',
                'namaIbu' => 'required|string|max:255',
                'namaWali' => 'nullable|string|max:255',
                'alamat' => 'required',
                'selectedJenisPembayarans' => 'nullable|array',
            ]);

            // Simpan data user
            $user = User::create([
                'email' => $validated['email'],
                'password' => Hash::make($validated['password'])
            ]);
            $user->assignRole('siswa');

            // Simpan foto ke storage jika ada
            $fotoUrl = null;
            if ($this->foto) {
                $namaFoto = time() . '.' . $this->foto->getClientOriginalExtension();
                $fotoUrl = $this->foto->storeAs('tata-usaha/siswa/foto', $namaFoto, 'public');
            }

            // Simpan data siswa
            $siswa = Siswa::create([
                'name' => $this->name,
                'kelas_id' => $this->kelas,
                'jurusan_id' => $this->jurusan,
                'jenis_kelamin_id' => $this->jenisKelamin,
                'agama_id' => $this->agama,
                'nisn' => $this->nisn,
                'tempat_lahir' => $this->tempatLahir,
                'tanggal_lahir' => $this->tanggalLahir,
                'nik' => $this->nik,
                'no_hp' => $this->noHp,
                'foto' => $fotoUrl,
                'nama_ayah' => $this->namaAyah,
                'nama_ibu' => $this->namaIbu,
                'nama_wali' => $this->namaWali,
                'alamat' => $this->alamat,
                'user_id' => $user->id,
            ]);

            // Jika ada jenis pembayaran yang dipilih, buat tagihan per jenis pembayaran
            if (!empty($this->selectedJenisPembayarans)) {
                foreach ($this->selectedJenisPembayarans as $jenisPembayaranId) {
                    $jenisPembayaran = JenisPembayaran::findOrFail($jenisPembayaranId); // Pastikan jenis pembayaran valid

                    Tagihan::create([
                        'siswa_id' => $siswa->id,
                        'jenis_pembayaran_id' => $jenisPembayaran->id, // Pastikan ini diisi
                        'total_tagihan' => $jenisPembayaran->total,
                        'sisa_tagihan' => $jenisPembayaran->total,
                    ]);
                }
            }

            DB::commit(); // Simpan perubahan ke database jika semua proses berhasil

            // Menampilkan data real-time
            $this->dispatch('manajemen-siswa')->to(ManajemenSiswa::class);

            // Reset form
            $this->resetInput();

            // Kirim notifikasi sukses
            $this->dispatch('notificationMaster', [
                'type' => 'success',
                'message' => 'Data siswa berhasil disimpan!',
                'title' => 'Berhasil!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua perubahan jika terjadi error

            // Kirim notifikasi error
            $this->dispatch('notificationMaster', [
                'type' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'title' => 'Gagal!',
            ]);
        }
    }
    // End Tambah Siswa

    // Update Siswa
    #[On('editSiswa')]
    public function editSiswa($id)
    {
        // Ambil data siswa
        $siswa = Siswa::find($id);
        $this->isEdit = true;
        $this->siswaId = $siswa->id;
        $this->name = $siswa->name;
        $this->kelas = $siswa->kelas_id;
        $this->jurusan = $siswa->jurusan_id;
        $this->jenisKelamin = $siswa->jenis_kelamin_id;
        $this->agama = $siswa->agama_id;
        $this->nisn = $siswa->nisn;
        $this->tempatLahir = $siswa->tempat_lahir;
        $this->tanggalLahir = $siswa->tanggal_lahir;
        $this->nik = $siswa->nik;
        $this->noHp = $siswa->no_hp;
        $this->namaAyah = $siswa->nama_ayah;
        $this->namaIbu = $siswa->nama_ibu;
        $this->namaWali = $siswa->nama_wali;
        $this->alamat = $siswa->alamat;
        $this->email = $siswa->user->email;

        // Ambil jenis pembayaran yang sudah dipilih sebelumnya
        $this->selectedJenisPembayarans = []; // Reset array
        
        // Cari tagihan-tagihan siswa yang ada
        $tagihan = Tagihan::where('siswa_id', $siswa->id)->get();
        
        // Jika ada tagihan, ambil ID jenis pembayaran untuk masing-masing tagihan
        if ($tagihan->count() > 0) {
            foreach ($tagihan as $t) {
                if ($t->jenis_pembayaran_id) {
                    $this->selectedJenisPembayarans[] = $t->jenis_pembayaran_id;
                }
            }
        }

        // Ambil URL foto jika ada
        $imageUrls = $siswa->foto ? asset('storage/' . $siswa->foto) : null;
        $this->dispatch('setOldImages', [$imageUrls]);

        // Buka modal
        $this->dispatch('modal-curd-siswa');
    }

    // Perbaikan pada fungsi updateSiswa
    public function updateSiswa()
    {
        DB::beginTransaction(); // Mulai transaksi database
        try {
            $siswa = Siswa::find($this->siswaId);

            // Validasi data
            $validated = $this->validate([
                'name' => 'required|string|max:255',
                'email' => [
                    'required',
                    'lowercase',
                    'email:dns,rfc,strict',
                    'max:255',
                    Rule::unique('users', 'email')->ignore($siswa->user_id)
                ],
                'password' => 'nullable|string|confirmed|min:6',
                'kelas' => 'required|integer',
                'jurusan' => 'required|integer',
                'jenisKelamin' => 'required|integer',
                'agama' => 'required|integer',
                'nisn' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('siswas', 'nisn')->ignore($siswa->id)
                ],
                'tempatLahir' => 'required|string|max:255',
                'tanggalLahir' => 'required|date',
                'nik' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('siswas', 'nik')->ignore($siswa->id)
                ],
                'noHp' => [
                    'required',
                    'string',
                    'min:9',
                    'max:13',
                    Rule::unique('siswas', 'no_hp')->ignore($siswa->id)
                ],
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2024',
                'namaAyah' => 'required|string|max:255',
                'namaIbu' => 'required|string|max:255',
                'namaWali' => 'nullable|string|max:255',
                'alamat' => 'required',
                'selectedJenisPembayarans' => 'nullable|array',
            ]);

            // Update data user email dan password
            $user = User::find($siswa->user_id);
            $user->update([
                'email' => $validated['email'],
                'password' => $validated['password'] ? Hash::make($validated['password']) : $user->password,
            ]);

            // Tangani penghapusan foto lama jika ada foto baru
            $fotoUrl = $siswa->foto;
            if ($this->foto) {
                // Hapus foto lama jika ada
                if ($fotoUrl && Storage::disk('public')->exists($fotoUrl)) {
                    Storage::disk('public')->delete($fotoUrl);
                }

                // Simpan foto baru
                $namaFoto = time() . '.' . $this->foto->getClientOriginalExtension();
                $fotoUrl = $this->foto->storeAs('tata-usaha/siswa/foto', $namaFoto, 'public');
            }

            // Update data siswa
            $siswa->update([
                'name' => $this->name,
                'kelas_id' => $this->kelas,
                'jurusan_id' => $this->jurusan,
                'jenis_kelamin_id' => $this->jenisKelamin,
                'agama_id' => $this->agama,
                'nisn' => $this->nisn,
                'tempat_lahir' => $this->tempatLahir,
                'tanggal_lahir' => $this->tanggalLahir,
                'nik' => $this->nik,
                'no_hp' => $this->noHp,
                'foto' => $fotoUrl,
                'nama_ayah' => $this->namaAyah,
                'nama_ibu' => $this->namaIbu,
                'nama_wali' => $this->namaWali,
                'alamat' => $this->alamat,
            ]);

            // Jika ada jenis pembayaran yang dipilih, update tagihan per jenis pembayaran
            if (!empty($this->selectedJenisPembayarans)) {
                // Hapus semua tagihan yang ada terkait dengan siswa ini
                Tagihan::where('siswa_id', $siswa->id)->delete();
                
                // Buat tagihan baru berdasarkan jenis pembayaran yang dipilih
                foreach ($this->selectedJenisPembayarans as $jenisPembayaranId) {
                    $jenisPembayaran = JenisPembayaran::findOrFail($jenisPembayaranId); // Pastikan jenis pembayaran valid

                    Tagihan::create([
                        'siswa_id' => $siswa->id,
                        'jenis_pembayaran_id' => $jenisPembayaran->id,
                        'total_tagihan' => $jenisPembayaran->total,
                        'sisa_tagihan' => $jenisPembayaran->total,
                    ]);
                }
            } else {
                // Jika tidak ada jenis pembayaran yang dipilih, hapus semua tagihan
                Tagihan::where('siswa_id', $siswa->id)->delete();
            }

            DB::commit(); // Simpan perubahan ke database jika semua proses berhasil

            // Menampilkan data real-time
            $this->dispatch('manajemen-siswa')->to(ManajemenSiswa::class);

            // Reset form
            $this->resetInput();

            // Kirim notifikasi success
            $this->dispatch('notificationMaster', [
                'type' => 'success',
                'message' => 'Data siswa berhasil diperbarui!',
                'title' => 'Berhasil!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua perubahan jika terjadi error
            
            // Kirim notifikasi error
            $this->dispatch('notificationMaster', [
                'type' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'title' => 'Gagal!',
            ]);
        }
    }
    // End Update Siswa

    // Delete Data Siswa
    #[On('hapusSiswa')]
    public function hapusSiswa($id)
    {
        $siswa = Siswa::find($id);
        $this->siswaId = $siswa->id;
        $this->name = $siswa->name;

        // open modal delete
        $this->dispatch('modal-delete-siswa');
    }

    public function deleteSiswa()
    {
        DB::beginTransaction(); // Mulai transaksi database
        try {
            // Ambil data siswa
            $siswa = Siswa::find($this->siswaId);
            
            if (!$siswa) {
                throw new \Exception('Data siswa tidak ditemukan.');
            }
            
            // Hapus tagihan terkait
            Tagihan::where('siswa_id', $siswa->id)->delete();
            
            // Hapus foto jika ada
            if ($siswa->foto && Storage::disk('public')->exists($siswa->foto)) {
                Storage::disk('public')->delete($siswa->foto);
            }
            
            // Simpan user_id untuk dihapus setelah siswa
            $userId = $siswa->user_id;
            
            // Hapus data siswa
            $siswa->delete();
            
            // Hapus data user
            if ($userId) {
                $user = User::find($userId);
                if ($user) {
                    $user->delete();
                }
            }
            
            DB::commit(); // Simpan perubahan ke database jika semua proses berhasil
            
            // Menampilkan data real-time
            $this->dispatch('manajemen-siswa')->to(ManajemenSiswa::class);

            $this->resetInput();
            
            // Kirim notifikasi success
            $this->dispatch('notificationMaster', [
                'type' => 'success',
                'message' => 'Data siswa berhasil dihapus!',
                'title' => 'Berhasil!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua perubahan jika terjadi error
            
            // Kirim notifikasi error
            $this->dispatch('notificationMaster', [
                'type' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'title' => 'Gagal!',
            ]);
        }
    }
    // End Delete Data Siswa
    
    public function render()
    {
        return view('livewire.pages.master.user.siswa.modal-manajemen-siswa');
    }

    // reset input
    public function resetInput()
    {
        $this->reset([
            'name',
            'jurusan',
            'jenisKelamin',
            'agama',
            'nisn',
            'nik',
            'tempatLahir',
            'tanggalLahir',
            'email',
            'password',
            'password_confirmation',
            'kelas',
            'foto',
            'namaAyah',
            'namaIbu',
            'namaWali',
            'alamat',
            'noHp',
            'siswaId',
            'selectedJenisPembayarans',
        ]);

        $this->isEdit = false;

        // reset upload foto
        $this->dispatch('resetFileUpload');

        // close Modal
        $this->dispatch('close-modal-crud-siswa');
        $this->dispatch('close-modal-delete-siswa');
    }

    // Message custom livewire
    protected $messages = [
        'name.required' => 'Mohon isi nama siswa.',
        'email.required' => 'Mohon isi alamat email.',
        'email.email' => 'Alamat email tidak valid.',
        'email.unique' => 'Alamat email sudah digunakan.',
        'password.required' => 'Mohon isi password.',
        'password.confirmed' => 'Password tidak cocok.',
        'password.min' => 'Password minimal 6 karakter.',
        'kelas.required' => 'Mohon pilih kelas.',
        'jurusan.required' => 'Mohon pilih jurusan.',
        'jenisKelamin.required' => 'Mohon pilih jenis kelamin.',
        'agama.required' => 'Mohon pilih agama.',
        'nisn.required' => 'Mohon isi NISN.',
        'nisn.unique' => 'NISN sudah digunakan.',
        'tempatLahir.required' => 'Mohon isi tempat lahir.',
        'tanggalLahir.required' => 'Mohon isi tanggal lahir.',
        'nik.required' => 'Mohon isi NIK.',
        'nik.unique' => 'NIK sudah digunakan.',
        'noHp.required' => 'Mohon isi no HP.',
        'noHp.min' => 'No HP minimal 9 karakter.',
        'noHp.max' => 'No HP maksimal 13 karakter.',
        'noHp.unique' => 'No HP sudah digunakan.',
        'foto.image' => 'Mohon pilih file gambar.',
        'foto.mimes' => 'Mohon pilih file dengan format jpg, jpeg, atau png.',
        'foto.max' => 'Ukuran file maksimal 2MB.',
        'namaAyah.required' => 'Mohon isi nama ayah.',
        'namaIbu.required' => 'Mohon isi nama ibu.',
        'namaWali.max' => 'Nama wali maksimal 255 karakter.',
        'alamat.required' => 'Mohon isi alamat.',
    ];
}
