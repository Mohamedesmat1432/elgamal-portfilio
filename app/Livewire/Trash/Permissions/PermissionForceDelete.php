<?php

namespace App\Livewire\Trash\Permissions;

use App\Livewire\Forms\PermissionForm;
use App\Traits\NotifyTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class PermissionForceDelete extends Component
{
    use NotifyTrait;
    public PermissionForm $form;

    public function render()
    {
        return view('livewire.trash.permissions.permission-force-delete');
    }

    #[On('force-delete-modal')]
    public function forceDeleteModal($id, $name)
    {
        $this->dispatch('open-modal', 'force-delete-permission-modal');
        $this->dispatch('refresh-permission-trash-list');
        $this->form->id = $id;
        $this->form->name = $name;
    }

    public function forceDelete()
    {
        $this->form->forceDelete($this->form->id);
        $this->dispatch('refresh-permission-trash-list');
        $this->dispatch('close-modal', 'force-delete-permission-modal');
        $this->successNotify(__('trans.message_delete_permission'));
        $this->dispatch('refresh-partials');
    }
}
