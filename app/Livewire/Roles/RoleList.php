<?php

namespace App\Livewire\Roles;

use App\Livewire\Forms\RoleForm;
use App\Models\Role;
use App\Traits\SortableTrait;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class RoleList extends Component
{
    use SortableTrait, WithPagination;

    public RoleForm $form;

    public function render()
    {
        $this->authorize('role-list');

        return view('livewire.roles.role-list');
    }

    #[Computed(), On('refresh-role-list')]
    public function roles()
    {
        return Role::withoutTrashed()
            ->search($this->search)
            ->orderBy($this->sort_by, $this->sortDir())
            ->paginate($this->page_count);
    }

    #[On('refresh-role-list')]
    public function refreshBulkButton()
    {
        $this->form->refresh();
    }

    public function selectAll()
    {
        $this->form->selectAll($this->roles());
    }
}
