<?php

namespace App\Livewire\Pages\Master\Kurikulum;

use App\Models\Kurikulum\Kurikulum;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.master-layout', ['title' => 'Manajemen Kurikulum'])]
#[On('manajemen-kurikulum')]
class ManajemenKurikulum extends Component
{
    use WithPagination;

    public $search = '';

    // edit kurikulum
    public function editKurikulum($id)
    {
        $this->dispatch('editKurikulum', $id)->to(ModalManajemenKurikulum::class);
    }
    // End edit kurikulum

    // hapus kurikulum
    public function hapusKurikulum($id)
    {
        $this->dispatch('hapusKurikulum', $id)->to(ModalManajemenKurikulum::class);
    }
    // end hapus kurikulum
    
    public function render()
    {
        $kurikulums = Kurikulum::when($this->search !== '', fn(Builder $query) 
            => $query->where('nama_kurikulum', 'like', '%'. $this->search .'like')
                    ->orWhere('deskripsi', 'like', '%'. $this->search .'%')
        )->latest()->paginate(5);
        
        return view('livewire.pages.master.kurikulum.manajemen-kurikulum', compact('kurikulums'));
    }
}
