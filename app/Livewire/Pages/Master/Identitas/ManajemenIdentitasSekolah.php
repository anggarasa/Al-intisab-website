<?php

namespace App\Livewire\Pages\Master\Identitas;

use App\Livewire\Layout\Master\Sidebar;
use App\Models\IdentitasSekolah;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.master-layout', ['title' => 'Manajemen Identitas Sekolah'])]
#[On('manajemen-identitas-sekolah')]
class ManajemenIdentitasSekolah extends Component
{
    use WithFileUploads;
    
    public $identitasId, $isEdit = false, $logoOld;
    public $name, $logo, $npsn, $alamat, $kelurahan, $kecamatan, $kota, $provinsi, $pos, $hp, $email, $akreditasi, $kepsek;

    public function buatIdentitas()
    {
        try {
            $this->validate([
                'name' => ['required', 'string', 'max:255'],
                'logo' => ['required', 'image', 'mimes:png,jpg,jpeg,svg', 'max:2024'],
                'npsn' => ['required', 'string', 'max:255'],
                'alamat' => ['required'],
                'kelurahan' => ['required', 'string', 'max:255'],
                'kecamatan' => ['required', 'string', 'max:255'],
                'kota' => ['required', 'string', 'max:255'],
                'provinsi' => ['required', 'string', 'max:255'],
                'pos' => ['required', 'string', 'max:255'],
                'hp' => ['required', 'min:10', 'max:15'],
                'email' => ['required', 'email'],
                'akreditasi' => ['required'],
                'kepsek' => ['required', 'string', 'max:255'],
            ]);

            $namaFoto = time() . '.' . $this->logo->getClientOriginalExtension();
            $logoURL = $this->logo->storeAs('logo', $namaFoto, 'public');

            IdentitasSekolah::create([
                'nama_sekolah' => $this->name,
                'logo' => $logoURL,
                'npsn' => $this->npsn,
                'alamat_sekolah' => $this->alamat,
                'kelurahan' => $this->kelurahan,
                'kecamatan' => $this->kecamatan,
                'kabupaten_kota' => $this->kota,
                'provinsi' => $this->provinsi,
                'kode_pos' => $this->pos,
                'no_telpone' => $this->hp,
                'email' => $this->email,
                'akreditasi' => $this->akreditasi,
                'kepala_sekolah' => $this->kepsek,
            ]);

            $this->dispatch('update-logo');

            // kirim notification success
            $this->dispatch('notificationMaster', [
                'type' => 'success',
                'message' => 'Berhasil membuat identitas sekolah',
                'title' => 'Berhasil'
            ]);

            $this->resetInput();
        } catch (\Exception $e) {
            $this->dispatch('notificationMaster', [
                'type' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal'
            ]);
        }
    }
    
    // update identitas sekolah
    public function editIdentitas($identitasId)
    {
        $this->isEdit = true;
        $identitas = IdentitasSekolah::find($identitasId);
        $this->identitasId = $identitas->id;
        $this->name = $identitas->nama_sekolah;
        $this->logoOld = $identitas->logo; // Simpan nama file logo lama
        $this->npsn = $identitas->npsn;
        $this->alamat = $identitas->alamat_sekolah;
        $this->kelurahan = $identitas->kelurahan;
        $this->kecamatan = $identitas->kecamatan;
        $this->kota = $identitas->kabupaten_kota;
        $this->provinsi = $identitas->provinsi;
        $this->pos = $identitas->kode_pos;
        $this->hp = $identitas->no_telpone;
        $this->email = $identitas->email;
        $this->akreditasi = $identitas->akreditasi;
        $this->kepsek = $identitas->kepala_sekolah;

        // Kirim event ke Alpine.js untuk menampilkan logo lama
        $this->dispatch('update-preview', asset('storage/' . $identitas->logo));
    }

    public function updateIdentitas()
    {
        try {
            $this->validate([
                'name' => ['required', 'string', 'max:255'],
                'logo' => ['nullable', 'image', 'mimes:png,jpg,jpeg,svg', 'max:2024'],
                'npsn' => ['required', 'string', 'max:255'],
                'alamat' => ['required'],
                'kelurahan' => ['required', 'string', 'max:255'],
                'kecamatan' => ['required', 'string', 'max:255'],
                'kota' => ['required', 'string', 'max:255'],
                'provinsi' => ['required', 'string', 'max:255'],
                'pos' => ['required', 'max:255'],
                'hp' => ['required', 'min:10', 'max:15'],
                'email' => ['required', 'email'],
                'akreditasi' => ['required'],
                'kepsek' => ['required', 'string', 'max:255'],
            ]);
            
            // update identitas sekolah
            $identitas = IdentitasSekolah::find($this->identitasId);

            if ($this->logo) {
                if (Storage::disk('public')->exists($identitas->logo)) {
                    // Hapus logo lama
                    Storage::disk('public')->delete($identitas->logo);
                }
                $namaFoto = time() . '.' . $this->logo->getClientOriginalExtension();
                $logoURL = $this->logo->storeAs('logo', $namaFoto, 'public');
            } else {
                $logoURL = $this->logoOld;
            }
            
            $identitas->update([
                'nama_sekolah' => $this->name,
                'logo' => $logoURL, // Simpan nama file logo baru
                'npsn' => $this->npsn,
                'alamat_sekolah' => $this->alamat,
                'kelurahan' => $this->kelurahan,
                'kecamatan' => $this->kecamatan,
                'kabupaten_kota' => $this->kota,
                'provinsi' => $this->provinsi,
                'kode_pos' => $this->pos,
                'no_telpone' => $this->hp,
                'email' => $this->email,
                'akreditasi' => $this->akreditasi,
                'kepala_sekolah' => $this->kepsek,
            ]);

            $this->dispatch('update-logo');
            
            // kirim notifikasi success
            $this->dispatch('notificationMaster', [
                'type' => 'success',
                'message' => 'Berhasil mengubah identitas sekolah',
                'title' => 'Berhasil'
            ]);

            $this->resetInput();
        } catch (\Exception $e) {
            // kirim notifikasi error
            $this->dispatch('notificationMaster', [
                'type' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal'
            ]);
        }
    }

    // delete identitas
    public function hapusIdentitas($identitasId)
    {
        $identitas = IdentitasSekolah::find($identitasId);
        $this->identitasId = $identitas->id;
        $this->name = $identitas->nama_sekolah;

        $this->dispatch('modal-delete-identitas');
    }
    
    public function deleteIdentitas()
    {
        $identitas = IdentitasSekolah::find($this->identitasId);

        // hapus logo 
        if ($identitas->logo && Storage::disk('public')->exists($identitas->logo)) {
            Storage::disk('public')->delete($identitas->logo);
        }

        $identitas->delete();

        $this->dispatch('update-logo');

        $this->dispatch('notificationMaster', [
            'type' => 'success',
            'message' => 'Berhasil menghapus identitas sekolah',
            'title' => 'Berhasil'
        ]);

        $this->resetInput();
    }
    
    public function render()
    {
        $identitasSekolahs = IdentitasSekolah::latest()->get();
        
        return view('livewire.pages.master.identitas.manajemen-identitas-sekolah', compact('identitasSekolahs'));
    }

    // reset input
    public function resetInput()
    {
        $this->reset();
        
        // Kirim event untuk menghapus preview di Alpine.js
        $this->dispatch('update-preview', null);
        $this->dispatch('close-modal-delete-identitas');
    }

    // custom message
    protected $messages = [
        'name.required' => 'Nama sekolah harus diisi.',
        'name.string' => 'Nama sekolah harus berupa teks.',
        'name.max' => 'Nama sekolah tidak boleh lebih dari 255 karakter.',
        'logo.required' => 'Logo sekolah harus diisi.',
        'logo.image' => 'Logo sekolah harus berupa gambar.',
        'logo.mimes' => 'Logo sekolah hanya dapat berupa file PNG, JPG, atau JPEG.',
        'logo.max' => 'Logo sekolah tidak boleh lebih dari 2024 kilobyte.',
        'npsn.required' => 'NPSN sekolah harus diisi.',
        'npsn.string' => 'NPSN sekolah harus berupa teks.',
        'npsn.max' => 'NPSN sekolah tidak boleh lebih dari 255 karakter.',
        'alamat.required' => 'Alamat sekolah harus diisi.',
        'kelurahan.required' => 'Kelurahan sekolah harus diisi.',
        'kelurahan.string' => 'Kelurahan sekolah harus berupa teks.',
        'kelurahan.max' => 'Kelurahan sekolah tidak boleh lebih dari 255 karakter.',
        'kecamatan.required' => 'Kecamatan sekolah harus diisi.',
        'kecamatan.string' => 'Kecamatan sekolah harus berupa teks.',
        'kecamatan.max' => 'Kecamatan sekolah tidak boleh lebih dari 255 karakter.',
        'kota.required' => 'Kota sekolah harus diisi.',
        'kota.string' => 'Kota sekolah harus berupa teks.',
        'kota.max' => 'Kota sekolah tidak boleh lebih dari 255 karakter.',
        'provinsi.required' => 'Provinsi sekolah harus diisi.',
        'provinsi.string' => 'Provinsi sekolah harus berupa teks.',
        'provinsi.max' => 'Provinsi sekolah tidak boleh lebih dari 255 karakter.',
        'pos.required' => 'Kode pos sekolah harus diisi.',
        'pos.string' => 'Kode pos sekolah harus berupa teks.',
        'pos.max' => 'Kode pos sekolah tidak boleh lebih dari 255 karakter.',
        'hp.required' => 'Nomor telepon sekolah harus diisi.',
        'hp.min' => 'Nomor telepon sekolah harus minimal 10 karakter.',
        'hp.max' => 'Nomor telepon sekolah tidak boleh lebih dari 15 karakter.',
        'email.required' => 'Email sekolah harus diisi.',
        'email.email' => 'Email sekolah harus berupa alamat email yang valid.',
        'akreditasi.required' => 'Akreditasi sekolah harus diisi.',
        'kepsek.required' => 'Kepala sekolah harus diisi.',
        'kepsek.string' => 'Kepala sekolah harus berupa teks.',
        'kepsek.max' => 'Kepala sekolah tidak boleh lebih dari 255 karakter.',
    ];
}
