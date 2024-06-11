<?php

namespace App\Livewire\Trash\Users;

use App\Livewire\Forms\UserForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class UserBulkRestore extends Component
{
    use NotifyTrait;
    public UserForm $form;

    public function render()
    {
        return view('livewire.trash.users.user-bulk-restore');
    }

    #[On('bulk-restore-modal')]
    public function bulkRestoreModal($ids)
    {
        $this->dispatch('open-modal', 'bulk-restore-user-modal');
        $this->form->refresh();
        $this->form->ids = json_decode($ids);
    }

    public function bulkRestore()
    {
        $this->form->restoreAll($this->form->ids);
        $this->dispatch('refresh-user-trash-list');
        $this->dispatch('close-modal', 'bulk-restore-user-modal');
        $this->successNotify(__('trans.message_bulk_restore_user'));
        $this->dispatch('refresh-partials');
    }
}
