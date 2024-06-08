<?php

namespace App\Traits;
use App\Livewire\Actions\Logout;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;

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
                'count'=> '',
            ],
            [
                'name' => 'permissions',
                'trans' => __('trans.permissions'),
                'icon' => 'lock-open',
                'permission'=> 'permission-list',
                'count'=> Permission::withoutTrashed()->count(),
            ],
            [
                'name' => 'roles',
                'trans' => __('trans.roles'),
                'icon' => 'shield-exclamation',
                'permission'=> 'role-list',
                'count'=> Role::withoutTrashed()->count(),
            ],
            [
                'name' => 'users',
                'trans' => __('trans.users'),
                'icon' => 'user',
                'permission'=> 'user-list',
                'count'=> User::withoutTrashed()->count(),
            ],
        ];
    }
}
