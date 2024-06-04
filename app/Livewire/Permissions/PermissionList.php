<?php

namespace App\Livewire\Permissions;

use App\Models\Permission;
use App\Traits\WithSortable;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class PermissionList extends Component
{
    use WithSortable, WithPagination;

    public ?string $search = '';

    #[On('refresh-permission-list')]
    public function render()
    {
        // $this->authorize('permission-list');

        $permissions = Permission::search($this->search)->orderBy($this->sort_by, $this->sortDir())->paginate(3);

        return view('livewire.permissions.permission-list', [
            'permissions' => $permissions
        ]);
    }
}
