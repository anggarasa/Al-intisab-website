<?php

namespace App\Livewire\Pages\TataUsaha\Siswa;

use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Siswa;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.tatausaha-layout',['title'=>'manajemen siswa'])]
#[On('manajemen-siswa')]
class ManajemenSiswa extends Component
{
    public $jurusans;
    public $kelases;
    
    public function mount()
    {
        $this->jurusans = Jurusan::pluck('nama_jurusan', 'id');
        $this->kelases = Kelas::pluck('nama_kelas', 'id');
    }
    
    public function render()
    {
        $siswas = Siswa::with(['user', 'agama', 'kelas', 'jurusan', 'kelamin'])->latest()->get();
        
        return view('livewire.pages.tata-usaha.siswa.manajemen-siswa', compact('siswas'));
    }
}
