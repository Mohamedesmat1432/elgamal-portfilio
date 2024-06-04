<?php

namespace App\Livewire\Layout;

use App\Traits\WithLogout;
use Livewire\Component;

class Navigation extends Component
{
    use WithLogout;

    public function render()
    {
        return view('livewire.layout.navigation');
    }
}
