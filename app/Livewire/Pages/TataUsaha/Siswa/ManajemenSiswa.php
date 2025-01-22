<?php

namespace App\Livewire\Pages\TataUsaha\Siswa;

use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

use function Laravel\Prompts\search;

#[Layout('layouts.tatausaha-layout',['title'=>'manajemen siswa'])]
#[On('manajemen-siswa')]
class ManajemenSiswa extends Component
{
    use WithPagination;
    
    public $search = '';
    public $searchJurusan = 0;
    public $searchKelas = 0;
    
    public Collection $jurusans;
    public Collection $kelases;
    
    public function mount()
    {
        $this->jurusans = Jurusan::pluck('nama_jurusan', 'id');
        $this->kelases = Kelas::pluck('nama_kelas', 'id');
    }

    // Edit data siswa
    public function editSiswa($id)
    {
        $this->dispatch('editSiswa', $id)->to(ModalManajemenSiswa::class);
    }
    // End Edit data siswa

    // Hapus Data Siswa
    public function hapusSiswa($id)
    {
        $this->dispatch('hapusSiswa', $id)->to(ModalManajemenSiswa::class);
    }
    // End Hapus Data Siswa
    
    public function render()
    {
        $siswas = Siswa::with(['user', 'agama', 'kelas', 'jurusan', 'kelamin'])
            ->when($this->search !== '', fn(Builder $query) => $query->where('name', 'like', '%'. $this->search . '%'))
            ->when($this->searchJurusan > 0, fn(Builder $query) => $query->where('jurusan_id', $this->searchJurusan))
            ->when($this->searchKelas > 0, fn(Builder $query) => $query->where('kelas_id', $this->searchKelas))
            ->latest()->paginate(5);
        $siswaL = Siswa::whereHas('kelamin', function ($query) {
            $query->where('kelamin', 'laki-laki');
        })->count();
        $siswaP = Siswa::whereHas('kelamin', function ($query) {
            $query->where('kelamin', 'perempuan');
        })->count();
        
        return view('livewire.pages.tata-usaha.siswa.manajemen-siswa', compact(['siswas', 'siswaL', 'siswaP']));
    }
}
