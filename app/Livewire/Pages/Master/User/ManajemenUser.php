<?php

namespace App\Livewire\Pages\Master\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Symfony\Component\CssSelector\Node\FunctionNode;

#[Layout('layouts.master-layout', ['title' => 'Manajemen User'])]
#[On('manajemen-user')]
class ManajemenUser extends Component
{
    use WithPagination;

    public $search = '';
    public $searchRole = 0;

    public Collection $role;

    public function mount()
    {
        $this->role = Role::whereIn('name', ['kurikulum', 'tu', 'master'])
        ->get()
        ->mapWithKeys(function ($role) {
            return [$role->id => match ($role->name) {
                'master' => 'MASTER',
                'tu'     => 'TATA USAHA',
                'kurikulum' => 'KURIKULUM'
            }];
        });
    }

    // Edit user
    public function editUser($id)
    {
        $this->dispatch('editUser', $id)->to(ModalManajenemUser::class);
    }
    // End Edit user

    // hapus user
    public function hapusUser($id)
    {
        $this->dispatch('hapusUser', $id)->to(ModalManajenemUser::class);
    }
    // End hapus user
    
    public function render()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['kurikulum', 'master', 'tu']);
        })
        ->when($this->search !== '', fn(Builder $query) => $query->where('email', 'like', '%'. $this->search. '%'))
        ->when($this->searchRole > 0, fn(Builder $query) => 
            $query->whereHas('roles', fn($q) => $q->where('id', $this->searchRole)))
        ->latest()->paginate(5);
        return view('livewire.pages.master.user.manajemen-user', compact(['users']));
    }
}
