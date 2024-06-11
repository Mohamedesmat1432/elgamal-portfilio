<?php

namespace App\Livewire\Trash\Users;

use App\Livewire\Forms\UserForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class UserForceDelete extends Component
{
    use NotifyTrait;
    public UserForm $form;

    public function render()
    {
        return view('livewire.trash.users.user-force-delete');
    }

    #[On('force-delete-modal')]
    public function forceDeleteModal($id, $name)
    {
        $this->dispatch('open-modal', 'force-delete-user-modal');
        $this->dispatch('refresh-user-trash-list');
        $this->form->id = $id;
        $this->form->name = $name;
    }

    public function forceDelete()
    {
        $this->form->forceDelete($this->form->id);
        $this->dispatch('refresh-user-trash-list');
        $this->dispatch('close-modal', 'force-delete-user-modal');
        $this->successNotify(__('trans.message_delete_user'));
        $this->dispatch('refresh-partials');
    }
}
