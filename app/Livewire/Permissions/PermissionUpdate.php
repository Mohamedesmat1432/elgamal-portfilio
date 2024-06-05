<?php

namespace App\Livewire\Permissions;

use App\Livewire\Forms\PermissionForm;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class PermissionUpdate extends Component
{
    use WithNotify;

    public PermissionForm $form;

    #[On('edit-modal')]
    public function editModal($id)
    {
        $this->form->setPermission($id);
        $this->dispatch('open-modal', 'update-permission-modal');
    }

    public function update()
    {
        $this->form->update();
        $this->dispatch('refresh-permission-list');
        $this->dispatch('close-modal', 'update-permission-modal');
        $this->successNotify(__('trans.message_update_permission'));
        $this->dispatch('reset-form');
    }

    public function render()
    {
        return view('livewire.permissions.permission-update');
    }
}
