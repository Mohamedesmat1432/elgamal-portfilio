<?php

namespace App\Livewire\Layout;

use App\Traits\LogoutTrait;
use Livewire\Component;

class NavigationHome extends Component
{
    use LogoutTrait;

    public function render()
    {
        return view('livewire.layout.navigation-home');
    }
}
