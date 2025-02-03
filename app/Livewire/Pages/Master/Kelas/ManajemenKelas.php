<?php

namespace App\Livewire\Pages\Master\Kelas;

use App\Models\Kelas;
use App\Models\Jurusan;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use App\Livewire\Pages\Master\Kelas\ModalManajemenKelas;

#[Layout('layouts.master-layout', ['title' => 'Manajemen Kelas'])]
#[On('management-kelas')]
class ManajemenKelas extends Component
{
    use WithPagination;
    
    // Edit kelas
    public function editKelas($id)
    {
        $this->dispatch('editKelas', $id)->to(ModalManajemenKelas::class);
    }
    // End edit kelas

    // Hapus Kelas
    public function hapusKelas($id)
    {
        $this->dispatch('hapusKelas', $id)->to(ModalManajemenKelas::class);
    }
    // End Hapus Kelas

    // Update status kelas
    public function updateStatusKelas($id, $status)
    {
        try {
            $kelas = Kelas::find($id);
            $kelas->update([
                'status' => $status
            ]);

            $this->dispatch('notificationMaster', [
                'type' => 'success',
                'message' => 'Status kelas berhasil diubah!',
                'title' => 'Sukses',
            ]);
        } catch (\Exception $e) {
            $this->dispatch('notificationMaster', [
                'type' => 'error',
                'message' => 'Status kelas gagal diubah!',
                'title' => 'Gagal',
            ]);
        }
    }
    // End update status kelas

    // Fitur search realtime
    public $search = '';
    public $searchJurusan = 0;
    public $searchStatus = '';

    public Collection $jurusans;

    public function mount()
    {
        $this->jurusans = Jurusan::pluck('nama_jurusan', 'id');
    }
    // End fitur seach realtime
    
    public function render()
    {
        $kelases = Kelas::with('jurusan')
        ->when($this->search !== '', fn(Builder $query) => $query->where('nama_kelas', 'like', '%'. $this->search .'%')) 
        ->when($this->searchStatus !== '', fn(Builder $query) => $query->where('status', $this->searchStatus))
        ->when($this->searchJurusan > 0, fn(Builder $query) => $query->where('jurusan_id', $this->searchJurusan))
            ->latest()
            ->paginate(5);
        
        return view('livewire.pages.master.kelas.manajemen-kelas', compact('kelases'));
    }
}
