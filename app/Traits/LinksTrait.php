<?php

namespace App\Traits;
use App\Livewire\Actions\Logout;

trait LinksTrait
{
    public function logout(Logout $logout)
    {
        $logout();
        $this->redirect('/', navigate: true);
    }  

    public function sidebarLinks()
    {
        return [
            [
                'name' => 'dashboard',
                'trans' => __('trans.dashboard'),
                'icon' => 'home',
                'permission'=> '',
            ],
            [
                'name' => 'permissions',
                'trans' => __('trans.permissions'),
                'icon' => 'lock-open',
                'permission'=> 'permission-list',
            ],
            [
                'name' => 'roles',
                'trans' => __('trans.roles'),
                'icon' => 'shield-exclamation',
                'permission'=> 'role-list',
            ],
            [
                'name' => 'users',
                'trans' => __('trans.users'),
                'icon' => 'user',
                'permission'=> 'user-list',
            ],
        ];
    }
}
