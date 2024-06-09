<?php

namespace App\Livewire\Trash\Permissions;

use App\Livewire\Forms\PermissionForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class PermissionBulkRestore extends Component
{
    use NotifyTrait;
    public PermissionForm $form;

    public function render()
    {
        return view('livewire.trash.permissions.permission-bulk-restore');
    }

    #[On('bulk-restore-modal')]
    public function bulkRestoreModal($ids)
    {
        $this->dispatch('open-modal', 'bulk-restore-permission-modal');
        $this->form->refresh();
        $this->form->ids = json_decode($ids);
    }

    public function bulkRestore()
    {
        $this->form->restoreAll($this->form->ids);
        $this->dispatch('refresh-permission-trash-list');
        $this->dispatch('close-modal', 'bulk-restore-permission-modal');
        $this->successNotify(__('trans.message_bulk_restore_permission'));
        $this->dispatch('refresh-partials');
    }
}
