<?php

namespace App\Livewire\Permissions;

use App\Livewire\Forms\PermissionForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class PermissionBulkDelete extends Component
{
    use NotifyTrait;

    public PermissionForm $form;

    public function render()
    {
        return view('livewire.permissions.permission-bulk-delete');
    }

    #[On('bulk-delete-modal')]
    public function bulkDeleteModal($ids)
    {
        $this->dispatch('open-modal', 'bulk-delete-permission-modal');
        $this->form->refresh();
        $this->form->ids = json_decode($ids);
    }

    public function bulkDelete()
    {
        $this->form->destroyAll($this->form->ids);
        $this->dispatch('refresh-permission-list');
        $this->dispatch('close-modal', 'bulk-delete-permission-modal');
        $this->successNotify(__('trans.message_bulk_delete_permission'));
        $this->dispatch('refresh-partials');
    }
}
