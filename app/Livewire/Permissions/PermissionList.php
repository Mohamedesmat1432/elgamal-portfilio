<?php

namespace App\Livewire\Permissions;

use App\Models\Permission;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.app')]
class PermissionList extends Component
{
    #[On('refresh-permission-list')]
    public function render()
    {
        $permissions = Permission::paginate(10);

        return view('livewire.permissions.permission-list', [
            'permissions' => $permissions
        ]);
    }
}
