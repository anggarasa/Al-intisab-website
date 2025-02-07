<?php

namespace App\Livewire\Pages\Kurikulum\Kurikulum;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\Kurikulum\Kurikulum;
use Illuminate\Database\Eloquent\Builder;
use App\Livewire\Pages\Kurikulum\Kurikulum\ModalManajemenKurikulum;

#[Layout('layouts.kurikulum-layout', ['title' => 'Manajemen Kurikulum'])]
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
        
        return view('livewire.pages.kurikulum.kurikulum.manajemen-kurikulum', compact(['kurikulums']));
    }
}
