<?php

namespace App\Livewire\Pages\Master\Data\Agama;

use App\Models\Agama;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalManajemenAgama extends Component
{
    public $agama;
    public $agamaId, $isEdit = false;

    public function tambahAgama()
    {
        try {
            $this->validate(['agama' => ['required', 'string', 'max:255']]);

            Agama::create(['agama' => $this->agama]);

            // menampilkan data real-time
            $this->dispatch('manajemen-agama')->to(ManajemenAgama::class);

            // notifikasi success
            $this->dispatch('notificationMaster', [
                'type' => 'success',
                'message' => 'Berhasil menambahkan agama baru '. $this->agama . '.',
                'title' => 'Berhasil'
            ]);

            // reset
            $this->resetInput();
        } catch (\Exception $e) {
            // notifikasi error
            $this->dispatch('notificationMaster', [
                'type' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal'
            ]);
        }
    }

    // update agama
    #[On('editAgama')]
    public function editAgama($id)
    {
        $this->isEdit = true;
        $agama = Agama::find($id);
        $this->agamaId = $agama->id;
        $this->agama = $agama->agama;

        $this->dispatch('modal-crud-agama');
    }

    public function updateAgama()
    {
        try {
            $this->validate(['agama' => ['required', 'string', 'max:255']]);

            $agama = Agama::find($this->agamaId);

            $agama->update(['agama' => $this->agama]);

             // menampilkan data real-time
             $this->dispatch('manajemen-agama')->to(ManajemenAgama::class);

             // notifikasi success
             $this->dispatch('notificationMaster', [
                 'type' => 'success',
                 'message' => 'Berhasil mengubah agama '. $this->agama . '.',
                 'title' => 'Berhasil'
             ]);
 
             // reset
             $this->resetInput();
         } catch (\Exception $e) {
             // notifikasi error
             $this->dispatch('notificationMaster', [
                 'type' => 'error',
                 'message' => $e->getMessage(),
                 'title' => 'Gagal'
             ]);
         }
    }
    // end update agama

    // delete agama
    #[On('hapusAgama')]
    public function hapusAgama($id)
    {
        $agama = Agama::find($id);
        $this->agamaId = $agama->id;
        $this->agama = $agama->agama;

        $this->dispatch('modal-delete-agama');
    }

    public function deleteAgama()
    {
        $agama = Agama::find($this->agamaId);

        $agama->delete();

         // menampilkan data real-time
         $this->dispatch('manajemen-agama')->to(ManajemenAgama::class);

         // notifikasi success
         $this->dispatch('notificationMaster', [
             'type' => 'success',
             'message' => 'Berhasil menghapus agama '. $this->agama . '.',
             'title' => 'Berhasil'
         ]);

         // reset
         $this->resetInput();
    }
    // end delete agama
    
    public function render()
    {
        return view('livewire.pages.master.data.agama.modal-manajemen-agama');
    }

    public function resetInput()
    {
        $this->reset(['agama', 'agamaId']);
        $this->isEdit = false;

        $this->dispatch('close-modal-crud-agama');
        $this->dispatch('close-modal-delete-agama');
    }

    protected $messages = [
        'agama.required' => 'Agama harus diisi.',
        'agama.string' => 'Agama harus berupa teks.',
        'agama.max' => 'Agama tidak boleh lebih dari 255 karakter.',
    ];
}
