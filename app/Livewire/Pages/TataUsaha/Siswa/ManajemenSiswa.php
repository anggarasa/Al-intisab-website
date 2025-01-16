<?php

namespace App\Livewire\Pages\TataUsaha\Siswa;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.tatausaha-layout',['title'=>'manajemen siswa'])]

class ManajemenSiswa extends Component
{
    public function render()
    {
        return view('livewire.pages.tata-usaha.siswa.manajemen-siswa');
    }
}
