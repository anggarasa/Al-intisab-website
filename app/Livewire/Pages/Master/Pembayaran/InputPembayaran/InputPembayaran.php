<?php

namespace App\Livewire\Pages\Master\Pembayaran\InputPembayaran;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Jurusan;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.master-layout', ['title' => 'Input Pembayaran'])]
class InputPembayaran extends Component
{
    public $searchJurusan = '';
    public $searchKelas = '';
    public $search = '';
    public $filteredKelases = [];
    public $siswaTerpilih;

    public function handleSearchJurusan($value)
    {
        // Filter kelas berdasarkan jurusan yang dipilih
        $this->filteredKelases = Kelas::where('jurusan_id', $value)->get();
        // Reset pencarian kelas dan siswa saat jurusan berubah
        $this->searchKelas = '';
        $this->search = '';
        $this->siswaTerpilih = null;
    }

    public function handleSearchKelas($value)
    {
        // Reset pencarian siswa saat kelas berubah
        $this->search = '';
        $this->siswaTerpilih = null;
    }

    public function searchSiswa()
    {
        if ($this->searchJurusan && $this->searchKelas && $this->search) {
            $this->siswaTerpilih = Siswa::where('kelas_id', $this->searchKelas)
                ->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('nisn', 'like', '%' . $this->search . '%');
                })->first();
        }
    }
    
    public function render()
    {
        return view('livewire.pages.master.pembayaran.input-pembayaran.input-pembayaran', [
            'jurusans' => Jurusan::all(),
            'kelases' => $this->searchJurusan ? Kelas::where('jurusan_id', $this->searchJurusan)->get() : [],
        ]);
    }
}
