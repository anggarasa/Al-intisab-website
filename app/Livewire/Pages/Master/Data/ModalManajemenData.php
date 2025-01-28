<?php

namespace App\Livewire\Pages\Master\Data;

use App\Models\Agama;
use App\Models\Guru\JenisPtk;
use App\Models\JenisKelamin;
use App\Models\Jurusan;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ModalManajemenData extends Component
{
    public $gender, $genderId;

    public $agama, $agamaId;

    public $ptk, $ptkKet, $ptkId;

    public $jurusan, $jurusanId;

    public $isEdit = false, $deleteName, $deleteType;

    // tambah gender
    public function tambahGender()
    {
        try {
            $this->Validate([
                'gender' => 'required|string|max:255',
            ]);

            // Simpan Gender
            JenisKelamin::create(['kelamin' => $this->gender]);

            // Menampilkan data real-time
            $this->dispatch('manajemen-data')->to(ManajemenData::class);

            // Reset input
            $this->resetInput();

            // Kirim notifikasi success
            $this->dispatch('notificationMaster', [
                'type' => 'success',
                'message' => 'Berhasil menambahkan data jenis kelamin',
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

    // Update gender
    #[On('editGender')]
    public function editGender($id)
    {
        $this->isEdit = true;
        $gender = JenisKelamin::find($id);
        $this->genderId = $gender->id;
        $this->gender = $gender->kelamin;

        // Open modal edit gender
        $this->dispatch('modal-crud-gender');
    }

    public function updateGender()
    {
        try {
            $this->validate([
                'gender' => 'required|string|max:255',
            ]);

            $gender = JenisKelamin::find($this->genderId);
            // Update Gender
            $gender->update(['kelamin' => $this->gender]);

            // Menampilkan data secara real-time
            $this->dispatch('manajemen-data')->to(ManajemenData::class);

            // Reset input
            $this->resetInput();

            // Kirim notifikasi success
            $this->dispatch('notificationMaster', [
                'type' => 'success',
                'message' => 'Berhasil mengubah data jenis kelamin',
                'title' => 'Berhasil!',
            ]);
        } catch (\Exception $e) {
            // Kirim notifikasi error
            $this->dispatch('notificationMaster', [
                'type' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal!',
            ]);
        }
    }
    // End Update gender

    // Tambah Agama
    public function tambahAgama()
    {
        try {
            $this->validate(['agama' => 'required|string|max:255']);

            // Simpan Agama
            Agama::create(['agama' => $this->agama]);

            // Menampilkan data real-time
            $this->dispatch('manajemen-data')->to(ManajemenData::class);

            // Reset input
            $this->resetInput();

            // Kirim notification success
            $this->dispatch('notificationMaster', [
                'type' => 'success',
                'message' => 'Berhasil menambah data agama',
                'title' => 'Berhasil!',
            ]);
        } catch (\Exception $e) {
            // Kirim notifikasi error
            $this->dispatch('notificationMaster', [
                'type' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal!',
            ]);
        }
    }
    // End Tambah Agama

    // Update agama
    #[On('editAgama')]
    public function editAgama($id)
    {
        $this->isEdit = true;
        $agama = Agama::find($id);
        $this->agamaId = $agama->id;
        $this->agama = $agama->agama;

        // Open modal edit agama
        $this->dispatch('modal-crud-agama');
    }

    public function updateAgama()
    {
        try {
            $this->validate(['agama' => 'required|string|max:255']);

            $agama = Agama::find($this->agamaId);
            // update agama
            $agama->update(['agama' => $this->agama]);

            // menampilkan data real-time
            $this->dispatch('manajemen-data')->to(ManajemenData::class);

            // Reset Input
            $this->resetInput();

            // Kirim notifikasi success
            $this->dispatch('notificationMaster', [
                'type' => 'success',
                'message' => 'Berhasil mengubah data agama.',
                'title' => 'Berhasil!',
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
    // End Update agama

    // Tambah Ptk
    public function tambahPtk()
    {
        try {
            $this->validate([
                'ptk' => 'required|string|max:255',
                'ptkKet' => 'nullable|string',
            ]);

            // Simpan Ptk
            JenisPtk::create([
                'jenis_ptk' => $this->ptk,
                'keterangan' => $this->ptkKet,
            ]);

            // Menampilkan data real-time
            $this->dispatch('manajemen-data')->to(ManajemenData::class);

            // reset input
            $this->resetInput();

            // kirim notifikasi success
            $this->dispatch('notificationMaster', [
                'type' => 'success',
                'message' => 'Berhasil menambahkan data PTK.',
                'title' => 'Berhasil!',
            ]);
        } catch (\Exception $e) {
            // Kirim notifikasi error
            $this->dispatch('notificationMaster', [
                'type' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal!',
            ]);
        }
    }
    // End Tambah Ptk

    // Update Ptk
    #[On('editPtk')]
    public function editPtk($id)
    {
        $this->isEdit = true;
        $ptk = JenisPtk::find($id);
        $this->ptkId = $ptk->id;
        $this->ptk = $ptk->jenis_ptk;
        $this->ptkKet = $ptk->keterangan;

        // open modal ptk
        $this->dispatch('modal-crud-ptk');
    }

    public function updatePtk()
    {
        try {
            $this->validate([
                'ptk' => 'required|string|max:255',
                'ptkKet' => 'nullable|string'
            ]);

            $ptk = JenisPtk::find($this->ptkId);
            // update ptk
            $ptk->update([
                'jenis_ptk' => $this->ptk,
                'keterangan' => $this->ptkKet,
            ]);

            // menapilkan data real-time
            $this->dispatch('manajemen-data')->to(ManajemenData::class);

            // Reset Input
            $this->resetInput();

            // kirim notifikasi success
            $this->dispatch('notificationMaster', [
                'type' => 'success',
                'message' => ' Jenis PTK berhasil diupdate!',
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
    // End Update Ptk

    // Tambah Jurusan
    public function tambahJurusan()
    {
        try {
            $this->validate(['jurusan' => 'required|string|max:255',]);

            // Simpan jurusan
            Jurusan::create(['nama_jurusan' => $this->jurusan]);

            // menampilkan data real-time
            $this->dispatch('manajemen-data')->to(ManajemenData::class);

            // Reset input
            $this->resetInput();

            // kirim notifikasi success
            $this->dispatch('notificationMaster', [
                'type' => 'success',
                'message' => 'Berhasil menambahkan jurusan!',
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
    // End Tambah Jurusan

    // Update jurusan
    #[On('editJurusan')]
    public function editJurusan($id)
    {
        $this->isEdit = true;
        $jurusan = Jurusan::find($id);
        $this->jurusanId = $jurusan->id;
        $this->jurusan = $jurusan->nama_jurusan;

        // open Modal jurusan
        $this->dispatch('modal-crud-jurusan');
    }

    public function updateJurusan()
    {
        try {
            $this->validate(['jurusan' => 'required|string|max:255',]);
            
            $jurusan = Jurusan::find($this->jurusanId);

            $jurusan->update(['nama_jurusan' => $this->jurusan]);

            // menampilkan data real-time
            $this->dispatch('manajemen-data')->to(ManajemenData::class);

            // Reset input
            $this->resetInput();

            // kirim notifikasi success
            $this->dispatch('notificationMaster', [
                'type' => 'success',
                'message' => 'Berhasil mengubah jurusan!',
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
    // End Update jurusan

    // Delete Data
    #[On('hapusData')]
    public function hapusData($id, $deleteType)
    {
        $this->deleteType = $deleteType;
        if ($deleteType === "gender") {
            $gender = JenisKelamin::find($id);
            $this->genderId = $gender->id;
            $this->deleteName = $gender->kelamin;
        } elseif ($deleteType === "agama") {
            $agama = Agama::find($id);
            $this->agamaId = $agama->id;
            $this->deleteName = $agama->agama;
        } elseif ($deleteType === "ptk") {
            $ptk = JenisPtk::find($id);
            $this->ptkId = $ptk->id;
            $this->deleteName = $ptk->jenis_ptk;
        } elseif ($deleteType === "jurusan") {
            $jurusan = Jurusan::find($id);
            $this->jurusanId = $jurusan->id;
            $this->deleteName = $jurusan->nama_jurusan;
        }

        // Open modal delete
        $this->dispatch('modal-delete-data');
    }

    public function deleteData()
    {
        try {
            if ($this->deleteType === "gender") {
                $gender = JenisKelamin::find($this->genderId);
                $gender->delete();
            } elseif ($this->deleteType === "agama") {
                $agama = Agama::find($this->agamaId);
                $agama->delete();
            } elseif ($this->deleteType === "ptk") {
                $ptk = JenisPtk::find($this->ptkId);
                $ptk->delete();
            } elseif ($this->deleteType === "jurusan") {
                $jurusan = Jurusan::find($this->jurusanId);
                $jurusan->delete();
            }

            // menampilkan data real-time
            $this->dispatch('manajemen-data')->to(ManajemenData::class);

            // Kirim notifikasi success
            $this->dispatch('notificationMaster', [
                'type' => 'success',
                'message' => 'Berhail menghapus data '. $this->deleteType,
                'title' => 'Berhasil!'
            ]);

            // Reset Input
            $this->resetInput();
        } catch (\Exception $e) {
            // Kirim notifikasi error
            $this->dispatch('notificationMaster', [
                'type' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal!',
            ]);
        }
    }
    // End Delete Data
    
    public function render()
    {
        return view('livewire.pages.master.data.modal-manajemen-data');
    }

    // Reset Input
    public function resetInput()
    {
        $this->reset(['gender', 'genderId', 'agama', 'agamaId', 'ptk', 'ptkKet', 'ptkId', 'jurusan', 'jurusanId', 'deleteName', 'deleteType']);
        $this->isEdit = false;

        // Close Modal gender
        $this->dispatch('close-modal-crud-gender');

        // Close modal agama
        $this->dispatch('close-modal-crud-agama');

        // Close modal ptk
        $this->dispatch('close-modal-crud-ptk');

        // close modal jurusan
        $this->dispatch('close-modal-crud-jurusan');

        // Colse modal delete data
        $this->dispatch('close-modal-delete-data');
    }

    // Message custom
    protected $messages = [
        'gemder.required' => 'Jenis Kelamin tidak boleh kosong',
        'agama.required' => 'Agama tidak boleh kosong',
        'ptk.required' => 'Jenis PTK tidak boleh kosong',
        'jurusan.required' => 'Jenis PTK tidak boleh kosong',
    ];
}
