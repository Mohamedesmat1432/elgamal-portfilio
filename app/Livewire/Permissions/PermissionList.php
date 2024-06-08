<?php

namespace App\Livewire\Permissions;

use App\Livewire\Forms\PermissionForm;
use App\Models\Permission;
use App\Traits\SortableTrait;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class PermissionList extends Component
{
    use SortableTrait, WithPagination;

    public PermissionForm $form;

    public function render()
    {
        $this->authorize('permission-list');
        
        return view('livewire.permissions.permission-list');
    }

    #[Computed, On('refresh-permission-list')]
    public function permissions()
    {
        return Permission::withoutTrashed()
            ->search($this->search)
            ->orderBy($this->sort_by, $this->sortDir())
            ->paginate($this->page_count);
    }

    #[On('refresh-permission-list')]
    public function refreshBulkButton()
    {
        $this->form->refresh();
    }

    public function selectAll()
    {
        $this->form->selectAll($this->permissions());
    }
}
