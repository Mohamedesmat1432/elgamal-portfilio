<?php

namespace App\Livewire\Permissions;

use App\Livewire\Forms\PermissionForm;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class PermissionBulkDelete extends Component
{
    use WithNotify;

    public PermissionForm $form;

    #[On('bulk-delete-modal')]
    public function bulkDeleteModal($ids)
    {
        $this->form->ids = json_decode($ids);
        $this->dispatch('open-modal', 'bulk-delete-permission-modal');
    }

    public function bulkDelete()
    {
        $this->form->destroyAll($this->form->ids);
        $this->dispatch('close-modal', 'bulk-delete-permission-modal');
        $this->dispatch('refresh-permission-list');
        $this->successNotify(__('trans.message_bulk_delete_permission'));
        $this->dispatch('reset-form');
    }

    public function render()
    {
        return view('livewire.permissions.permission-bulk-delete');
    }
}
