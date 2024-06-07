<?php

namespace App\Livewire\Layout;

use App\Livewire\Actions\Logout;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Sidebar extends Component
{
    public function render()
    {
        return view('livewire.layout.sidebar');
    }

    #[Computed()]
    public function links()
    {
        return [
            [
                'name' => 'dashboard',
                'trans' => __('trans.dashboard'),
                'icon' => 'home',
            ],
            [
                'name' => 'permissions',
                'trans' => __('trans.permissions'),
                'icon' => 'lock-open',
            ],
            [
                'name' => 'roles',
                'trans' => __('trans.roles'),
                'icon' => 'shield-exclamation',
            ],
            [
                'name' => 'users',
                'trans' => __('trans.users'),
                'icon' => 'user',
            ],
        ];
    }

    public function logout(Logout $logout)
    {
        $logout();
        $this->redirect('/', navigate: true);
    }  
}
