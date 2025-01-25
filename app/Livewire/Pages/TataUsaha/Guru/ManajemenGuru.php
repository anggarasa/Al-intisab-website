<?php

namespace App\Livewire\Pages\Tatausaha\Guru;

use Livewire\Component;
use App\Models\Guru\Guru;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

#[Layout('layouts.tatausaha-layout',['title'=>'manajemen Guru'])]
#[On('manajemen-guru')]
class ManajemenGuru extends Component
{

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
        $gurus = Guru::with(['user', 'kelamin', 'ptk', 'agama'])->latest()->get();
        
        return view('livewire.pages.tata-usaha.guru.manajemen-guru', compact('gurus'));
    }
}
