<?php

namespace App\Livewire\Pages\TataUsaha\Siswa;

use App\Models\User;
use App\Models\Agama;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Jurusan;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\JenisKelamin;
use App\Models\TataUsaha\Pembayaran\JenisPembayaran;
use App\Models\TataUsaha\Pembayaran\Tagihan;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
    
            // Simpan data user email dan password
            $user = User::create([
                'email' => $validated['email'],
                'password' => Hash::make($validated['password'])
            ]);
            $user->assignRole('siswa');
    
            // Simpan data foto ke storage jika ada
            $fotoUrl = null; // Inisialisasi fotoUrl
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
    
            // Jika ada jenis pembayaran yang dipilih, buat tagihan
            if (!empty($this->selectedJenisPembayarans)) {
                $totalTagihan = JenisPembayaran::whereIn('id', $this->selectedJenisPembayarans)->sum('total');
    
                $tagihan = Tagihan::create([
                    'siswa_id' => $siswa->id,
                    'total_tagihan' => $totalTagihan,
                    'sisa_tagihan' => $totalTagihan,
                ]);
    
                $tagihan->jenisPembayarans()->attach($this->selectedJenisPembayarans);
            }
    
            // Menampilkan data real-time
            $this->dispatch('manajemen-siswa')->to(ManajemenSiswa::class);
    
            // Reset form
            $this->resetInput();
    
            // Kirim notifikasi success
            $this->dispatch('notificationTataUsaha', [
                'type' => 'success',
                'message' => 'Data siswa berhasil disimpan!',
                'title' => 'Berhasil!',
            ]);
        } catch (\Exception $e) {
            // Kirim notifikasi error
            $this->dispatch('notificationTataUsaha', [
                'type' => 'error',
                'message' => $e->getMessage(),
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
        if ($siswa->tagihan) {
            $this->selectedJenisPembayarans = $siswa->tagihan->jenisPembayarans
                ->pluck('id') // Ambil hanya id-nya
                ->toArray(); // Konversi ke array
        } else {
            $this->selectedJenisPembayarans = []; // Jika tidak ada tagihan, set ke array kosong
        }

        // Ambil URL foto jika ada
        $imageUrls = $siswa->foto ? asset('storage/' . $siswa->foto) : null;
        $this->dispatch('setOldImages', [$imageUrls]);

        // Buka modal
        $this->dispatch('modal-curd-siswa');
    }
    
    public function updateSiswa()
    {
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
                'selectedJenisPembayarans' => 'nullable|array', // Validasi untuk jenis pembayaran
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

            // Update atau buat tagihan jika ada jenis pembayaran yang dipilih
            if (!empty($this->selectedJenisPembayarans)) {
                // Hitung total tagihan
                $totalTagihan = JenisPembayaran::whereIn('id', $this->selectedJenisPembayarans)->sum('total');

                // Cek apakah tagihan sudah ada
                $tagihan = $siswa->tagihan;

                if ($tagihan) {
                    // Update tagihan yang sudah ada
                    $tagihan->update([
                        'total_tagihan' => $totalTagihan,
                        'sisa_tagihan' => $totalTagihan, // Reset sisa tagihan jika diperlukan
                    ]);
                } else {
                    // Buat tagihan baru
                    $tagihan = Tagihan::create([
                        'siswa_id' => $siswa->id,
                        'total_tagihan' => $totalTagihan,
                        'sisa_tagihan' => $totalTagihan,
                    ]);
                }

                // Sync jenis pembayaran yang dipilih
                $tagihan->jenisPembayarans()->sync($this->selectedJenisPembayarans);
            }

            // Menampilkan data real-time
            $this->dispatch('manajemen-siswa')->to(ManajemenSiswa::class);

            // Reset form
            $this->resetInput();

            // Kirim notifikasi success
            $this->dispatch('notificationTataUsaha', [
                'type' => 'success',
                'message' => 'Data siswa berhasil diperbarui!',
                'title' => 'Berhasil!',
            ]);
        } catch (\Exception $e) {
            // Kirim notifikasi error
            $this->dispatch('notificationTataUsaha', [
                'type' => 'error',
                'message' => $e->getMessage(),
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
        try {
            $siswa = Siswa::find($this->siswaId);

            // Hapus foto siswa dari storage
            if ($siswa->foto && Storage::disk('public')->exists($siswa->foto)) {
                Storage::disk('public')->delete($siswa->foto);
            }

            // Hapus tagihan dan relasi jenis pembayaran jika ada
            if ($siswa->tagihan) {
                // Hapus relasi jenis pembayaran
                $siswa->tagihan->jenisPembayarans()->detach();

                // Hapus tagihan
                $siswa->tagihan->delete();
            }

            // Hapus data user yang berelasi
            $siswa->user()->delete();

            // Hapus data siswa
            $siswa->delete();

            // Menampilkan data real-time
            $this->dispatch('manajemen-siswa')->to(ManajemenSiswa::class);

            // Reset input
            $this->resetInput();

            // Kirim notifikasi success
            $this->dispatch('notificationTataUsaha', [
                'type' => 'success',
                'message' => 'Berhasil menghapus data siswa',
                'title' => 'Berhasil!'
            ]);
        } catch (\Exception $e) {
            // Kirim notifikasi error
            $this->dispatch('notificationTataUsaha', [
                'type' => 'error',
                'message' => 'Gagal menghapus data siswa: ' . $e->getMessage(),
                'title' => 'Gagal!'
            ]);
        }
    }
    // End Delete Data Siswa
    
    public function render()
    {
        return view('livewire.pages.tata-usaha.siswa.modal-manajemen-siswa');
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
        'name.required' => 'Nama siswa harus diisi.',
        'email.required' => 'Email harus diisi.',
        'email.email' => 'Email harus valid.',
        'email.unique' => 'Email sudah digunakan.',
        'password.required' => 'Password harus diisi.',
        'password.confirmed' => 'Password tidak cocok.',
        'password.min' => 'Password minimal 6 karakter.',
        'kelas.required' => 'Kelas harus diisi.',
        'jurusan.required' => 'Jurusan harus diisi.',
        'jenisKelamin.required' => 'Jenis kelamin harus diisi.',
        'agama.required' => 'Agama harus diisi.',
        'nisn.required' => 'NISN harus diisi.',
        'nisn.unique' => 'NISN sudah digunakan.',
        'tempatLahir.required' => 'Tempat lahir harus diisi.',
        'tanggalLahir.required' => 'Tanggal lahir harus diisi.',
        'nik.required' => 'NIK harus diisi.',
        'nik.unique' => 'NIK sudah digunakan.',
        'noHp.required' => 'No HP harus diisi.',
        'noHp.min' => 'No HP minimal 9 karakter.',
        'noHp.max' => 'No HP maksimal 13 karakter.',
        'noHp.unique' => 'No HP sudah digunakan.',
        'foto.image' => 'Foto harus berupa gambar.',
        'foto.mimes' => 'Foto harus berupa jpg, jpeg, atau png.',
        'foto.max' => 'Foto maksimal 2MB.',
        'namaAyah.required' => 'Nama ayah harus diisi.',
        'namaIbu.required' => 'Nama ibu harus diisi.',
        'namaWali.max' => 'Nama wali maksimal 255 karakter.',
        'alamat.required' => 'Alamat harus diisi.',
    ];
}
