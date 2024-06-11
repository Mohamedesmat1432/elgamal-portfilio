<?php

namespace App\Livewire\Trash\Roles;

use App\Livewire\Forms\RoleForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class RoleForceBulkDelete extends Component
{
    use NotifyTrait;
    public RoleForm $form;

    public function render()
    {
        return view('livewire.trash.roles.role-force-bulk-delete');
    }

    #[On('force-bulk-delete-modal')]
    public function forceBulkDeleteModal($ids)
    {
        $this->dispatch('open-modal', 'force-bulk-delete-role-modal');
        $this->form->refresh();
        $this->form->ids = json_decode($ids);
    }

    public function forceBulkDelete()
    {
        $this->form->forceDeleteAll($this->form->ids);
        $this->dispatch('refresh-role-trash-list');
        $this->dispatch('close-modal', 'force-bulk-delete-role-modal');
        $this->successNotify(__('trans.message_bulk_delete_role'));
        $this->dispatch('refresh-partials');
    }
}
