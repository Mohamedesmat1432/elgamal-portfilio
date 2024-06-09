<?php

namespace App\Livewire\Permissions;

use App\Livewire\Forms\PermissionForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class PermissionUpdate extends Component
{
    use NotifyTrait;
    public PermissionForm $form;

    public function render()
    {
        return view('livewire.permissions.permission-update');
    }

    #[On('edit-modal')]
    public function editModal($id)
    {
        $this->dispatch('open-modal', 'update-permission-modal');
        $this->dispatch('refresh-permission-list');
        $this->form->setPermission($id);
    }

    public function update()
    {
        $this->form->update();
        $this->dispatch('refresh-permission-list');
        $this->dispatch('close-modal', 'update-permission-modal');
        $this->successNotify(__('trans.message_update_permission'));
        $this->dispatch('refresh-partials');
    }
}
