<?php

namespace App\Livewire\Pages\Tatausaha\Guru;

use Livewire\Component;
use App\Models\Guru\Guru;
use Livewire\Attributes\Layout;

#[Layout('layouts.tatausaha-layout',['title'=>'manajemen Guru'])]

class ManajemenGuru extends Component
{
    public function render()
    {
        $gurus = Guru::with(['user', 'kelamin', 'kepegawaian', 'ptk', 'agama'])->latest()->get();
        
        return view('livewire.pages.tatausaha.guru.manajemen-guru', compact('gurus'));
    }
}
