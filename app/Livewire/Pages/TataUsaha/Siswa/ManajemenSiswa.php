<?php

namespace App\Livewire\Pages\TataUsaha\Siswa;

use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Siswa;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.tatausaha-layout',['title'=>'manajemen siswa'])]
#[On('manajemen-siswa')]
class ManajemenSiswa extends Component
{
    use WithPagination;
    
    public $jurusans;
    public $kelases;
    
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
        $siswas = Siswa::with(['user', 'agama', 'kelas', 'jurusan', 'kelamin'])->latest()->paginate(5);
        $siswaL = Siswa::whereHas('kelamin', function ($query) {
            $query->where('kelamin', 'laki-laki');
        })->count();
        $siswaP = Siswa::whereHas('kelamin', function ($query) {
            $query->where('kelamin', 'perempuan');
        })->count();
        
        return view('livewire.pages.tata-usaha.siswa.manajemen-siswa', compact(['siswas', 'siswaL', 'siswaP']));
    }
}
