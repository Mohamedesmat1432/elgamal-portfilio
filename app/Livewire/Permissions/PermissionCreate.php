<?php

namespace App\Livewire\Permissions;

use App\Livewire\Forms\PermissionForm;
use Livewire\Component;

class PermissionCreate extends Component
{
    public PermissionForm $form;

    public function createModal()
    {
        $this->form->reset();
        $this->form->create_modal = true;
    }

    public function save()
    {
        $this->form->store();
        $this->form->successNotify(__('trans.message_create_permission'));
        $this->dispatch('refresh-permission-list');
    }


    public function render()
    {
        return view('livewire.permissions.permission-create');
    }
}
