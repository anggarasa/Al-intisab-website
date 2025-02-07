<?php

namespace App\Livewire\Pages\Master\Kurikulum;

use App\Models\Kurikulum\Kurikulum;
use Livewire\Component;

class ModalManajemenKurikulum extends Component
{
    public $kurikulum;

    public $isEdit = false, $kurikulumId;

    // tambah kurikulum
    public function tambahKurikulum()
    {
        try {
            $this->validate([
                'kurikulum' => ['required', 'string', 'max:255'],
            ]);

            // Simpan kurikulum
            Kurikulum::create(['nama_kurikulum' => $this->kurikulum]);

            // menampilkan data real-time
            $this->dispatch('manajemen-kurikulum')->to(ManajemenKurikulum::class);

            // reset input
            $this->resetInput();

            // kirim notifikasi success
            $this->dispatch('notificationMaster', [
                'type' => 'success',
                'message' => 'Berhasil menambahkan kurikulum baru',
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
    
    public function render()
    {
        return view('livewire.pages.master.kurikulum.modal-manajemen-kurikulum');
    }

    // reset input
    public function resetInput()
    {
        $this->reset(['kurikulum', 'kurikulumId']);
        $this->isEdit = false;

        $this->dispatch('close-modal-crud-kurikulum');
    }

    // custom messages
    protected $messages = [
        'kurikulum.required' => 'Nama kurikulum harus diisi.',
        'kurikulum.string' => 'Nama kurikulum harus berupa teks.',
        'kurikulum.max' => 'Nama kurikulum tidak boleh lebih dari 255 karakter.',
    ];
}
