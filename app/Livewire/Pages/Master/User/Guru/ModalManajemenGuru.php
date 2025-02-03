<?php

namespace App\Livewire\Pages\Master\User\Guru;

use App\Models\User;
use App\Models\Agama;
use Livewire\Component;
use App\Models\Guru\Guru;
use Livewire\Attributes\On;
use App\Models\JenisKelamin;
use App\Models\Guru\JenisPtk;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Livewire\Pages\Master\User\Guru\ManajemenGuru;

class ModalManajemenGuru extends Component
{
    use WithFileUploads;
    
    public $name, $email, $password, $password_confirmation, $gender, $ptk, $agama, $nip, $nik, $tempatLahir, $tanggalLahir, $alamat, $noHp, $foto;

    public $ptks, $genders, $agamas;
    
    public $guruId, $isEdit = false;

    public function mount()
    {
        $this->ptks = JenisPtk::all();
        $this->genders = JenisKelamin::all();
        $this->agamas = Agama::all();
    }

    // Tambah data Guru
    public function tambahGuru()
    {
        try{
            $validated = $this->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email:dns,rc,strict', 'unique:'. User::class],
                'password' => ['required', 'confirmed', 'min:6'],
                'gender' => ['required', 'integer'],
                'ptk' => ['required', 'integer'],
                'agama' => ['required', 'integer'],
                'nip' => ['required', 'string', 'max:255', 'unique:'. Guru::class],
                'nik' => ['required', 'string', 'max:255', 'unique:'. Guru::class],
                'tempatLahir' => ['required', 'string', 'max:255'],
                'tanggalLahir' => ['required', 'date'],
                'alamat' => ['required'],
                'noHp' => ['required', 'string', 'min:10', 'max:13', 'unique:gurus,no_hp'],
                'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2024'],
            ]);

             // Simpan data user email dan password
             $user = User::create([
                'email' => $validated['email'],
                'password' => Hash::make($validated['password'])
            ]);
            $user->assignRole('guru');
            
            // Simpan data foto ke storage jika ada
            $fotoUrl = null; // Inisialisasi fotoUrl
            if ($this->foto) {
                $namaFoto = time() . '.' . $this->foto->getClientOriginalExtension();
                $fotoUrl = $this->foto->storeAs('tata-usaha/guru/foto', $namaFoto, 'public');
            }

            // Simpan data guru
            Guru::create([
                'name' => $this->name,
                'nip' => $this->nip,
                'nik' => $this->nik,
                'jenis_kelamin_id' => $this->gender,
                'agama_id' => $this->agama,
                'jenis_ptk_id' => $this->ptk,
                'tempat_lahir' => $this->tempatLahir,
                'tanggal_lahir' => $this->tanggalLahir,
                'alamat' => $this->alamat,
                'no_hp' => $this->noHp,
                'foto' => $fotoUrl,
                'user_id' => $user->id,
            ]);

            // Menampilkan data real-time
            $this->dispatch('manajemen-guru')->to(ManajemenGuru::class);

            // Reset input
            $this->resetInput();

            // kirim notifikasi success
            $this->dispatch('notificationMaster', [
                'type' => 'success',
                'message' => 'Data Guru Berhasil Ditambahkan',
                'title' => 'Berhasil!',
            ]);
        } catch (\Exception $e) {
            // kirim notifikasi error
            $this->dispatch('notificationMaster', [
                'type' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal!',
            ]);
        }
    }
    // End Tambah data Guru

    // Update guru
    #[On('editGuru')]
    public function editGuru($id)
    {
        $this->isEdit = true;
        $guru = Guru::find($id);
        $this->guruId = $guru->id;
        $this->name = $guru->name;
        $this->email = $guru->user->email;
        $this->ptk = $guru->jenis_ptk_id;
        $this->gender = $guru->jenis_kelamin_id;
        $this->agama = $guru->agama_id;
        $this->nip = $guru->nip;
        $this->nik  = $guru->nik;
        $this->tempatLahir = $guru->tempat_lahir;
        $this->tanggalLahir = $guru->tanggal_lahir;
        $this->noHp = $guru->no_hp;
        $this->alamat = $guru->alamat;

        $imageUrls = $guru->foto ? asset('storage/' . $guru->foto) : null;

        $this->dispatch('setOldImages', [$imageUrls]);

        $this->dispatch('modal-curd-guru');
    }

    public function updateGuru()
    {
        try {
            $guru = Guru::find($this->guruId);
            
            $validated = $this->validate([
                'name' => 'required|string|max:255',
                'email' => [
                    'required',
                    'lowercase',
                    'email:dns,rfc,strict',
                    'max:255',
                    Rule::unique('users', 'email')->ignore($guru->user_id)
                ],
                'password' => 'nullable|string|confirmed|min:6',
                'gender' => 'required|integer',
                'ptk' => 'required|integer',
                'agama' => 'required|integer',
                'nip' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('gurus', 'nip')->ignore($guru->id)
                ],
                'tempatLahir' => 'required|string|max:255',
                'tanggalLahir' => 'required|date',
                'nik' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('gurus', 'nik')->ignore($guru->id)
                ],
                'noHp' => [
                    'required',
                    'string',
                    'min:9',
                    'max:13',
                    Rule::unique('gurus', 'no_hp')->ignore($guru->id)
                ],
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2024',
                'alamat' => 'required',
            ]);

            // Update data user email dan password
            $user = User::find($guru->user_id);
            $user->update([
                'email' => $validated['email'],
                'password' => $validated['password'] ? Hash::make($validated['password']) : $user->password,
            ]);

            // Tangani penghapusan foto lama jika ada foto baru
            $fotoUrl = $guru->foto;
            if ($this->foto) {
                // Hapus foto lama jika ada
                if ($fotoUrl && Storage::disk('public')->exists($fotoUrl)) {
                    Storage::disk('public')->delete($fotoUrl);
                }

                // Simpan foto baru
                $namaFoto = time() . '.' . $this->foto->getClientOriginalExtension();
                $fotoUrl = $this->foto->storeAs('tata-usaha/guru/foto', $namaFoto, 'public');
            }

            $guru->update([
                'name' => $this->name,
                'nip' => $this->nip,
                'nik' => $this->nik,
                'jenis_kelamin_id' => $this->gender,
                'agama_id' => $this->agama,
                'jenis_ptk_id' => $this->ptk,
                'tempat_lahir' => $this->tempatLahir,
                'tanggal_lahir' => $this->tanggalLahir,
                'alamat' => $this->alamat,
                'no_hp' => $this->noHp,
                'foto' => $fotoUrl,
            ]);

            // menampilkan data real-time
            $this->dispatch('manajemen-guru')->to(ManajemenGuru::class);

            // reset input
            $this->resetInput();

            // Kirim notifikasi success
            $this->dispatch('notificationMaster', [
                'type' => 'success',
                'message' => 'Berhasil memperbaharui data guru',
                'title' => 'Berhasil!'
            ]);
        } catch (\Exception $e) {
            // Kirim notifikasi error
            $this->dispatch('notificationMaster', [
                'type' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal!'
            ]);
        }
    }
    // End Update guru

    // Delete Guru
    #[On('hapusGuru')]
    public function hapusGuru($id)
    {
        $guru = Guru::find($id);
        $this->guruId = $guru->id;
        $this->name = $guru->name;
        
        $this->dispatch('modal-delete-siswa');
    }

    public function deleteGuru()
    {
        try {
            $guru = Guru::find($this->guruId);

            // Hapus gambar dari storage
            if($guru->foto && Storage::exists($guru->foto)) {
                Storage::delete($guru->foto);
            }
            
            // Delete data user guru
            $guru->user->delete();

            // Delete data guru
            $guru->delete();

            // Menampilkan data real-time
            $this->dispatch('manajemen-guru')->to(ManajemenGuru::class);

            // Reset Input
            $this->resetInput();

            // Kirim notifikasi success
            $this->dispatch('notificationMaster', [
                'type' => 'success',
                'message' => 'Data Guru Berhasil Dihapus',
                'title' => 'Berhasil!',
            ]);
        } catch (\Exception $e) {
            // Kirim notifikasi error
            $this->dispatch('notificationMaster', [
                'type' => 'error',
                'message' => 'Data Guru Gagal Dihapus',
                'title' => 'Gagal!',
            ]);
        }
    }
    // End Delete Guru
    
    public function render()
    {
        return view('livewire.pages.master.user.guru.modal-manajemen-guru');
    }

    // Reset Input
    public function resetInput()
    {
        $this->reset([
            'name',
            'email',
            'password',
            'password_confirmation',
            'nip',
            'nik',
            'gender',
            'agama',
            'ptk',
            'tempatLahir',
            'tanggalLahir',
            'alamat',
            'noHp',
            'foto',
            'guruId',
        ]);

        $this->isEdit = false;

        // reset upload foto
        $this->dispatch('resetFileUpload');

        // close Modal
        $this->dispatch('close-modal-crud-guru');
        $this->dispatch('close-modal-delete-siswa');
    }

    // Message custom
    protected $messages = [
        'name.required' => 'Nama wajib diisi.',
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Email harus berupa alamat email yang valid.',
        'email.unique' => 'Email sudah digunakan.',
        'password.required' => 'Password wajib diisi.',
        'password.confirmed' => 'Password tidak cocok.',
        'password.min' => 'Password minimal 6 karakter.',
        'gender.required' => 'Jenis kelamin wajib diisi.',
        'ptk.required' => 'Jenis PTK wajib diisi.',
        'agama.required' => 'Agama wajib diisi.',
        'nip.required' => 'NIP wajib diisi.',
        'nip.unique' => 'NIP sudah digunakan.',
        'nik.required' => 'NIK wajib diisi.',
        'nik.unique' => 'NIK sudah digunakan.',
        'tempatLahir.required' => 'Tempat lahir wajib diisi.',
        'tanggalLahir.required' => 'Tanggal lahir wajib diisi.',
        'tanggalLahir.date' => 'Tanggal lahir harus berupa tanggal yang valid.',
        'alamat.required' => 'Alamat wajib diisi.',
        'noHp.required' => 'No HP wajib diisi.',
        'noHp.min' => 'No HP minimal 10 karakter.',
        'noHp.max' => 'No HP maksimal 13 karakter.',
        'noHp.unique' => 'No HP sudah digunakan.',
        'foto.image' => 'Foto harus berupa gambar.',
        'foto.mimes' => 'Foto hanya dapat berupa file jpg, jpeg, atau png.',
        'foto.max' => 'Ukuran foto maksimal 2024 KB.',
    ];
}
