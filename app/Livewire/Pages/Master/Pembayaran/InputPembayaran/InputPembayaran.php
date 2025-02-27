<?php

namespace App\Livewire\Pages\Master\Pembayaran\InputPembayaran;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Jurusan;
use App\Models\TataUsaha\Pembayaran\JenisPembayaran;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.master-layout', ['title' => 'Input Pembayaran'])]
class InputPembayaran extends Component
{
    public $searchJurusan = '';
    public $searchKelas = '';
    public $searchSiswa = '';
    public $jurusans;
    public $kelases = [];
    public $siswa = null;

    public function mount()
    {
        $this->jurusans = Jurusan::all();
    }

    public function updatedSearchJurusan($jurusanId)
    {
        $this->kelases = Kelas::where('jurusan_id', $jurusanId)->get();
        $this->searchKelas = '';
        $this->searchSiswa = '';
        $this->siswa = null;
    }

    public function search()
    {
        $query = Siswa::query();

        if (!empty($this->searchSiswa)) {
            $query->where('nisn', 'like', '%' . $this->searchSiswa . '%')
                ->orWhere('name', 'like', '%' . $this->searchSiswa . '%');
        } else {
            if (!empty($this->searchJurusan)) {
                $query->whereHas('kelas', function ($q) {
                    $q->where('jurusan_id', $this->searchJurusan);
                });
            }
            if (!empty($this->searchKelas)) {
                $query->where('kelas_id', $this->searchKelas);
            }
        }

        $this->siswa = $query->first();
    }
    
    public function render()
    {
        return view('livewire.pages.master.pembayaran.input-pembayaran.input-pembayaran', [
            'kelases' => $this->kelases,
            'jenisPembayarans' => JenisPembayaran::all(),
        ]);
    }
}
