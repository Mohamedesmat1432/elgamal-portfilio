<?php

namespace App\Livewire\Trash\Permissions;

use App\Livewire\Forms\PermissionForm;
use App\Models\Permission;
use App\Traits\SortableTrait;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class PermissionTrashList extends Component
{
    use SortableTrait, WithPagination;
    public PermissionForm $form;

    public function render()
    {
        $this->authorize('permission-trash-list');

        return view('livewire.trash.permissions.permission-trash-list');
    }

    #[Computed, On('refresh-permission-trash-list')]
    public function permissions()
    {
        return Permission::onlyTrashed()
            ->search($this->search)
            ->orderBy($this->sort_by, $this->sortDir())
            ->paginate($this->page_count);
    }

    #[On('refresh-permission-trash-list')]
    public function refreshForceBulkButton()
    {
        $this->form->refresh();
    }

    public function selectAll()
    {
        $this->form->selectAll($this->permissions());
    }
}
