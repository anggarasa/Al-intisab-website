<?php

namespace App\Livewire\Pages\Master\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\WithPagination;

#[Layout('layouts.master-layout', ['title' => 'Manajemen User'])]
#[On('manajemen-user')]
class ManajemenUser extends Component
{
    use WithPagination;

    // Edit user
    public function editUser($id)
    {
        $this->dispatch('editUser', $id)->to(ModalManajenemUser::class);
    }
    // End Edit user
    
    public function render()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['kurikulum', 'master', 'tu']);
        })->latest()->paginate(5);
        return view('livewire.pages.master.user.manajemen-user', compact(['users']));
    }
}
