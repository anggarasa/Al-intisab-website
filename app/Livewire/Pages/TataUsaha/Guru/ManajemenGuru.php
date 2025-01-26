<?php

namespace App\Livewire\Pages\Tatausaha\Guru;

use App\Livewire\Pages\TataUsaha\Guru\ModalManajemenGuru;
use Livewire\Component;
use App\Models\Guru\Guru;
use App\Models\Guru\JenisPtk;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
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

    // Search
    public $search = '';
    public $searchStatus = '';
    public $searchPtk = 0;

    public Collection $ptks;
    public function mount()
    {
        $this->ptks = JenisPtk::pluck('jenis_ptk', 'id');
    }
    // End Search
    
    public function render()
    {
        $gurus = Guru::with(['user', 'kelamin', 'ptk', 'agama'])
        ->when($this->search !== '', fn(Builder $query) => $query->where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('nip', 'like', '%' . $this->search . '%')
                    ->orWhere('nik', 'like', '%' . $this->search . '%')
                    ->orWhereHas('user', function ($query) {
                        $query->where('email', 'like', '%' . $this->search . '%');
                    });
        }))
        ->when($this->searchStatus !== '', fn(Builder $query) => $query->where('status_kepegawaian', $this->searchStatus))
        ->when($this->searchPtk > 0, fn(Builder $query) => $query->where('jenis_ptk_id', $this->searchPtk))
            ->latest()->paginate(5);

        $guruL = Guru::whereHas('kelamin', function ($query) {
            $query->where('kelamin', 'laki-laki');
        })->count();
        $guruP = Guru::whereHas('kelamin', function ($query) {
            $query->where('kelamin', 'perempuan');
        })->count();
        
        return view('livewire.pages.tata-usaha.guru.manajemen-guru', compact(['gurus', 'guruL', 'guruP']));
    }
}
