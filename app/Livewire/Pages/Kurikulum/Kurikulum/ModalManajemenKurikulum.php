<?php

namespace App\Livewire\Pages\Kurikulum\Kurikulum;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Kurikulum\Kurikulum;
use App\Livewire\Pages\Kurikulum\Kurikulum\ManajemenKurikulum;

class ModalManajemenKurikulum extends Component
{
    public $kurikulum, $deskripsi;

    public $isEdit = false, $kurikulumId;

    // tambah kurikulum
    public function tambahKurikulum()
    {
        try {
            $this->validate([
                'kurikulum' => ['required', 'string', 'max:255'],
                'deskripsi' => ['nullable', 'string'],
            ]);

            // Simpan kurikulum
            Kurikulum::create([
                'nama_kurikulum' => $this->kurikulum,
                'deskripsi' => $this->deskripsi,
            ]);

            // menampilkan data real-time
            $this->dispatch('manajemen-kurikulum')->to(ManajemenKurikulum::class);

            // reset input
            $this->resetInput();

            // kirim notifikasi success
            $this->dispatch('notificationKurikulum', [
                'type' => 'success',
                'message' => 'Berhasil menambahkan kurikulum baru',
                'title' => 'Berhasil!',
            ]);
        } catch (\Exception $e) {
            // kirim notifikasi error
            $this->dispatch('notificationKurikulum', [
                'type' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal!',
            ]);
        }
    }
    // End tambah kurikulum

    // update kurikulum
    #[On('editKurikulum')]
    public function editKurikulum($id)
    {
        $this->isEdit = true;
        $kurikulum = Kurikulum::find($id);
        $this->kurikulumId = $kurikulum->id;
        $this->deskripsi = $kurikulum->deskripsi;
        $this->kurikulum = $kurikulum->nama_kurikulum;

        $this->dispatch('modal-crud-kurikulum');
    }

    public function updateKurikulum()
    {
        try {
            $this->validate([
                'kurikulum' => ['required', 'string', 'max:255'],
                'deskripsi' => ['nullable', 'string'],
            ]);

            $kurikulum = Kurikulum::find($this->kurikulumId);

            $kurikulum->update([
                'nama_kurikulum' => $this->kurikulum,
                'deskripsi' => $this->deskripsi,
            ]);

            // menampilkan data real-time
            $this->dispatch('manajemen-kurikulum')->to(ManajemenKurikulum::class);

            // reset input
            $this->resetInput();

            // kirim notifikasi success
            $this->dispatch('notificationKurikulum', [
                'type' => 'success',
                'message' => 'Berhasil mengubah kurikulum',
                'title' => 'Berhasil!',
            ]);
        } catch (\Exception $e) {
            // kirim notifikasi error
            $this->dispatch('notificationKurikulum', [
                'type' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal',
            ]);
        }
    }
    // End update kurikulum

    // delete kurikulum
    #[On('hapusKurikulum')]
    public function hapusKurikulum($id)
    {
        $kurikulum = Kurikulum::find($id);
        $this->kurikulumId = $kurikulum->id;
        $this->kurikulum = $kurikulum->nama_kurikulum;

        $this->dispatch('modal-delete-kurikulum');
    }

    public function deleteKurikulum()
    {
        try {
            $kurikulum = Kurikulum::find($this->kurikulumId);
            $kurikulum->delete();
            
            // menampilkan data real-time
            $this->dispatch('manajemen-kurikulum')->to(ManajemenKurikulum::class);

            // reset input
            $this->resetInput();

            // kirim notifikasi success
            $this->dispatch('notificationKurikulum', [
                'type' => 'success',
                'message' => 'Berhasil menghapus kurikulum',
                'title' => 'Berhasil!',
            ]);
        } catch (\Exception $e) {
            // kirim notifikasi error
            $this->dispatch('notificationKurikulum', [
                'type' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal!',
            ]);
        }
    }
    // End delete kurikulum
    
    public function render()
    {
        return view('livewire.pages.kurikulum.kurikulum.modal-manajemen-kurikulum');
    }

    // reset input
    public function resetInput()
    {
        $this->reset(['kurikulum', 'deskripsi', 'kurikulumId']);
        $this->isEdit = false;

        $this->dispatch('close-modal-crud-kurikulum');
        $this->dispatch('close-modal-delete-kurikulum');
    }

    // custom messages
    protected $messages = [
        'kurikulum.required' => 'Nama kurikulum harus diisi.',
        'kurikulum.string' => 'Nama kurikulum harus berupa teks.',
        'kurikulum.max' => 'Nama kurikulum tidak boleh lebih dari 255 karakter.',
    ];
}
