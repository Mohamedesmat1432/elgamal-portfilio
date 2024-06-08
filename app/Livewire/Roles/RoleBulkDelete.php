<?php

namespace App\Livewire\Roles;

use App\Livewire\Forms\RoleForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class RoleBulkDelete extends Component
{
    use NotifyTrait;

    public RoleForm $form;

    public function render()
    {
        return view('livewire.roles.role-bulk-delete');
    }

    #[On('bulk-delete-modal')]
    public function bulkDeleteModal($ids)
    {
        $this->dispatch('open-modal', 'bulk-delete-role-modal');
        $this->form->refresh();
        $this->form->ids = json_decode($ids);
    }

    public function bulkDelete()
    {
        $this->form->destroyAll($this->form->ids);
        $this->dispatch('refresh-role-list');
        $this->dispatch('close-modal', 'bulk-delete-role-modal');
        $this->successNotify(__('trans.message_bulk_delete_role'));
        $this->dispatch('refresh-partials');
    }
}
