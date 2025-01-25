<?php

namespace App\Livewire\Pages\Tatausaha\Guru;

use App\Livewire\Pages\TataUsaha\Guru\ModalManajemenGuru;
use Livewire\Component;
use App\Models\Guru\Guru;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\WithPagination;

#[Layout('layouts.tatausaha-layout',['title'=>'manajemen Guru'])]
#[On('manajemen-guru')]
class ManajemenGuru extends Component
{
    use WithPagination;
    
    // Edit Guru
    public function editGuru($id)
    {
        $this->dispatch('editGuru', $id)->to(ModalManajemenGuru::class);
    }
    // End Edit Guru

    // Hapus Guru
    public function hapusGuru($id)
    {
        $this->dispatch('hapusGuru', $id)->to(ModalManajemenGuru::class);
    }
    // End Hapus Guru

    // Update Status Kepegawaian Guru
    public function updateStatusGuru($id, $status)
    {
        try {
            $guru = Guru::find($id);

            $guru->update(['status_kepegawaian' => $status]);

            // Kirim notifikasi success
            $this->dispatch('notificationTataUsaha', [
                'type' => 'success',
                'message' => 'Status kepegawaian berhasil diubah',
                'title' => 'Berhasil!',
            ]);
        } catch (\Exception $e) {
            // Kirim notifikasi error
            $this->dispatch('notificationTataUsaha', [
                'type' => 'error',
                'message' => 'Gagal mengubah status kepegawaian',
                'title' => 'Gagal!',
            ]);
        }
    }
    // End Update Status Kepegawaian Guru
    
    public function render()
    {
        $gurus = Guru::with(['user', 'kelamin', 'ptk', 'agama'])->latest()->paginate(5);
        $guruL = Guru::whereHas('kelamin', function ($query) {
            $query->where('kelamin', 'laki-laki');
        })->count();
        $guruP = Guru::whereHas('kelamin', function ($query) {
            $query->where('kelamin', 'perempuan');
        })->count();
        
        return view('livewire.pages.tata-usaha.guru.manajemen-guru', compact(['gurus', 'guruL', 'guruP']));
    }
}
