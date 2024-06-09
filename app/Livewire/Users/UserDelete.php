<?php

namespace App\Livewire\Users;

use App\Livewire\Forms\UserForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class UserDelete extends Component
{
    use NotifyTrait;

    public UserForm $form;

    public function render()
    {
        return view('livewire.users.user-delete');
    }

    #[On('delete-modal')]
    public function deleteModal($id, $name)
    {
        $this->dispatch('open-modal', 'delete-user-modal');
        $this->dispatch('refresh-user-list');
        $this->form->id = $id;
        $this->form->name = $name;
    }

    public function delete()
    {
        $this->form->delete($this->form->id);
        $this->dispatch('refresh-user-list');
        $this->dispatch('close-modal', 'delete-user-modal');
        $this->successNotify(__('trans.message_delete_user'));
        $this->dispatch('refresh-partials');
    }
}
