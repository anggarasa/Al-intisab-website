<?php

namespace App\Livewire\Pages\Master\Data\Jurusan;

use App\Models\Jurusan;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalManajemenJurusan extends Component
{
    public $jurusan;
    public $jurusanId, $isEdit = false;

    public function tambahJurusan()
    {
        try {
            $this->validate(['jurusan' => ['required', 'string', 'max:255']]);

            Jurusan::create(['nama_jurusan' => $this->jurusan]);

            // menampilkan data real-time
            $this->dispatch('manajemen-jurusan')->to(ManajemenJurusan::class);

            // notifikasi success
            $this->dispatch('notificationMaster', [
                'type' => 'success',
                'message' => 'Berhasil menambahkan jurusan baru '. $this->jurusan . '.',
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

    // update jurusan
    #[On('editJurusan')]
    public function editJurusan($id)
    {
        $this->isEdit = true;
        $jurusan = Jurusan::find($id);
        $this->jurusanId = $id;
        $this->jurusan = $jurusan->nama_jurusan;

        $this->dispatch('modal-crud-jurusan');
    }

    public function updateJurusan()
    {
        try {
            $this->validate(['jurusan' => ['required', 'string', 'max:255']]);

            $jurusan = Jurusan::find($this->jurusanId);

            $jurusan->update(['nama_jurusan' => $this->jurusan]);

            // menampilkan data real-time
            $this->dispatch('manajemen-jurusan')->to(ManajemenJurusan::class);

            // notifikasi success
            $this->dispatch('notificationMaster', [
                'type' => 'success',
                'message' => 'Berhasil mengubah jurusan '. $this->jurusan . '.',
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
    // end update jurusan

    // delete jurusan
    #[On('hapusJurusan')]
    public function hapusJurusan($id)
    {
        $jurusan = Jurusan::find($id);
        $this->jurusanId = $jurusan->id;
        $this->jurusan = $jurusan->nama_jurusan;

        $this->dispatch('modal-delete-jurusan');
    }

    public function deleteJurusan()
    {
        $jurusan = Jurusan::find($this->jurusanId);
        $jurusan->delete();

        // menampilkan data real-time
        $this->dispatch('manajemen-jurusan')->to(ManajemenJurusan::class);

        // notifikasi success
        $this->dispatch('notificationMaster', [
            'type' => 'success',
            'message' => 'Berhasil menghapus jurusan '. $this->jurusan . '.',
            'title' => 'Berhasil'
        ]);

        // reset
        $this->resetInput();
    }
    // end delete jurusan
    
    public function render()
    {
        return view('livewire.pages.master.data.jurusan.modal-manajemen-jurusan');
    }

    // reset input
    public function resetInput()
    {
        $this->reset(['jurusan', 'jurusanId']);
        $this->isEdit = false;

        $this->dispatch('close-modal-crud-jurusan');
        $this->dispatch('close-modal-delete-jurusan');
    }

    // custom message
    protected $messages = [
        'jurusan.required' => 'Nama jurusan harus diisi.',
        'jurusan.string' => 'Nama jurusan harus berupa teks.',
        'jurusan.max' => 'Nama jurusan tidak boleh lebih dari 255 karakter.',
    ];
}
