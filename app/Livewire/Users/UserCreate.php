<?php

namespace App\Livewire\Users;

use App\Livewire\Forms\UserForm;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class UserCreate extends Component
{
    use WithNotify;

    public UserForm $form;

    public function render()
    {
        return view('livewire.users.user-create', [
            'roles' => $this->form->roles(),
        ]);
    }

    #[On('create-modal')]
    public function createModal()
    {
        $this->form->refresh();
        $this->dispatch('refresh-user-list');
        $this->dispatch('open-modal', 'create-user-modal');
    }

    public function create()
    {
        $this->form->store();
        $this->dispatch('refresh-user-list');
        $this->dispatch('close-modal', 'create-user-modal');
        $this->successNotify(__('trans.message_create_user'));
    }
}
