<?php

namespace App\Livewire\Pages\Master\Identitas;

use App\Models\IdentitasSekolah;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.master-layout', ['title' => 'Manajemen Identitas Sekolah'])]
class ManajemenIdentitasSekolah extends Component
{
    public function render()
    {
        $identitasSekolahs = IdentitasSekolah::latest()->get();
        
        return view('livewire.pages.master.identitas.manajemen-identitas-sekolah', compact('identitasSekolahs'));
    }
}
