<?php

namespace App\Livewire\Pages\Master\Identitas;

use App\Models\IdentitasSekolah;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalManajemenIdentitasSekolah extends Component
{
    public $name, $kepala_sekolah, $email, $noHp, $npsn, $kelurahan, $kecamatan, $kota, $provinsi, $pos, $akreditasi, $alamat;
    
    public $isEdit = false, $identitasId;
    
    // buat identitas sekolah
    public function buatIdentitas()
    {
        try {
            $this->validate([
                'name' => ['required', 'string', 'max:255'],
                'kepala_sekolah' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255'],
                'noHp' => ['required', 'string', 'min:10', 'max:15'],
                'npsn' => ['required', 'string', 'max:20'],
                'kelurahan' => ['required', 'string', 'max:255'],
                'kecamatan' => ['required', 'string', 'max:255'],
                'kota' => ['required', 'string', 'max:255'],
                'provinsi' => ['required', 'string', 'max:255'],
                'pos' => ['required', 'string', 'max:6'],
                'alamat' => ['required', 'string', 'max:255'],
                'akreditasi' => ['required', 'string', 'max:255'],
            ]);

            IdentitasSekolah::create([
                'nama_sekolah' => $this->name,
                'npsn' => $this->npsn,
                'alamat_sekolah' => $this->alamat,
                'kepala_sekolah' => $this->kepala_sekolah,
                'email' => $this->email,
                'no_telpone' => $this->noHp,
                'kelurahan' => $this->kelurahan,
                'kecamatan' => $this->kecamatan,
                'kabupaten_kota' => $this->kota,
                'provinsi' => $this->provinsi,
                'kode_pos' => $this->pos,
                'akreditasi' => $this->akreditasi,
            ]);

            // menampilkan data secara real-time
            $this->dispatch('manajemen-identitas-sekolah')->to(ManajemenIdentitasSekolah::class);

            // reset
            $this->resetInput();

            // kirim notifikasi success
            $this->dispatch('notificationMaster', [
                'type' => 'success',
                'message' => 'Berhasil membuat identitas sekolah.',
                'title' => 'Berhasil'
            ]);
        } catch (\Exception $e) {
            // kirim notifikasi error
            $this->dispatch('notificationMaster', [
                'type' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal'
            ]);
        }
    }
    // End buat identitas sekolah

    // update identitas sekolah
    #[On('editIdentitas')]
    public function editIdentitas($id)
    {
        $this->isEdit = true;
        $identitas = IdentitasSekolah::find($id);
        $this->identitasId = $identitas->id;
        $this->name = $identitas->nama_sekolah;
        $this->npsn = $identitas->npsn;
        $this->alamat = $identitas->alamat_sekolah;
        $this->kepala_sekolah = $identitas->kepala_sekolah;
        $this->email = $identitas->email;
        $this->noHp = $identitas->no_telpone;
        $this->kelurahan = $identitas->kelurahan;
        $this->kecamatan = $identitas->kecamatan;
        $this->kota = $identitas->kabupaten_kota;
        $this->provinsi = $identitas->provinsi;
        $this->pos = $identitas->kode_pos;
        $this->akreditasi = $identitas->akreditasi;

        $this->dispatch('modal-crud-identitas');
    }
    
    public function updateIdentitasSekolah()
    {
        try {
            $this->validate([
                'name' => ['required', 'string', 'max:255'],
                'kepala_sekolah' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255'],
                'noHp' => ['required', 'string', 'min:10', 'max:15'],
                'npsn' => ['required', 'string', 'max:20'],
                'kelurahan' => ['required', 'string', 'max:255'],
                'kecamatan' => ['required', 'string', 'max:255'],
                'kota' => ['required', 'string', 'max:255'],
                'provinsi' => ['required', 'string', 'max:255'],
                'pos' => ['required', 'string', 'max:6'],
                'alamat' => ['required', 'string', 'max:255'],
                'akreditasi' => ['required', 'string', 'max:255'],
            ]);

            $identitas = IdentitasSekolah::find($this->identitasId);

            $identitas->update([
                'nama_sekolah' => $this->name,
                'npsn' => $this->npsn,
                'alamat_sekolah' => $this->alamat,
                'kepala_sekolah' => $this->kepala_sekolah,
                'email' => $this->email,
                'no_telpone' => $this->noHp,
                'kelurahan' => $this->kelurahan,
                'kecamatan' => $this->kecamatan,
                'kabupaten_kota' => $this->kota,
                'provinsi' => $this->provinsi,
                'kode_pos' => $this->pos,
                'akreditasi' => $this->akreditasi,
            ]);

            // menampilkan data secara real-time
            $this->dispatch('manajemen-identitas-sekolah')->to(ManajemenIdentitasSekolah::class);

            // reset input
            $this->resetInput();

            // kirim notifikasi success
            $this->dispatch('notificationMaster', [
                'type' => 'success',
                'message' => 'Data identitas sekolah berhasil diupdate',
                'title' => 'Berhasil'
            ]);
        } catch (\Exception $e) {
            // kirim notifikasi error
            $this->dispatch('notificationMaster', [
                'type' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal'
            ]);
        }
    }
    // End update identitas sekolah

    // Delete Identitas Sekolah
    #[On('hapusIdentitas')]
    public function hapusIdentitas($id)
    {
        $this->identitasId = $id;

        $this->dispatch('modal-delete-identitas');
    }

    public function deleteIdentitas()
    {
        $identitas = IdentitasSekolah::find($this->identitasId);

        $identitas->delete();

        $this->dispatch('manajemen-identitas-sekolah')->to(ManajemenIdentitasSekolah::class);

        $this->resetInput();
        
        $this->dispatch('notificationMaster', [
            'type' => 'success',
            'message' => 'Berhasil menghapus identitas sekolah',
            'title' => 'Berhasil',
        ]);
    }
    // End Delete Identitas Sekolah
    
    public function render()
    {
        return view('livewire.pages.master.identitas.modal-manajemen-identitas-sekolah');
    }

    // reset input
    public function resetInput()
    {
        $this->reset(['name', 'kepala_sekolah', 'email', 'noHp', 'npsn', 'kelurahan', 'kecamatan', 'kota', 'provinsi', 'pos', 'akreditasi', 'alamat', 'identitasId']);

        $this->isEdit = false;

        $this->dispatch('close-modal-crud-identitas');
        $this->dispatch('close-modal-delete-identitas');
    }

    // custom message
    protected $messages = [
        'name.required' => 'Nama sekolah harus diisi.',
        'name.string' => 'Nama sekolah harus berupa teks.',
        'name.max' => 'Nama sekolah tidak boleh lebih dari 255 karakter.',
        'kepala_sekolah.required' => 'Kepala sekolah harus diisi.',
        'kepala_sekolah.string' => 'Kepala sekolah harus berupa teks.',
        'kepala_sekolah.max' => 'Kepala sekolah tidak boleh lebih dari 255 karakter.',
        'email.required' => 'Email harus diisi.',
        'email.email' => 'Email harus berupa alamat email yang valid.',
        'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
        'noHp.required' => 'Nomor HP harus diisi.',
        'noHp.string' => 'Nomor HP harus berupa teks.',
        'noHp.min' => 'Nomor HP harus minimal 10 karakter.',
        'noHp.max' => 'Nomor HP tidak boleh lebih dari 13 karakter.',
        'npsn.required' => 'NPSN harus diisi.',
        'npsn.integer' => 'NPSN harus berupa angka.',
        'npsn.max' => 'NPSN tidak boleh lebih dari 10 karakter.',
        'kelurahan.required' => 'Kelurahan harus diisi.',
        'kelurahan.string' => 'Kelurahan harus berupa teks.',
        'kelurahan.max' => 'Kelurahan tidak boleh lebih dari 255 karakter.',
        'kecamatan.required' => 'Kecamatan harus diisi.',
        'kecamatan.string' => 'Kecamatan harus berupa teks.',
        'kecamatan.max' => 'Kecamatan tidak boleh lebih dari 255 karakter.',
        'kota.required' => 'Kota harus diisi.',
        'kota.string' => 'Kota harus berupa teks.',
        'kota.max' => 'Kota tidak boleh lebih dari 255 karakter.',
        'provinsi.required' => 'Provinsi harus diisi.',
        'provinsi.string' => 'Provinsi harus berupa teks.',
        'provinsi.max' => 'Provinsi tidak boleh lebih dari 255 karakter.',
        'pos.required' => 'Kode pos harus diisi.',
        'pos.integer' => 'Kode pos harus berupa angka.',
        'pos.max' => 'Kode pos tidak boleh lebih dari 255 karakter.',
        'akreditasi.required' => 'Akreditasi harus diisi.',
        'akreditasi.string' => 'Akreditasi harus berupa teks.',
        'akreditasi.max' => 'Akreditasi tidak boleh lebih dari 255 karakter.',
        'alamat.required' => 'Alamat harus diisi.',
        'alamat.string' => 'Alamat harus berupa teks.',
        'alamat.max' => 'Alamat tidak boleh lebih dari 255 karakter.',
    ];
}
