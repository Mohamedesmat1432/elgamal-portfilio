<?php

namespace App\Livewire\Trash\Permissions;

use App\Livewire\Forms\PermissionForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class PermissionForceBulkDelete extends Component
{
    use NotifyTrait;
    public PermissionForm $form;

    public function render()
    {
        return view('livewire.trash.permissions.permission-force-bulk-delete');
    }

    #[On('force-bulk-delete-modal')]
    public function forceBulkDeleteModal($ids)
    {
        $this->dispatch('open-modal', 'force-bulk-delete-permission-modal');
        $this->form->refresh();
        $this->form->ids = json_decode($ids);
    }

    public function forceBulkDelete()
    {
        $this->form->forceDeleteAll($this->form->ids);
        $this->dispatch('refresh-permission-trash-list');
        $this->dispatch('close-modal', 'force-bulk-delete-permission-modal');
        $this->successNotify(__('trans.message_bulk_delete_permission'));
        $this->dispatch('refresh-partials');
    }
}
