<?php

namespace App\Livewire\Pages\TataUsaha\Kelas;

use App\Models\Jurusan;
use App\Models\Kelas;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

#[Layout('layouts.tatausaha-layout', ['title' => 'Manajemen Kelas'])]
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
        ->when($this->searchStatus !== '', fn(Builder $query) => $query->where('status', 'like', '%'. $this->searchStatus .'%')) 
        ->when($this->searchJurusan > 0, fn(Builder $query) => $query->where('jurusan_id', $this->searchJurusan))
            ->latest()
            ->paginate(5);

        return view('livewire.pages.tata-usaha.kelas.manajemen-kelas', compact('kelases'));
    }
}
