<?php

namespace App\Livewire\Pages\TataUsaha\Kelas;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.tatausaha-layout', ['title' => 'Manajemen Kelas'])]

class ManajemenKelas extends Component
{
    public function render()
    {
        return view('livewire.pages.tata-usaha.kelas.manajemen-kelas');
    }
}
