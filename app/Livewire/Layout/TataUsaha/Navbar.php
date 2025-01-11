<?php

namespace App\Livewire\Layout\TataUsaha;

use App\Livewire\Actions\Logout;
use Livewire\Component;

class Navbar extends Component
{
    public function logout(Logout $logout) : void
    {
        $logout();

        $this->redirect(route('login'));
    }
    
    public function render()
    {
        return view('livewire.layout.tata-usaha.navbar');
    }
}
