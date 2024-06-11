<?php

namespace App\Livewire\Trash\Users;

use App\Livewire\Forms\UserForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class UserRestore extends Component
{
    use NotifyTrait;
    public UserForm $form;

    public function render()
    {
        return view('livewire.trash.users.user-restore');
    }

    #[On('restore-modal')]
    public function restoreModal($id, $name)
    {
        $this->dispatch('open-modal', 'restore-user-modal');
        $this->dispatch('refresh-user-trash-list');
        $this->form->id = $id;
        $this->form->name = $name;
    }

    public function restore()
    {
        $this->form->restore($this->form->id);
        $this->dispatch('refresh-user-trash-list');
        $this->dispatch('close-modal', 'restore-user-modal');
        $this->successNotify(__('trans.message_restore_user'));
        $this->dispatch('refresh-partials');
    }
}
