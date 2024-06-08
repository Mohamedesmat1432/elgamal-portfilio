<?php

namespace App\Livewire\Roles;

use App\Livewire\Forms\RoleForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class RoleCreate extends Component
{
    use NotifyTrait;

    public RoleForm $form;

    public function render()
    {
        return view('livewire.roles.role-create', [
            'permissions' => $this->form->permissions(),
        ]);
    }

    #[On('create-modal')]
    public function createModal()
    {
        $this->form->refresh();
        $this->dispatch('refresh-role-list');
        $this->dispatch('open-modal', 'create-role-modal');
    }

    public function create()
    {
        $this->form->store();
        $this->dispatch('refresh-role-list');
        $this->dispatch('close-modal', 'create-role-modal');
        $this->successNotify(__('trans.message_create_role'));
        $this->dispatch('refresh-partials');
    }
}
