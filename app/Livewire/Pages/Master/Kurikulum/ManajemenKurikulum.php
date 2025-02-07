<?php

namespace App\Livewire\Pages\Master\Kurikulum;

use App\Models\Kurikulum\Kurikulum;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.master-layout', ['title' => 'Manajemen Kurikulum'])]
#[On('manajemen-kurikulum')]
class ManajemenKurikulum extends Component
{
    use WithPagination;

    // edit kurikulum
    public function editKurikulum($id)
    {
        $this->dispatch('editKurikulum', $id)->to(ModalManajemenKurikulum::class);
    }
    // End edit kurikulum
    
    public function render()
    {
        $kurikulums = Kurikulum::latest()->paginate(5);
        
        return view('livewire.pages.master.kurikulum.manajemen-kurikulum', compact('kurikulums'));
    }
}
