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

    public function render()
    {
        return view('livewire.permissions.permission-update');
    }

    #[On('edit-modal')]
    public function editModal($id)
    {
        $this->dispatch('refresh-permission-list');
        $this->dispatch('open-modal', 'update-permission-modal');
        $this->form->setPermission($id);
    }

    public function update()
    {
        $this->form->update();
        $this->dispatch('refresh-permission-list');
        $this->dispatch('close-modal', 'update-permission-modal');
        $this->successNotify(__('trans.message_update_permission'));
    }
}
