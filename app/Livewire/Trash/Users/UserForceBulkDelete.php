<?php

namespace App\Livewire\Trash\Users;

use App\Livewire\Forms\UserForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class UserForceBulkDelete extends Component
{
    use NotifyTrait;
    public UserForm $form;

    public function render()
    {
        return view('livewire.trash.users.user-force-bulk-delete');
    }

    #[On('force-bulk-delete-modal')]
    public function forceBulkDeleteModal($ids)
    {
        $this->dispatch('open-modal', 'force-bulk-delete-user-modal');
        $this->form->refresh();
        $this->form->ids = json_decode($ids);
    }

    public function forceBulkDelete()
    {
        $this->form->forceDeleteAll($this->form->ids);
        $this->dispatch('refresh-user-trash-list');
        $this->dispatch('close-modal', 'force-bulk-delete-user-modal');
        $this->successNotify(__('trans.message_bulk_delete_user'));
        $this->dispatch('refresh-partials');
    }
}
