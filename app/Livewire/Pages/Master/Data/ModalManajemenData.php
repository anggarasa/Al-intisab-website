<?php

namespace App\Livewire\Pages\Master\Data;

use App\Models\Agama;
use App\Models\JenisKelamin;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ModalManajemenData extends Component
{
    public $gender, $genderId;

    public $agama, $agamaId;

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
            }

            // menampilkan data real-time
            $this->dispatch('manajemen-data')->to(ManajemenData::class);

            // Reset Input
            $this->resetInput();

            // Kirim notifikasi success
            $this->dispatch('notificationMaster', [
                'type' => 'success',
                'message' => 'Berhail menghapus Data Gender!',
                'title' => 'Berhasil!'
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
    // End Delete Data
    
    public function render()
    {
        return view('livewire.pages.master.data.modal-manajemen-data');
    }

    // Reset Input
    public function resetInput()
    {
        $this->reset(['gender', 'genderId', 'agama', 'agamaId', 'deleteName', 'deleteType']);
        $this->isEdit = false;

        // Close Modal gender
        $this->dispatch('close-modal-crud-gender');

        // Close modal agama
        $this->dispatch('close-modal-crud-agama');

        // Colse modal delete data
        $this->dispatch('close-modal-delete-data');
    }

    // Message custom
    protected $messages = [
        'gemder.required' => 'Jenis Kelamin tidak boleh kosong',
    ];
}
