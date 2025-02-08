<?php

namespace App\Livewire\Pages\Master\Identitas;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.master-layout', ['title' => 'Manajemen Identitas Sekolah'])]
class ManajemenIdentitasSekolah extends Component
{
    public function render()
    {
        return view('livewire.pages.master.identitas.manajemen-identitas-sekolah');
    }
}
