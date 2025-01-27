<?php

namespace App\Livewire\Pages\Master\Data;

use App\Models\JenisKelamin;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ModalManajemenData extends Component
{
    public $gender, $genderId;

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
            // $this->dispatch('notificationMaster', [
            //     'type' => 'error',
            //     'message' => $e->getMessage(),
            //     'title' => 'Gagal!'
            // ]);
            dd($e->getMessage());
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

    // Delete Gender
    #[On('hapusGender')]
    public function hapusGender($id)
    {
        $this->deleteType = "gender";
        $gender = JenisKelamin::find($id);
        $this->genderId = $gender->id;
        $this->deleteName = $gender->kelamin;

        // Open modal delete
        $this->dispatch('modal-delete-data');
    }

    public function deleteData($deleteType)
    {
        try {
            if ($deleteType === "gender") {
                $gender = JenisKelamin::find($this->genderId);
                $gender->delete();
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
    // End Delete Gender
    
    public function render()
    {
        return view('livewire.pages.master.data.modal-manajemen-data');
    }

    // Reset Input
    public function resetInput()
    {
        $this->reset(['gender', 'genderId', 'deleteName', 'deleteType']);
        $this->isEdit = false;

        // Close Modal gender
        $this->dispatch('close-modal-crud-gender');

        // Colse modal delete data
        $this->dispatch('close-modal-delete-data');
    }

    // Message custom
    protected $messages = [
        'gemder.required' => 'Jenis Kelamin tidak boleh kosong',
    ];
}
