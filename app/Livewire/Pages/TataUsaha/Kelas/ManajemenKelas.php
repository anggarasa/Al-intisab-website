<?php

namespace App\Livewire\Pages\TataUsaha\Kelas;

use App\Models\Kelas;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.tatausaha-layout', ['title' => 'Manajemen Kelas'])]
#[On('management-kelas')]
class ManajemenKelas extends Component
{
    public function render()
    {
        return view('livewire.pages.tata-usaha.kelas.manajemen-kelas', [
            'kelases' => Kelas::with('jurusan')->latest()->get()
        ]);
    }
}
