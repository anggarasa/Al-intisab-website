<?php

namespace App\Livewire\Pages\TataUsaha\Kelas;

use App\Models\Kelas;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Symfony\Component\CssSelector\Node\FunctionNode;

#[Layout('layouts.tatausaha-layout', ['title' => 'Manajemen Kelas'])]
#[On('management-kelas')]
class ManajemenKelas extends Component
{
    // Edit kelas
    public function editKelas($id)
    {
        $this->dispatch('editKelas', $id)->to(ModalManajemenKelas::class);
    }
    // End edit kelas

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

    // Update status kelas
    public function updateStatusKelas($id, $status)
    {
        try {
            $kelas = Kelas::find($id);
            $kelas->update([
                'status' => $status
            ]);

            $this->dispatch('notificationTataUsaha', [
                'type' => 'success',
                'message' => 'Status kelas berhasil diubah!',
                'title' => 'Sukses',
            ]);
        } catch (\Exception $e) {
            $this->dispatch('notificationTataUsaha', [
                'type' => 'error',
                'message' => 'Status kelas gagal diubah!',
                'title' => 'Gagal',
            ]);
        }
    }
    // End update status kelas
    
    public function render()
    {
        return view('livewire.pages.tata-usaha.kelas.manajemen-kelas', [
            'kelases' => Kelas::with('jurusan')->latest()->get()
        ]);
    }
}
