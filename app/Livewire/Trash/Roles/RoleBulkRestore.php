<?php

namespace App\Livewire\Trash\Roles;

use App\Livewire\Forms\RoleForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class RoleBulkRestore extends Component
{
    use NotifyTrait;
    public RoleForm $form;

    public function render()
    {
        return view('livewire.trash.roles.role-bulk-restore');
    }

    #[On('bulk-restore-modal')]
    public function bulkRestoreModal($ids)
    {
        $this->dispatch('open-modal', 'bulk-restore-role-modal');
        $this->form->refresh();
        $this->form->ids = json_decode($ids);
    }

    public function bulkRestore()
    {
        $this->form->restoreAll($this->form->ids);
        $this->dispatch('refresh-role-trash-list');
        $this->dispatch('close-modal', 'bulk-restore-role-modal');
        $this->successNotify(__('trans.message_bulk_restore_role'));
        $this->dispatch('refresh-partials');
    }
}
