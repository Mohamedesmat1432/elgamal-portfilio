<?php

namespace App\Livewire\Partials;

use App\Traits\LinksTrait;
use Livewire\Component;

class Navigation extends Component
{
    use LinksTrait;

    public function render()
    {
        return view('livewire.partials.navigation');
    }
}
