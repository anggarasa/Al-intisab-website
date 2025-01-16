<?php

namespace App\Livewire\Pages\Tatausaha\Guru;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.tatausaha-layout',['title'=>'manajemen Guru'])]

class ManajemenGuru extends Component
{
    public function render()
    {
        return view('livewire.pages.tatausaha.guru.manajemen-guru');
    }
}
