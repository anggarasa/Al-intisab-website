<?php

namespace App\Livewire\Layout\Kurikulum;

use App\Livewire\Actions\Logout;
use Livewire\Component;

class Navbar extends Component
{
    
    // logout
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect(route('login'));
    }
    // End logout
    
    public function render()
    {
        return view('livewire.layout.kurikulum.navbar');
    }
}
