<?php

namespace App\Livewire\Layout\Master;

use Livewire\Component;
use App\Livewire\Actions\Logout;

class Navbar extends Component
{
    public function logout(Logout $logout) : void
    {
        $logout();

        $this->redirect(route('login'));
    }
    
    public function render()
    {
        return view('livewire.layout.master.navbar');
    }
}
