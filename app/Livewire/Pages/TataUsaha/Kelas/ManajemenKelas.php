<?php

namespace App\Livewire\Pages\TataUsaha\Kelas;

use App\Models\Kelas;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.tatausaha-layout', ['title' => 'Manajemen Kelas'])]
#[On('management-kelas')]
class ManajemenKelas extends Component
{

    // Delete Kelas
    public function deleteKelas($id)
    {
        try {
            $kelas = Kelas::findOrFail($id);

            $kelas->delete();

            // close modal delete
            $this->dispatch('close-modal-delete-kelas');

            // Kirim Notification Success
            $this->dispatch('notificationTataUsaha', [
                'type' => 'success',
                'message' => 'Berhasil menghapus kelas',
                'title' => 'Sukses',
            ]);
        } catch (\Exception $e) {
            // Kirim Notification Error
            $this->dispatch('notificationTataUsaha', [
                'type' => 'error',
                'message' => 'Gagal menghapus kelas',
                'title' => 'Gagal',
            ]); 
        }
    }
    // End Delete Kelas
    public function render()
    {
        return view('livewire.pages.tata-usaha.kelas.manajemen-kelas', [
            'kelases' => Kelas::with('jurusan')->latest()->get()
        ]);
    }
}
