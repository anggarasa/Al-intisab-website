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
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ModalManajemenSiswa extends Component
{
    use WithFileUploads;
    public $name, $email, $password, $password_confirmation, $kelas, $jurusan, $jenisKelamin, $agama, $nisn, $tempatLahir, $tanggalLahir, $nik, $noHp, $foto, $namaAyah, $namaIbu, $namaWali, $alamat;

    public $jurusans, $kelases, $kelamins, $agamass;

    public $siswaId, $isEdit = false;

    public function mount() {
        $this->jurusans = Jurusan::all();
        $this->kelases = Kelas::all();
        $this->kelamins = JenisKelamin::all();
        $this->agamass = Agama::all();
    }

    // Tambah Siswa
    public function tambahSiswa()
    {
        try {
            $validated = $this->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|lowercase|email:dns,rfc,strict|max:255|unique:users',
                'password' => 'required|string|confirmed|min:6',
                'kelas' => 'required|integer',
                'jurusan' => 'required|integer',
                'jenisKelamin' => 'required|integer',
                'agama' => 'required|integer',
                'nisn' => 'required|string|max:255',
                'tempatLahir' => 'required|string|max:255',
                'tanggalLahir' => 'required|date',
                'nik' => 'required|string|max:255',
                'noHp' => 'required|string|min:9|max:13',
                'foto' => 'required|image|mimes:jpg,jpeg,png|max:2024',
                'namaAyah' => 'required|string|max:255',
                'namaIbu' => 'required|string|max:255',
                'namaWali' => 'nullable|string|max:255',
                'alamat' => 'required',
            ]);

            // Simpan data user email dan password
            $user = User::create([
                'email' => $validated['email'],
                'password' => Hash::make($validated['password'])
            ]);
            $user->assignRole('siswa');

            // Simpan data foto ke storage
            $namaFoto = time().'.'.$this->foto->getClientOriginalExtension();
            $fotoUrl = $this->foto->storeAs('tata-usaha/siswa/foto', $namaFoto, 'public');

            // Siswan data siswa
            Siswa::create([
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
            if ($siswa->foto && Storage::exists($siswa->foto)) {
                Storage::delete($siswa->foto);
            }

            // Hapus data user yang berelasi
            $siswa->user()->delete();

            // Hapus data siswa
            $siswa->delete();

            // Menampilkan data real-time
            $this->dispatch('manajemen-siswa')->to(ManajemenSiswa::class);
            
            // reset input
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
                'message' => 'Gagal menghapus data siswa',
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
        ]);

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
        'tempatLahir.required' => 'Tempat lahir harus diisi.',
        'tanggalLahir.required' => 'Tanggal lahir harus diisi.',
        'nik.required' => 'NIK harus diisi.',
        'noHp.required' => 'No HP harus diisi.',
        'noHp.min' => 'No HP minimal 9 karakter.',
        'noHp.max' => 'No HP maksimal 13 karakter.',
        'foto.required' => 'Foto harus diisi.',
        'foto.image' => 'Foto harus berupa gambar.',
        'foto.mimes' => 'Foto harus berupa jpg, jpeg, atau png.',
        'foto.max' => 'Foto maksimal 2MB.',
        'namaAyah.required' => 'Nama ayah harus diisi.',
        'namaIbu.required' => 'Nama ibu harus diisi.',
        'namaWali.max' => 'Nama wali maksimal 255 karakter.',
        'alamat.required' => 'Alamat harus diisi.',
    ];
}
