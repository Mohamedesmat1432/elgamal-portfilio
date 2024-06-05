<?php

namespace App\Livewire\Permissions;

use App\Livewire\Forms\PermissionForm;
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

    public PermissionForm $form;

    #[On('reset-form')]
    public function resetForm()
    {
        $this->form->reset();
    }

    #[On('refresh-permission-list')]
    public function render()
    {
        // $this->authorize('permission-list');

        return view('livewire.permissions.permission-list', [
            'permissions' => Permission::search($this->search)->orderBy($this->sort_by, $this->sortDir())->paginate(3)
        ]);
    }
}
