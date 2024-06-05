<?php

namespace App\Livewire\Permissions;

use App\Livewire\Forms\PermissionForm;
use App\Models\Permission;
use App\Traits\WithSortable;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class PermissionList extends Component
{
    use WithSortable, WithPagination;

    public PermissionForm $form;

    #[Computed()]
    public function permissions()
    {
        return Permission::withoutTrashed()->search($this->search)
            ->orderBy($this->sort_by, $this->sortDir())->paginate($this->page_count);
    }

    #[On('reset-form')]
    public function resetForm()
    {
        $this->form->reset();
        $this->form->resetValidation();
    }

    public function selectAll()
    {
        if($this->form->selected_all){
            $this->form->ids = $this->permissions()->pluck('id')->toArray();
            $this->form->selected_all = true;
        } else {
            $this->form->reset('ids', 'selected_all');
        }
    }

    #[On('refresh-permission-list')]
    public function render()
    {
        // $this->authorize('permission-list');

        return view('livewire.permissions.permission-list');
    }
}
