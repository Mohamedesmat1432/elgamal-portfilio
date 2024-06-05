<?php

namespace App\Livewire\Permissions;

use App\Livewire\Forms\PermissionForm;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class PermissionCreate extends Component
{
    use WithNotify;

    public PermissionForm $form;

    public function render()
    {
        return view('livewire.permissions.permission-create');
    }

    #[On('create-modal')]
    public function createModal()
    {
        $this->form->refresh();
        $this->dispatch('refresh-permission-list');
        $this->dispatch('open-modal', 'create-permission-modal');
    }

    public function create()
    {
        $this->form->store();
        $this->dispatch('refresh-permission-list');
        $this->dispatch('close-modal', 'create-permission-modal');
        $this->successNotify(__('trans.message_create_permission'));
    }
}
