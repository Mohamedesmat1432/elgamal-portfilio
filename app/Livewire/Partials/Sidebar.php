<?php

namespace App\Livewire\Partials;

use App\Traits\LinksTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class Sidebar extends Component
{
    use LinksTrait;

    #[On('refresh-partials')]
    public function render()
    {
        return view('livewire.partials.sidebar');
    }
}
