<?php

namespace App\Livewire\Users;

use App\Livewire\Forms\UserForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class UserUpdate extends Component
{
    use NotifyTrait;

    public UserForm $form;

    public function render()
    {
        return view('livewire.users.user-update',[
            'roles' => $this->form->roles(),
        ]);
    }

    #[On('edit-modal')]
    public function editModal($id)
    {
        $this->dispatch('open-modal', 'update-user-modal');
        $this->dispatch('refresh-user-list');
        $this->form->setUser($id);
    }

    public function update()
    {
        $this->form->update();
        $this->dispatch('refresh-user-list');
        $this->dispatch('close-modal', 'update-user-modal');
        $this->successNotify(__('trans.message_update_user'));
        $this->dispatch('refresh-partials');
    }
}
