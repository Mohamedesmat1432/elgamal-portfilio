<?php

namespace App\Livewire\Trash\Roles;

use App\Livewire\Forms\RoleForm;
use App\Models\Role;
use App\Traits\SortableTrait;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class RoleTrashList extends Component
{
    use SortableTrait, WithPagination;
    public RoleForm $form;

    public function render()
    {
        $this->authorize('role-trash-list');

        return view('livewire.trash.roles.role-trash-list');
    }

    #[Computed, On('refresh-role-trash-list')]
    public function roles()
    {
        return Role::onlyTrashed()
            ->search($this->search)
            ->orderBy($this->sort_by, $this->sortDir())
            ->paginate($this->page_count);
    }

    #[On('refresh-role-trash-list')]
    public function refreshForceBulkButton()
    {
        $this->form->refresh();
    }

    public function selectAll()
    {
        $this->form->selectAll($this->roles());
    }
}
