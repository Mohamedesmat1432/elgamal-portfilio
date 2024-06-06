<?php

namespace App\Livewire\Users;

use App\Livewire\Forms\UserForm;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class UserBulkDelete extends Component
{
    use WithNotify;

    public UserForm $form;

    public function render()
    {
        return view('livewire.users.user-bulk-delete');
    }

    #[On('bulk-delete-modal')]
    public function bulkDeleteModal($ids)
    {
        $this->dispatch('open-modal', 'bulk-delete-user-modal');
        $this->form->refresh();
        $this->form->ids = json_decode($ids);
    }

    public function bulkDelete()
    {
        $this->form->destroyAll($this->form->ids);
        $this->dispatch('refresh-user-list');
        $this->dispatch('close-modal', 'bulk-delete-user-modal');
        $this->successNotify(__('trans.message_bulk_delete_user'));
    }
}
